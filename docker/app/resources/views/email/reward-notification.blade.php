<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: sans-serif; background-color: #f8f8f6; padding: 30px; display: flex; justify-content: center;">
    <div style="max-width: 500px; margin: auto; background: #ffffff; border-radius: 15px; padding: 30px; border: 2px solid #d39b00;">
        <h2 style="color: #8A5B10;">ยินดีด้วย คุณได้รับรางวัล!</h2>

        <p style="font-size: 20px" >เรียน คุณ{{ $spinresult->winner_name }}</p>

       <p>คุณได้รับรางวัล <strong style="color: #8A5B10;">{{ $spinresult->reward->name ?? '-' }}</strong> จากการสุ่มรางวัล</p>

        <p>แสดง QR Code นี้เพื่อรับของรางวัล</p>
        <img src="{{ $message->embedData($qrimage, 'qrcode.png', 'image/png') }}" alt="QR Code" style="width: 200px; height: 200px; ">
        <p style="color: #8c8d8d; font-size: 14px;">รหัส: {{ $spinresult->qr_code }}</p>

        <p style="color: #8c8d8d; font-size: 14px; margin-top: 30px;">อีเมลนี้ส่งโดยระบบอัตโนมัติ กรุณาอย่าตอบกลับ</p>
    </div>
</body>
</html>