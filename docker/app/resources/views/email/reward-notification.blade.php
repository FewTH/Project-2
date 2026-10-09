<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: sans-serif; background-color: #f8f8f6; padding: 30px; display: flex; justify-content: center;">
    <div>
        <h2>ยินดีด้วย คุณได้รับรางวัล!</h2>

        <p>เรียน คุณ{{ $spinresult->winner_name }}</p>

       <p>คุณได้รับรางวัล <strong>{{ $spinresult->reward->name ?? '-' }}</strong> จากการสุ่มรางวัล</p>

        <p>แสดง QR Code นี้เพื่อรับของรางวัล</p>
        <img src="{{ $message->embedData($qrimage, 'qrcode.png', 'image/png') }}" alt="QR Code" style="width: 200px; height: 200px; ">
        <p>รหัส: {{ $spinresult->qr_code }}</p>

        <p>อีเมลนี้ส่งโดยระบบอัตโนมัติ กรุณาอย่าตอบกลับ</p>
    </div>
</body>
</html>