<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"));

$referenceNumber = $data->referenceNumber;
$uploadFolder = "upload/";

$filename = $uploadFolder . $referenceNumber . ".jpg";
if (file_exists($filename)) {
    echo json_encode(['match' => true]);
} else {
    echo json_encode(['match' => false]);
}
?>
