 <section id="" class="d-flex align-items-center">
<main id="main">
	<div class="container-fluid">
		<div class="col-lg-12">
			<?php  if(isset($_SESSION['login_id'])): ?>
			<div class="row">
				<div class="col-md-12">
					
				</div>
			</div>
		<?php endif; ?>
			<!-- <div class="row">
				&nbsp;
			</div> -->
			<div class="row">
			<!-- <h4 style="color:black;">List of Reservations</h4> -->
				<div class="card col-md-12">

				<div class="card-header">
						<div class="card-title"><b>List of Reservations</b></div>
						<form id="imageForm">
							<label>Checker</label>
							<input type="text" id="refnumField" placeholder="Enter Reference Number">
							<button type="button" class="btn btn-success" onclick="checkImage()">Check</button>
						</form>
					</div>
					
					<div class="card-body">
						<table class="table table-hover table-striped" id="booked-field">
							
							<thead class='thead-light'>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Payment Ref. No.</th>
									<th class="text-center">Name</th>
									<th class="text-center">Qty</th>
									<th class="text-center">Total Amt</th>
									<th class="text-center">Status</th>
									<th class="text-center">Paid Ref. No</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</main>
</section>
<script>

document.getElementById("imageForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the default form submission
    checkImage();
});

function checkImage() {
    var referenceNumber = document.getElementById("refnumField").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "checkImage.php", true); // Update the URL to your PHP file
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.match) {
                openImageFloatingWindow("upload/" + referenceNumber + ".jpg"); // Update the path and extension
            } else {
                alert("No match found.");
            }
        }
    };

    xhr.send(JSON.stringify({ referenceNumber: referenceNumber }));
}

function openImageFloatingWindow(imagePath) {
    var windowFeatures = "width=800,height=500,scrollbars=yes";
    var imageWindow = window.open("", "_blank", windowFeatures);
    imageWindow.document.write("<html><head><title>Proof of Payment</title></head><body><img src='" + imagePath + "'></body></html>");
}


	$('#new_schedule').click(function(){
		uni_modal('Add New Schedule','manage_schedule.php')
	})
	window.load_booked = function(){
		$('#booked-field').dataTable().fnDestroy();
		$('#booked-field tbody').html('<tr><td colspan="7" class="text-center">Please wait...</td></tr>')
		$.ajax({
			url:'load_booked.php',
			error:err=>{
				console.log(err)
				alert_toast('An error occured.','danger');
			},
			success:function(resp){
				if(resp){
					if(typeof(resp) != undefined){
						resp = JSON.parse(resp)
							if(Object.keys(resp).length > 0){
								$('#booked-field tbody').html('')
								var i = 1 ;
								Object.keys(resp).map(k=>{
									var tr = $('<tr></tr>');
									tr.append('<td class="text-center">'+(i++)+'</td>')
									tr.append('<td class="text-center">'+resp[k].ref_no+' <input type="text" id="refnumField" value="'+resp[k].ref_no+'" hidden></td>')
									tr.append('<td class="text-center">'+resp[k].name+'</td>')
									tr.append('<td class="text-center">'+resp[k].qty+'</td>')
									tr.append('<td class="text-center">₱ '+resp[k].amount+'</td>')
									tr.append('<td class="text-center">'+(resp[k].status == 1 ? 'Paid' :'Unpaid')+'</td>')
									tr.append('<td class="text-center"> '+resp[k].paid_ref+'</td>')
									
									$('#booked-field tbody').append(tr)

									
									tr.append('<td><center><button class="btn btn-sm btn-info mr-2 text-white edit_booked" data-id="'+resp[k].schedule_id+'" data-bid="'+resp[k].id+'">Edit</button></center></td>')
									
								})


							}else{
								$('#booked-field tbody').html('<tr><td colspan="7" class="text-center"><b>THEREs NO DATA HERE!!</b></td></tr>')
							}
					}
				}
			},
			complete:function(){
				$('#booked-field').dataTable()
				$('.edit_booked').click(function(){
					uni_modal('Edit Reservation','customer_book.php?id='+$(this).attr('data-id')+'&bid='+$(this).attr('data-bid'),1)
				})
			}
		})
	}
	
	$(document).ready(function(){
		load_booked()
	})

</script>