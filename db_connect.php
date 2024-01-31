<?php
$conn= new mysqli('localhost','root','','balbal');

if (!$conn)
{
    error_reporting(0);
    die("Could not connect to mysql".mysqli_error($conn));
}

?>