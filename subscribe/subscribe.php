<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email)) {
    $email = filter_var($data->email, FILTER_VALIDATE_EMAIL);

    if ($email) {
        file_put_contents("subscribers.txt", $email . PHP_EOL, FILE_APPEND);

        http_response_code(200);
        echo json_encode(["message" => "สมัครรับข่าวสารเรียบร้อยแล้ว"]);
    } else {
        http_response_code(400);
        echo json_encode(["message" => "อีเมลไม่ถูกต้อง"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "ไม่มีข้อมูลอีเมลส่งมา"]);
}
?>
