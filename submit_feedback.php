<?php

include 'db_connect.php';


$type = $_POST['type'];
$feedback = $_POST['feedback'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];


$sql = "INSERT INTO tbl_feedback (Type, feedback, Fname, Lname, email, date_created) 
        VALUES ('$type', '$feedback', '$firstName', '$lastName', '$email', NOW())";

if ($conn->query($sql) === TRUE) {
    echo 'Feedback saved successfully!';
} else {
    echo 'Error: ' . $sql . '<br>' . $conn->error;
}

?>
