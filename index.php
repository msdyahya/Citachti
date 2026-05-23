
<?php
// إعدادات البوت (يرجى التأكد من استبدال التوكن إذا قمت بتغييره)
$token = "8901733084:AAH9icgp3Q7krjOomq0jiVU5VQh0zcPkY_g";
$chat_id = "-1003712252984"; 

// رابط API تليجرام لجلب التحديثات
$url = "https://api.telegram.org/bot" . $token . "/getUpdates";

// جلب البيانات من تليجرام
$response = file_get_contents($url);
$data = json_decode($response, true);

// استخراج آخر منشور
$last_message = "لا توجد منشورات حتى الآن في هذه القناة.";

if (isset($data['result']) && !empty($data['result'])) {
    // نقوم بالبحث في التحديثات عن منشور القناة الخاص بالـ Chat ID المحدد
    foreach (array_reverse($data['result']) as $update) {
        if (isset($update['channel_post']['chat']['id']) && $update['channel_post']['chat']['id'] == $chat_id) {
            if (isset($update['channel_post']['text'])) {
                $last_message = $update['channel_post']['text'];
                break; // وجدنا آخر رسالة، نخرج من الحلقة
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>عرض منشورات القناة</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 50px; text-align: center; background-color: #f4f4f9; }
        .post-box { 
            background: white; 
            border: 1px solid #ddd; 
            padding: 30px; 
            border-radius: 15px; 
            display: inline-block; 
            max-width: 600px; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h1 { color: #333; }
    </style>
</head>
<body>
    <h1>آخر منشور من القناة:</h1>
    <div class="post-box">
        <p><?php echo nl2br(htmlspecialchars($last_message)); ?></p>
    </div>
</body>
</html>
