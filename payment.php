

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Online Bus Booking System</title>

</head>


<body>
<?php session_start() ?>
<?php
 include 'header.php'; include 'db_connect.php'; ?>
<?php if(isset($_SESSION['login_id'])) include 'admin_navbar.php'; else include 'navbar.php'; ?>


<div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-body text-white">
  </div>
</div>
</br>
<div class="container" style="width:30%; padding:80px; background-color: rgba(255,255,255,0.8); border-radius: 35px;">
<form action="payment_do.php" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data">
    <h2 style="color: black;">Pay here.</h2></br>
    <div class="form-group">
        <label for="refnum">PAYMENT REFERENCE NUMBER</label>
        <small id="emailHelp" class="form-text text-muted">Printing your ticket requires you to save the reference number.</small>
        <input type="text" class="form-control" id="refnum" name="refnum" placeholder="12 digit reference #" maxlength="12" autocomplete="off" autofocus required>
    </div>
    <div class="form-group">
        <label for="Lname">Full Name</label>
        <small id="emailHelp" class="form-text text-muted">Must be the same name you registered with.</small>
        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" autocomplete="off" required>
    </div>
    <div class="form-group">
        <label for="cNum">Contact #</label>
        <input type="tel" class="form-control" id="cNum" name="cNum" placeholder="Contact Number" autocomplete="off" required >
    </div>
    <div class="form-group">
        <label for="Pmethod">Payment Method</label>
        <select class="form-control" id="Pmethod" name="Pmethod">
            <option select hidden> -- PAYMENT METHOD --</option>
            <option >GCASH - 09066544054</option>
            <option >MAYA - 09066544054</option>
        </select>
    </div>
     <!-- dito ung upload field -->
     <div class="form-group">
        <label for="paymentReceipt">Proof of Payment</label>
        <input type="file" class="form-control" id="paymentProof" name="paymentProof" accept="image/*" required>
    </div>

    <button type="submit" class="btn btn-success" id="btn_pay" style="width: 100%;">Proceed</button>
    

</form>
</div>



<footer>
    <?php include 'feedback.php' ?>
</footer>
</body>

<script>


    function validateForm() {
        var paymentMethod = document.getElementById('Pmethod').value;

        if (paymentMethod.trim() === '-- PAYMENT METHOD --') {
            alert('Please select a valid payment method.');
            return false; // meaning ndi sila nag select ng gcash or maya
        }
        return true; 
    }

    
</script>


</html>