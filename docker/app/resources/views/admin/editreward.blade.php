<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <title>แก้ไขรางวัล</title>
</head>
<body>
    <div class="edit-re-main">
        <h1>แก้ไขรางวัล</h1>
    <form action="{{ route('admin.reward.update', $reward->reward_id) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- ชื่อรางวัล --}}
        <div class="name-re-edit">
            <label for="namere-edt-in" class="topic-namere-edt">ชื่อรางวัล</label><br>
            <input type="text" class="namere-edt-in" id="name" name="name" value="{{ old('name',$reward->name) }}" required>
        </div>
        {{-- หมวดหมู่ --}}
        <div class="cate-re-edit">
            <label for="catere-edt" class="topic-cate-edt">หมวดหมู่</label><br>
                <select class="catere-edt-in" id="category_list" name="category_id" required>
                    <option value="">--เลือกหมวดหมู่ของรางวัล--</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->category_id }}" {{ old('category_id',$reward->category_id) == $category->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                     @endforeach
                </select>
        </div>
        {{-- อัตราการออก --}}
        <div class="rate-re-edit">
            <label for="ratere-edt-in" class="topic-rate-edt">อัตราการออก</label><br>
            <input type="number" class="ratere-edt-in" id="rate" name="rate" value="{{old('rate',$reward->rate)}}" required>
        </div>
        {{-- จำนวนรางวัล --}}
        <div class="qnty-re-edit">
            <label for="" class="topic-qnty-edt">จำนวนของรางวัล</label><br>
            <input type="number" class="qntyre-edt-in" id="quantity" name="quantity_reward" value="{{old('quantity_reward',$reward->quantity_reward)}}" required>
        </div>
        {{-- ปุ่มบันทึกและยกเลิก --}}
        <div class="mnge-boxmain">
            <button type="submit" class="submtedt-btn">
                <span>บันทึก</span>
            </button>

            <a href="{{url ('admin/managereward')}}" class="cancle-btn-editreward">
                <span>ยกเลิก</span>
            </a>
        </div>
    </form>
    </div>
</body>
</html>