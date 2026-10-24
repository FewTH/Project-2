<?php

namespace App\Http\Controllers;

use App\Models\Spinresult;
use App\Models\EventRegistration;
use App\Models\Event;
use App\Models\Reward;
use App\Models\User;
use App\Models\AssessmentRespondent;
use App\Models\Assessment;
use App\Models\AssessmentAssignment;
use App\Models\EventRewardDraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AssessmentApi;
use Illuminate\Support\Facades\Cache;


class DashboardController extends Controller
{

    //แสดงหน้าแดชบอร์ด รับค่าสถานะจากปุ่ม วัน สัปดาห์ เดือน
    public function index(Request $request)
    {
        //ถ้าส่งค่าแปลกๆมา ให้ใช้ day เป็นค่าเริ่มต้น
        $range = $request->query('range', 'day');
        if ($range != 'day' && $range != 'week' && $range != 'month'){
            $range = 'day';
        } 

        //กำหนดจำนวนช่วงในกราฟ ชื่อหัวกราฟ และวันเริ่มต้นของแต่ละช่วง
        if ($range == 'day'){
            $amount = 14;
            $charttitle = 'การสุ่มรายวัน — 14 วันล่าสุด';
            $start = now()->subDays(13)->startOfDay();
            $thisstart = now()->startOfDay();
            $laststart = now()->subDay()->startOfDay();
            $lastend = now()->subDay()->endOfDay();
            $newtext = 'คนวันนี้';
            $comparetext = 'จากเมื่อวาน';
            $thistext = 'วันนี้';
        }elseif ($range == 'week'){
            $amount = 8;
            $charttitle = 'การสุ่มรายสัปดาห์ — 8 สัปดาห์ล่าสุด';
            $start = now()->subWeeks(7)->startOfWeek();
            $thisstart = now()->startOfWeek();
            $laststart = now()->subWeek()->startOfWeek();
            $lastend = now()->subWeek()->endOfWeek();
            $newtext = 'คนสัปดาห์นี้';
            $comparetext = 'จากสัปดาห์ก่อน';
            $thistext = 'สัปดาห์นี้';
        }else{
            $amount = 6;
            $charttitle = 'การสุ่มรายเดือน — 6 เดือนล่าสุด';
            $start = now()->startOfMonth()->subMonthsNoOverflow(5);
            $thisstart = now()->startOfMonth();
            $laststart = now()->startOfMonth()->subMonthNoOverflow();
            $lastend = now()->startOfMonth()->subMonthNoOverflow()->endOfMonth();
            $newtext = 'คนเดือนนี้';
            $comparetext = 'จากเดือนก่อน';
            $thistext = 'เดือนนี้';
        }
        //กรอบที่ 1 ผู้ใช้ทั้งหมดนับทุก role กับคนที่เพิ่มมาใหม่ในช่วงนี้
        $totalusers = User::count();
        $newusers = User::where('created_at', '>=', $thisstart)->count();

        //กรอบที่ 2 คนที่ทำแบบประเมินแล้ว กับคนที่ทำใหม่ในช่วงนี้
        $totalassessed = AssessmentRespondent::count();
        $assessedtoday = AssessmentRespondent::where('created_at', '>=', $thisstart)->count();

        //กรอบที่ 3 สุ่มทั้งหมดรวมทุกหน้าเทียบช่วงล่าสุดกับช่วงก่อนหน้า
        $totalspin = $this->countspin($start);
        $spinthis = $this->countspin($thisstart);
        $spinlast = $this->countspin($laststart, $lastend);
        $spinchange = $this->calculatepercent($spinthis, $spinlast);

        //กรอบที่ 4 กิจกรรมที่เปิดอยู่
        $openevents = Event::where('status', 'open')->where('register_close_at', '>', now())->count();
        $newevents = Event::where('created_at', '>=', $thisstart)->count();
        
        //กรอบที่ 5 แบบประเมินที่เปิดอยู่ กับที่เพิ่มเข้ามาใหม่ในช่วงนี้
        $allAssess  = Cache::remember('dash_assessments_all', 60, fn () => app(AssessmentApi::class)->all());
        $assigned   = AssessmentAssignment::pluck('assessment_id')->all();
        $openassess = $allAssess->filter(
            fn ($a) => (int) $a->is_open === 1 && !in_array($a->assessment_id, $assigned)
        )->count();
        $newassess  = 0;
        //ข้อมูลกราฟ วนทีละช่วงแล้วนับจำนวนการสุ่ม ช่วงไหนไม่มีข้อมูลจะได้ 0
        $labels = [];
        $values = [];

        for ($i = $amount - 1; $i >= 0; $i--){
            if($range == 'day'){
                $bstart = now()->subDays($i)->startOfDay();
                $bend = $bstart->copy()->endOfDay();
                $labels[] = $bstart->format('d/m');

            }elseif($range == 'week'){
                $bstart = now()->subWeeks($i)->startOfWeek();
                $bend = $bstart->copy()->endOfWeek();
                $labels[] = $bstart->format('d/m');
            }else{
                $bstart = now()->startOfMonth()->subMonthsNoOverflow($i);
                $bend = $bstart->copy()->endOfMonth();
                $labels[] = $bstart->format('m/Y');
            }
            $values[] = $this->countspin($bstart, $bend);
        }
        //ของขวัญยอดนิยม รวมจำนวนครั้งที่สุ่มได้ของแต่ละรางวัลจากสามตาราง
        $counts = [];

        $fromspin = Spinresult::selectRaw('reward_id, COUNT(*) as times')
            ->where('created_at', '>=', $start)
            ->groupBy('reward_id')
            ->pluck('times', 'reward_id');

        $fromevent = EventRegistration::selectRaw('reward_id, COUNT(*) as times')
            ->where('is_drawn', 1)
            ->whereNotNull('reward_id')
            ->where('drawn_at', '>=', $start)
            ->groupBy('reward_id')
            ->pluck('times', 'reward_id');

        //สุ่มรางวัลอย่างเดียวที่ไม่มีรายชื่อ (เก็บไว้ที่ event_reward_draws)
        $fromdraw = EventRewardDraw::selectRaw('reward_id, COUNT(*) as times')
            ->where('drawn_at', '>=', $start)
            ->groupBy('reward_id')
            ->pluck('times', 'reward_id');

        foreach ($fromspin as $rewardid => $times) {
            $counts[$rewardid] = $times;
        }
        foreach ($fromevent as $rewardid => $times) {
            if (isset($counts[$rewardid])) {
                $counts[$rewardid] += $times;
            } else {
                $counts[$rewardid] = $times;
            }
        }
        foreach ($fromdraw as $rewardid => $times) {
            if (isset($counts[$rewardid])) {
                $counts[$rewardid] += $times;
            } else {
                $counts[$rewardid] = $times;
            }
        }

        arsort($counts);                              //เรียงมากไปน้อย
        $counts = array_slice($counts, 0, 4, true);   //เอา 4 อันดับแรก

        $popular = [];
        foreach ($counts as $rewardid => $times) {
            $reward = Reward::find($rewardid);

            //เปอร์เซ็นต์คิดจากจำนวนสุ่มทั้งหมดในช่วงนี้
            $percent = 0;
            if ($totalspin > 0) {
                $percent = round(($times / $totalspin) * 100);
            }

            $popular[] = [
                'name' => $reward->name ?? '-',
                'times' => $times,
                'setting' => $reward->rate ?? 0,   //เปอร์เซ็นต์ที่ตั้งค่าไว้ในตาราง reward
                'percent' => $percent,
            ];
        }

        //สรุปสถานะ QR code ของแบบประเมิน (นับจาก spin_results อย่างเดียว เพราะหน้า random_reward ไม่มี QR)
        $qrtotal = Spinresult::where('created_at', '>=', $start)->count();
        $received = Spinresult::where('created_at', '>=', $start)->where('receive_status', 'received')->count();
        $notreceived = $qrtotal - $received;

        $receivedpercent = 0;
        if ($qrtotal > 0) {
            $receivedpercent = round(($received / $qrtotal) * 100);
        }

        //สถานะอีเมลที่ส่งให้ผู้ได้รับรางวัล
        $emailsent = Spinresult::where('created_at', '>=', $start)->where('email_status', 'sent')->count();
        $emailfailed = Spinresult::where('created_at', '>=', $start)->where('email_status', 'failed')->count();
        $emailpending = $qrtotal - $emailsent - $emailfailed;

        return view('admin.dashboard', [
            'user' => Auth::user(),
            'range' => $range,
            'charttitle' => $charttitle,
            'labels' => $labels,
            'values' => $values,
            'totalusers' => $totalusers,
            'newusers' => $newusers,
            'newtext' => $newtext,
            'totalassessed' => $totalassessed,
            'assessedtoday' => $assessedtoday,
            'totalspin' => $totalspin,
            'spinchange' => $spinchange,
            'comparetext' => $comparetext,
            'openevents' => $openevents,
            'newevents' => $newevents,
            'popular' => $popular,
            'qrtotal' => $qrtotal,
            'received' => $received,
            'notreceived' => $notreceived,
            'receivedpercent' => $receivedpercent,
            'emailsent' => $emailsent,
            'emailfailed' => $emailfailed,
            'emailpending' => $emailpending,
            'openassess' => $openassess,
            'newassess' => $newassess,
            'spinthis' => $spinthis,
            'thistext' => $thistext,
        ]);
    }

