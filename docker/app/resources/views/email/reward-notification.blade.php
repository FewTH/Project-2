<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="background-color: #E5E7EB;">

    <table role="presentation" style="width: 100%;">
        <tr>
            <td align="center" style="padding: 30px 10px; background-color: #E5E7EB;">

            <table role="presentation" style="width: 100%; max-width: 540px; background-color: #FFFFFF; border-radius: 10px;">
                <tr>
                     <td style="padding: 30px 30px 15px 30px;">

                        <p style=" margin: 0 0 16px;font-size: 24px; color: #111827; font-weight: 600;">ยินดีด้วย คุณได้รับรางวัล</p>

                        <p style="color: #1F2937; font-size: 18px;">เรียน คุณ <span style="font-weight: 600;">{{ $spinresult->winner_name }}</span></p>

                        <p style="color: #374151; font-size: 18px;">คุณได้รับรางวัลจากการสุ่มรางวัล กรุณาแสดง QR Code ด้านล่างเพื่อรับของรางวัล</p>

                        <hr style="border: 1px solid #d6d7da;">

                        <div style="display: flex;">
                            <p style="color: #4B5563; font-size: 18px;">รางวัล</p>    
                            <div style="margin-left: auto">
                                <p style="color: #1F2937; font-weight: 600;  font-size: 18px;">{{ $spinresult->reward->name ?? '-' }}</p>
                            </div>
                        </div>

                        <hr style="border: 1px solid #d6d7da;">

                        <div style="display: flex;">
                            <p style="color: #4B5563; font-size: 18px;">รหัสรับรางวัล</p>    
                            <div style="margin-left: auto;">
                                <p style="color: #1F2937; font-weight: 600; font-size: 18px;">{{ $spinresult->qr_code }}</p>
                            </div>
                        </div>

                        <hr style="border: 1px solid #d6d7da;">

                        <table role="presentation" style="width: 100%; margin-top: 20px">
                            <tr>
                                <td align="center">
                                    <img src="{{ $message->embedData($qrimage, 'qrcode.png', 'image/png') }}" alt="QR Code" style="width: 250px; height: 250px;">
                                </td>
                            </tr>
                        </table>
                        <table role="presentation" style="width: 100%;">
                            <tr>
                                <td align="center">
                                    <div style="margin-top: 20px;">
                                        <p style="color: #4B5563; font-size: 14px;">สแกนหรือแสดง QR Code นี้ที่จุดรับรางวัล</p>
                                    </div>
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
            </table>
            

        </td>
    </tr>
</table>

</body>
</html>