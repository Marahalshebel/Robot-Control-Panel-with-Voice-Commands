<?php
// بيانات الاتصال بقاعدة البيانات - غيّرها ببياناتك من InfinityFree
$host = "sql109.infinityfree.com";      // اسم السيرفر (Hostname)
$user = "if0_42403268";                // اسم المستخدم
$pass = "D4m668uxkCoQHqF";           // كلمة المرور
$dbname = "if0_42403268_task3web";   // اسم قاعدة البيانات

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "فشل الاتصال: " . $conn->connect_error]));
}
?>
