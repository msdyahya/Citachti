<?php
// functions.php - دوال مساعدة

function getTelegramUpdates($token, $chat_id) {
    $url = "https://api.telegram.org/bot" . $token . "/getUpdates?chat_id=" . $chat_id;
    $response = file_get_contents($url);
    return json_decode($response, true);
}

function getLastPostMessage($data) {
    if (isset($data['result']) && !empty($data['result'])) {
        $last_index = count($data['result']) - 1;
        return $data['result'][$last_index]['channel_post']['text'] ?? "لا يوجد نص في آخر منشور.";
    }
    return null;
}

function displayMessage($message) {
    if ($message) {
        return "<div style='padding: 20px; border: 1px solid #ccc; border-radius: 10px;'>" . htmlspecialchars($message) . "</div>";
    }
    return "<p>لم يتم العثور على منشورات أو أن البوت ليس مشرفاً في القناة.</p>";
}
?>
