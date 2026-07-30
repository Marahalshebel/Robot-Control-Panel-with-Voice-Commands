<?php

header("Content-Type: application/json");

include "db.php";

if (!isset($_POST["text"])) {
    echo json_encode([
        "status" => "error",
        "message" => "No speech received."
    ]);
    exit;
}

$text = strtolower(trim($_POST["text"]));

$command = "";

if (strpos($text, "forward") !== false) {
    $command = "forward";
}
elseif (strpos($text, "backward") !== false) {
    $command = "backward";
}
elseif (strpos($text, "left") !== false) {
    $command = "left";
}
elseif (strpos($text, "right") !== false) {
    $command = "right";
}
elseif (strpos($text, "stop") !== false) {
    $command = "stop";
}
else {
    echo json_encode([
        "status" => "error",
        "message" => "Unknown command."
    ]);
    exit;
}

$map = [
    "forward"  => "f",
    "backward" => "b",
    "left"     => "l",
    "right"    => "r",
    "stop"     => "S"
];

$stored = $map[$command];

/* تحديث أمر الروبوت */

$stmt = $conn->prepare("UPDATE robot_state SET command=? WHERE id=1");
$stmt->bind_param("s", $stored);
$stmt->execute();

/* حفظ الكلام في السجل */

$stmt2 = $conn->prepare(
    "INSERT INTO speech_logs (spoken_text, detected_command)
     VALUES (?, ?)"
);

$stmt2->bind_param("ss", $text, $command);
$stmt2->execute();

echo json_encode([
    "status" => "success",
    "command" => $command
]);

$stmt->close();
$stmt2->close();

$conn->close();

?>