<?php
// index.php - الملف الرئيسي

// تضمين الملفات المطلوبة
$config = require 'config.php';
require 'functions.php';

// استخدام الإعدادات من ملف config
$token = $config['token'];
$chat_id = $config['chat_id'];

// جلب البيانات وعرضها
$data = getTelegramUpdates($token, $chat_id);
$lastMessage = getLastPostMessage($data);

echo "<h1>آخر منشور في القناة:</h1>";
echo displayMessage($lastMessage);
?>
