<?php
$refnum = $_GET['refnum'];
$name = $_GET['name'];
$cnum = $_GET['cnum'];
$pay_method = $_GET['pay_method'];

 include 'db_connect.php';
if(isset($_SESSION['login_id'])) include 'admin_navbar.php'; else include 'navbar.php';
?>

<!-- Bootstrap Modal  for Receipt and QR -->
<div class="modal fade" id="qrCodeModal" tabindex="-1" role="dialog" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrCodeModalLabel">Official Receipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center" style="padding: 20px;">
                <!-- Display the QR code image within the modal -->
                    <?php
                        if ($result->num_rows > 0) {
                            echo "<h3 class='mb-4' style='color: black'>Official Receipt</h3>";

                            //Reference Number
                            echo "<div class='form-group mb-3'>";
                            echo "<label for='refnum'>Receipt Number:</label>";
                            echo "<span class='ml-2'>$refnum</span>";
                            echo "</div>";

                            //Paid via
                            echo "<div class='form-group mb-3'>";
                            echo "<label for='refnum'>Payment done via </label>";
                            echo "<span class='ml-2'>$pay_method</span>";
                            echo "</div>";

                            // Thank You Message
                            echo "<p class='mb-4'>Thank you for choosing Antonina Line INC.</p>";

                            // Display Total Amount Paid
                            $row = $result->fetch_assoc();
                            $totalAmountPaid = $row['qty'] * $row['price'];
                            $formattedAmountPaid = number_format($totalAmountPaid);
                            echo "<div class='form-group mb-3'>";
                            echo "<label for='totalAmountPaid'>Total Amount Paid:</label>";
                            echo "<span class='ml-2'>₱$formattedAmountPaid</span>";
                            echo "</div>";

                            echo "<div class='form-group mb-3'>";
                            echo "<label for='name'>Name:</label>";
                            echo "<span class='ml-2'>$name</span>";
                            echo "</div>";
                            echo "<div class='form-group mb-4'>";
                            echo "<label for='cnum'>Contact Number:</label>";
                            echo "<span class='ml-2'>$cnum</span>";
                            echo "</div>";                    
                            echo "<p class='text-muted mb-4'>You can now take a screenshot of this or print this as your proof of purchase.</p>";
                            
                            //QR CODE API
                            $qrData = $refnum . '_' . $name . '_PAID' . '_VERIFIED_' . $cnum;
                            $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($qrData);
                            ?>
                            <img src="<?php echo $qrCodeUrl; ?>" alt="QR Code_Receipt" class="img-fluid mb-4">
                            <input type="hidden" name="qrData" value="<?php echo htmlspecialchars($qrData); ?>">
                            <?php
                        } else {
                            // No match found, display an error message or redirect back to the payment.php
                            echo "<p class='text-danger'>Error: Reference number and name do not match any records.</p>";
                        }
                    ?>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="printQRCode()">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="qrCodeModal" tabindex="-1" role="dialog" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
    <!-- The rest of your existing Bootstrap modal content... -->
</div>

<!-- Include the necessary Bootstrap and jQuery scripts here -->

<script>
    // Your existing JavaScript code....
     $(document).ready(function() {
        $('#loadingModal').modal('show');
        simulateLoading();
    });

    function simulateLoading() {
        var progressBar = $('#loadingProgressBar');
        var width = 0;

        var interval = setInterval(function() {
            width += 10;
            progressBar.css('width', width + '%');
            progressBar.attr('aria-valuenow', width);

            if (width >= 100) {
                clearInterval(interval);
                $('#loadingModal').modal('hide');
                $('#confirmationModal').modal('show');
            }
        }, 500);
    }

    //print receipt to buboy
    function printQRCode() {
        var printContents = document.getElementById('qrCodeModal').innerHTML;
        // var originalContents = document.body.innerHTML;
        // document.body.innerHTML = printContents;                  // THIS TWO MF FUCKS UP THE MODAL OVERALL AND NEEDS TO RELOAD THE PAGE TO RESPOND
        window.print();
        // document.body.innerHTML = originalContents;
    }
</script>

<?php
// Include the footer or any other common elements
include 'footer.php';
?>