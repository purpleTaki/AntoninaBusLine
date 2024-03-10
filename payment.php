

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
    <div class="form-group">
        <input class="form-check-input" type="checkbox" id="termsCheckbox">
        I have read the <strong><a href="#" id="termsLink"> terms and conditions</a></strong>.
    </div>
    <button type="submit" class="btn btn-success" id="btn_pay" style="width: 100%;" disabled>Pay</button>
    
    <!-- Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Terms and conditions content -->
                    <p>
                        Thank you for choosing our services. Before you proceed with your payment and reservation, please take a moment to carefully read and understand Antonina Line's "No Refund Policy."
                    </p>
                    <p>
                        By proceeding with the payment, you acknowledge and agree to the following terms and conditions:
                    </p>
                    <ul>
                        <li>Non-Refundable Payment: The payment made for the reservation is non-refundable under any circumstances.</li>
                        <li>Cancellation Policy: Once the payment is completed, you cannot cancel your reservation, and no refunds will be issued. You can only reschedule your reservation.</li>
                        <li>Confirmation of Understanding: By proceeding with the payment, you confirm that you have read and understood our No Refund Policy.</li>
                        <li>Inquiries and Clarifications: Please carefully review all reservation details before making the payment. Ensure that all information is accurate to avoid any issues.</li>
                        <li>Payment Authorization: You authorize the payment for the reservation and acknowledge that it is non-refundable.</li>
                        <li>No Exceptions: Our No Refund Policy applies to all reservations, and no exceptions will be made.</li>
                    </ul>
                    <p>
                        In case you need assistance or have questions, you can contact our customer support on our <a href="https://www.facebook.com/antoninalineofficial" target="_blank">Facebook page</a>.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Decline</button>
                    <button type="button" class="btn btn-primary" id="acceptBtn">Accept</button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>



<footer>
    <?php include 'feedback.php' ?>
</footer>
</body>

<script>

    const termsLink = document.getElementById('termsLink');
    const termsModal = document.getElementById('termsModal');
    const acceptBtn = document.getElementById('acceptBtn');
    const submitBtn = document.getElementById('btn_pay');

    
    termsLink.addEventListener('click', function(e) {
        e.preventDefault();
        $('#termsModal').modal('show');
    });

    
    acceptBtn.addEventListener('click', function() {
        $('#termsModal').modal('hide');
        document.getElementById('termsCheckbox').checked = true;
        submitBtn.disabled = false;
    });

    
    document.getElementById('termsCheckbox').addEventListener('change', function() {
        if (this.checked) {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    });

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