<style>
    .modal-body table {
        table-layout: fixed;
        width: 100%;
    }
    .modal-body td {
        word-wrap: break-word;
        max-width: 200px; 
    }
</style>

<button type="button" class="btn btn-primary floating-feedback-btn" data-toggle="modal" data-target="#feedbackModal">
    <i class="fa fa-comment"></i> 
</button>

<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feedbackModalLabel">Feedback Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Feedback</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Date Created</th>
                            </tr>
                            <?php
                                // Retrieve feedback data from database
                                include 'db_connect.php';

                                $sql = "SELECT * FROM tbl_feedback";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td >".$row["Type"]."</td>";
                                        echo "<td class='text-center'>".$row["feedback"]."</td>";
                                        echo "<td>".$row["Fname"]."</td>";
                                        echo "<td>".$row["Lname"]."</td>";
                                        echo "<td>".$row["email"]."</td>";
                                        echo "<td>".$row["date_created"]."</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No feedback data available</td></tr>";
                                }

                                // Close database connection
                                $conn->close();
                            ?>
                        </thead>
                        <tbody id="feedbackData"></tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<script>

$(document).ready(function() {
    $('#viewFeedbackBtn').click(function() {
        // Fetch feedback data via AJAX and populate the modal
        $.ajax({
            url: 'fetch_feedback.php',
            success: function(response) {
                $('#feedbackData').html(response);
                $('#feedbackModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('An error occurred while fetching feedback data.');
            }
        });
    });
});

</script>