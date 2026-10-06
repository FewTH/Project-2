<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: sans-serif; background-color: #f8f8f6; padding: 30px;">
    <div style="max-width: 500px; margin: auto; background: #ffffff; border-radius: 15px; padding: 30px; border: 2px solid #d39b00;">
        <h2 style="color: #8A5B10;">ยินดีด้วย คุณได้รับรางวัล!</h2>

        <p>เรียน คุณ{{ $spinresult->winner_name }}</p>

        <p>คุณได้รับรางวัล <strong>{{ $spinresult->reward->reward_name ?? '-' }}</strong> จากการสุ่มรางวัล</p>

        <p style="color: #8c8d8d; font-size: 14px; margin-top: 30px;">อีเมลนี้ส่งโดยระบบอัตโนมัติ กรุณาอย่าตอบกลับ</p>
    </div>
</body>
</html>