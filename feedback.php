<button type="button" class="btn btn-primary floating-feedback-btn" data-toggle="modal" data-target="#feedbackModal">
    <i class="fa fa-comment"></i> 
</button>

<div class="modal fade" id="feedbackModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Feedback Form</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="modalBody">
                        <h2>Feedback Form</h2>
                        <form action="submit_feedback.php" method="post">
                        <div class="form-group">
                            <label>Type of Feedback:</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="commentRadio" value="Comment">
                                    <label class="form-check-label" for="commentRadio">Comment</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="suggestionRadio" value="Suggestion">
                                    <label class="form-check-label" for="suggestionRadio">Suggestion</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="questionRadio" value="Question">
                                    <label class="form-check-label" for="questionRadio">Question</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="feedback">Feedback Description:</label>
                            <textarea class="form-control" id="feedback" name="feedback" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="firstName">First Name:</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last Name:</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
					</div>
					<div class="modal-footer ">
						For more info! Visit our <a href="https://www.facebook.com/antoninalineofficial"> Facebook </a>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
      	</div>