    //นับจำนวนการสุ่มของทุกหน้า (assessment อยู่ spin_results, random_reward อยู่ event_registrations, สุ่มรางวัลล้วนอยู่ event_reward_draws)
    //ช่วงเวลาเป็น [from, to] คือรวมทั้ง from และ to
    private function countspin($from, $to = null)
    {
        $a = Spinresult::where('created_at', '>=', $from);
        $b = EventRegistration::where('is_drawn', 1)->where('drawn_at', '>=', $from);
        $c = EventRewardDraw::where('drawn_at', '>=', $from);

        if ($to) {
            $a->where('created_at', '<=', $to);
            $b->where('drawn_at', '<=', $to);
            $c->where('drawn_at', '<=', $to);
        }

        return $a->count() + $b->count() + $c->count();
    }

    //คำนวณว่าเพิ่มขึ้นหรือลดลงกี่เปอร์เซ็นต์ เทียบกับช่วงก่อนหน้า
    private function calculatepercent($now, $before)
    {
        //ถ้าช่วงก่อนหน้าเป็น 0 หารไม่ได้ ถ้ามีข้อมูลตอนนี้ให้ถือว่า +100
        if ($before == 0) {
            if ($now > 0) {
                return 100;
            }
            return 0;
        }

        return round((($now - $before) / $before) * 100);
    }
}