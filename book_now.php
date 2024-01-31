<?php
session_start();
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);

    $data = ' schedule_id = ' . $sid . ' ';
    $data .= ', name = "' . $name . '" ';
    $data .= ', qty = "' . $qty . '" ';
    $data .= ', cnum = "' . $cnum . '"';  
    if (!empty($bid)) {
        $data .= ', status = "' . $status . '" ';
        $update = $conn->query("UPDATE booked SET " . $data . " WHERE id =" . $bid);
        if ($update) {
            echo json_encode(array('status' => 1));
        }
        exit;
    }

    $i = 1;
    $ref = '';
    while ($i == 1) {
        $ref = date('Ymd') . mt_rand(1, 9999);
        $chk_ref = $conn->query("SELECT * FROM booked WHERE ref_no='" . $ref . "'")->num_rows;
        //$chk_cnum = $conn->query("SELECT * FROM booked WHERE cnum='" . $cnum . "'")->num_rows;

        if ($chk_ref <= 0) {
            $i = 0;
        }
    }

    $data .= ', ref_no = "' . $ref . '" ';

    $insert = $conn->query("INSERT INTO booked SET " . $data);
    if ($insert) {
        echo json_encode(array('status' => 1, 'ref' => $ref, 'cnum' => $cnum));
    }
}
?>
