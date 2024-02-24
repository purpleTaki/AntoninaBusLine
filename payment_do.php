<?php
include "db_connect.php"; 

$refnum = $_POST['refnum'];
$name = $_POST['name'];
$cnum = $_POST['cNum'];
$pay_method = $_POST['Pmethod'];

function paidrefnumber() {
    $timestamp = time();
    $referenceNumber = date('YmdHis', $timestamp);
    return $referenceNumber;
}

$paidref_number = paidrefnumber();

//DATA JOINING from booked tbl with schedule_list tbl
$sql = "SELECT b.*, s.price
        FROM booked b
        JOIN schedule_list s ON b.schedule_id = s.id 
        WHERE b.ref_no = '$refnum' AND b.name = '$name'";

$result = $conn->query($sql);

if ($result === false) {
    die("Error: " . $conn->error);
}

if ($result->num_rows > 0) {
    $fileName = $_FILES['paymentProof']['name'];
    $fileTmpName = $_FILES['paymentProof']['tmp_name'];
    $uploadFolder = 'upload/';
    $targetFilePath = $uploadFolder . $paidref_number . '.' . pathinfo($fileName, PATHINFO_EXTENSION);

    if (move_uploaded_file($fileTmpName, $targetFilePath)) {
        $updateSql = "UPDATE booked SET status = 1, paid_ref = '$paidref_number' WHERE ref_no = '$refnum' AND name = '$name'";
    
        if ($conn->query($updateSql) === true) {
            include 'header.php';
            include 'db_connect.php';
            if(isset($_SESSION['login_id'])) include 'admin_navbar.php'; 
            else include 'navbar.php';
        } else {
            echo "Error updating status: " . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
} else {
    echo '<script>
            alert("Error: Reference number and name do not match any records.");
            window.location.href = "payment.php";
          </script>';
    exit;
}
?>

<input type="text" id="refnumField" value=<?php echo $paidref_number; ?> hidden/>
<!-- Bootstrap Loading Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loadingModalLabel">Processing Payment</h5>
            </div>
            <div class="modal-body text-center">
                <p>Thank you for your payment. Please wait while we process your transaction.</p>
                <div class="progress">
                    <div id="loadingProgressBar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <p>Congratulations! Your payment has been processed successfully.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="openReceiptWindow()">View Receipt</button>
                <button type="button" class="btn btn-primary" id="viewImageBtn">Proof of Payment</button>
                <a href="payment.php"><button type="button" class="btn btn-secondary">Go back to Payment Hub</button></a>
            </div>
        </div>
    </div>
</div>
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
                            echo "<span class='ml-2'>$paidref_number</span>";
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
                            //qty from booked tbl, price from schedule_list tbl
                            $totalAmountPaid = $row['qty'] * $row['price'];
                            $formattedAmountPaid = number_format($totalAmountPaid);
                            echo "<div class='form-group mb-3'>";
                            echo "<label for='totalAmountPaid'>Total Amount Paid:</label>";
                            echo "<span class='ml-2'>₱ $formattedAmountPaid</span>";
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
                            $qrData = $paidref_number . '_' . $name . '_PAID' . '_VERIFIED_' . $cnum;
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
<footer>
    <?php include 'feedback.php' ?>
</footer>
<script>
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
        }, 100);
    }


    function openReceiptWindow() {
        var newWindow = window.open('', 'ReceiptWindow', 'width=600,height=800');
        newWindow.document.write('<html><head>');
        newWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">');
        newWindow.document.write('<title>Official Receipt</title>');
        newWindow.document.write('</head><body>');
        newWindow.document.write('<div class="modal fade show" tabindex="-1" role="dialog" style="display: block;">');
        newWindow.document.write('<div class="modal-dialog modal-dialog-centered" role="document">');
        newWindow.document.write('<div class="modal-content">');
        newWindow.document.write('<div class="modal-header">');
        newWindow.document.write('<div class="modal-body text-center" style="padding: 20px;">');

        newWindow.document.write('<div class="modal fade show" tabindex="-1" role="dialog" style="display: block;">');
        newWindow.document.write('<div class="modal-dialog modal-dialog-centered" role="document">');
        newWindow.document.write('<div class="modal-content">');
        newWindow.document.write('<div class="modal-header">');
        newWindow.document.write('<h5 class="modal-title">Antonina Lines Inc</h5>');
        newWindow.document.write('</div>');
        newWindow.document.write('<div class="modal-body text-center" style="padding: 20px;">');
        newWindow.document.write('<?php if ($result->num_rows > 0) { ?>');
        newWindow.document.write('<h3 class="mb-4" style="color: black">Official Receipt</h3>');

        // Reference Number
        newWindow.document.write('<div class="form-group mb-3">');
        newWindow.document.write('<label for="refnum">Receipt Number:</label>');
        newWindow.document.write('<span class="ml-2"><?php echo $paidref_number; ?></span>');
        newWindow.document.write('</div>');

        // Paid via
        newWindow.document.write('<div class="form-group mb-3">');
        newWindow.document.write('<label for="refnum">Payment done via </label>');
        newWindow.document.write('<span class="ml-2"><?php echo $pay_method; ?></span>');
        newWindow.document.write('</div>');

        // Thank You Message
        newWindow.document.write('<p class="mb-4">Thank you for choosing Antonina Line INC.</p>');

        // Display Total Amount Paid
        newWindow.document.write('<div class="form-group mb-3">');
        newWindow.document.write('<label for="totalAmountPaid">Total Amount Paid:</label>');
        newWindow.document.write('<span class="ml-2">₱<?php echo number_format($totalAmountPaid); ?></span>');
        newWindow.document.write('</div>');

        newWindow.document.write('<div class="form-group mb-3">');
        newWindow.document.write('<label for="name">Name:</label>');
        newWindow.document.write('<span class="ml-2"><?php echo $name; ?></span>');
        newWindow.document.write('</div>');

        newWindow.document.write('<div class="form-group mb-4">');
        newWindow.document.write('<label for="cnum">Contact Number:</label>');
        newWindow.document.write('<span class="ml-2"><?php echo $cnum; ?></span>');
        newWindow.document.write('</div>');

        newWindow.document.write('<p class="text-muted mb-4">You can now take a screenshot of this or print this as your proof of purchase.</p>');

        // QR CODE API
        newWindow.document.write('<?php $qrData = $paidref_number . '_' . $name . '_PAID' . '_VERIFIED_' . $cnum; ?>');
        newWindow.document.write('<?php $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($qrData); ?>');
        newWindow.document.write('<img src="<?php echo $qrCodeUrl; ?>" alt="QR Code_Receipt" class="img-fluid mb-4">');
        newWindow.document.write('<input type="hidden" name="qrData" value="<?php echo htmlspecialchars($qrData); ?>">');

        newWindow.document.write('<?php } else { ?>');
        newWindow.document.write('<p class="text-danger">Error: Reference number and name do not match any records.</p>');
        newWindow.document.write('<?php } ?>');

        newWindow.document.write('</div>');
        newWindow.document.write('</div>');
        newWindow.document.write('</div>');
        newWindow.document.write('</div>');


        // Copy the content of the modal here
        //newWindow.document.write(document.getElementById('qrCodeModal').innerHTML);
        newWindow.document.write('</div></div></div></div>');
        newWindow.document.write('</body></html>');
        newWindow.document.close();

        
    }

        
    //print receipt to buboy
    function printQRCode() {
        var printContents = document.getElementById('qrCodeModal').innerHTML;
        // var originalContents = document.body.innerHTML;
        // document.body.innerHTML = printContents;                  // THIS TWO MF FUCKS UP THE MODAL OVERALL AND NEEDS TO RELOAD THE PAGE TO RESPOND
        window.print();
        // document.body.innerHTML = originalContents;
    }

    function openImageViewer(refnum) {
        var imageUrl = 'upload/' + refnum + '.jpg';
        var imageWindow = window.open(imageUrl, 'ImageViewer', 'width=600,height=800');
        if (window.focus) {
            imageWindow.focus();
        }
    }

    document.getElementById('viewImageBtn').addEventListener('click', function () {
        var refnum = document.getElementById('refnumField').value;
        openImageViewer(refnum);
    });
</script>

