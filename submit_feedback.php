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
    echo 'Feedback sent successfully! Redirecting you to homepage in <span id="countdown"></span> seconds.';


} else {
    echo 'Error: ' . $sql . '<br>' . $conn->error;
}

?>

<script>
    
    function redirectToIndex() {
        window.location.href = 'index.php';
    }

    function countdownRedirect() {
        let countdown = 3;

        function updateCountdown() {
            countdown--;

            // Display countdown value
            document.getElementById('countdown').innerText = countdown;
            if (countdown <= 0) {
                redirectToIndex();
            } else {
                setTimeout(updateCountdown, 1000);
            }
        }
        updateCountdown();
    }
    countdownRedirect();
</script>