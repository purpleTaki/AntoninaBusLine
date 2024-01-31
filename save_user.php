<?php
include('db_connect.php');

extract($_POST);

// Hash the password with MD5
$hashedPassword = md5($password);

$data = " name = '$name' ";
$data .= ", username = '$username' ";
$data .= ", password = '$hashedPassword' ";

if (empty($id)) {
    $insert = $conn->query("INSERT INTO users SET " . $data);
    if ($insert) {
        echo 1;
    }
} else {
    $update = $conn->query("UPDATE users SET " . $data . " WHERE id = " . $id);
    if ($update) {
        echo 1;
    }
}
?>
