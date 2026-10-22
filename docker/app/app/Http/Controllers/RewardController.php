<?php

namespace App\Http\Controllers;


use App\Models\Reward;
use App\Models\RewardCategory;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function store(Request $request)
    {
        // ตรวจสอบความถูกต้องของข้อมูล
        $request->validate([
            'name'  => 'required|string|max:200',
            'category_id' => 'required|exists:reward_categories,category_id',
            'rate'     => 'required|integer|min:0|max:100',
            'quantity_reward'  => 'required|integer|min:0',
        ]);

        // บันทึกลงฐานข้อมูล
        Reward::create([
            'name'      => $request->name,
            'category_id'     => $request->category_id,
            'rate'         => $request->rate,
            'quantity_reward' => $request->quantity_reward ,
            'created_by' => auth()->id(),
        ]);
        
        // สร้างตัวแปรนี้มาเพื่อเอาไว้เช็ค role ว่ามี request มาจาก role อะไร
        $redirectRoute = (auth()->user()->role === 'manager') ? 'manager.managereward' : 'admin.managereward';
        // ส่งของรางวัลกลับไปยังหน้าจัดการ พร้อมข้อความแจ้งเตือนสำเร็จ
        return redirect()->route($redirectRoute)
                         ->with('success', 'เพิ่มของรางวัลเรียบยร้อย');
    }
    // ฟังก์ชันนี้คือนำของรางวัลที่สร้างแล้วกลับไปแสดงทีview
    public function index()
    {
        // เอาผู้ใช้ที่เพิ่งสร้างกลับไปแสดงที่หน้าmanagerewardของแอดมิน
        $rewards = Reward::with('category')->orderByDesc('reward_id')->get();
        // สร้างตัวแปรนี้มาเพื่อเอาไว้เช็ค role ว่ามี request มาจาก role อะไรแล้วส่งค่ากลับไปตาม role ที่ request
        $view = (auth()->user()->role === 'manager')? 'manager.managereward' : 'admin.managereward';
        // ส่งตัวแปร users ไปให้หน้า managereward
        return view($view, compact('rewards'));
    }
    public function create()
    {
        $categories = RewardCategory::all();
        // สร้างตัวแปรนี้มาเพื่อเอาไว้เช็ค role ว่ามี request มาจาก role อะไรแล้วส่งค่ากลับไปตาม role ที่ request
        $view = (auth()->user()->role === 'manager')? 'manager.addreward' : 'admin.addreward';
        return view($view, compact('categories'));
    }
    // เรียกหน้าแก้ไขรางวัลกับข้อมูลเก่า
    public function edit($id)
    {
        $reward =  Reward::findOrFail($id);
        $categories = RewardCategory::all();
        // สร้างตัวแปรนี้มาเพื่อเอาไว้เช็ค role ว่ามี request มาจาก role อะไรแล้วส่งค่ากลับไปตาม role ที่ request
        $view = (auth()->user()->role === 'manager')? 'manager.editreward' : 'admin.editreward';
        return view($view, compact('reward', 'categories'));
    }
    // เอาข้อมูลใหม่มาบันทึกแทนของเก่า
    public function update(Request $request,$id)
    {
        $reward = Reward::findOrFail($id);
        $request->validate([
            'name'  => 'required|string|max:200',
            'category_id' => 'required|exists:reward_categories,category_id',
            'rate'     => 'required|integer|min:0|max:100',
            'quantity_reward'  => 'required|integer|min:0',
        ]);

        $reward->update([
            'name'              => $request->name,
            'category_id'       => $request->category_id,
            'rate'              => $request->rate,
            'quantity_reward'   => $request->quantity_reward,
        ]);
        
        // สร้างตัวแปรนี้มาเพื่อเอาไว้เช็ค role ว่ามี request มาจาก role อะไรแล้วส่งค่ากลับไปตาม role ที่ request
        $redirectRoute = (auth()->user()->role === 'manager')? 'manager.managereward' : 'admin.managereward';
        return redirect()->route($redirectRoute)->with('success','แก้ไขข้อมูลของรางวัลเรียบร้อย');
    }
    // อันจะเป็นฟังก์ชันที่ไว้ลบของรางวัล
     public function destroy($id)
    {
        $reward = Reward::findOrFail($id);
        $reward->delete();
        // สร้างตัวแปรนี้มาเพื่อเอาไว้เช็ค role ว่ามี request มาจาก role อะไรแล้วส่งค่ากลับไปตาม role ที่ request
        $redirectRoute = (auth()->user()->role === 'manager')? 'manager.managereward' : 'admin.managereward';
        return redirect()->route($redirectRoute)
                         ->with('success', 'ลบของรางวัลเรียบร้อยแล้ว');
    }
}
