<?php
session_start();

// Check if the user is logged in. If they're not, redirect them to the login page.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
	header('Location: ../index.html');
	exit;
}

// The user is logged in, so display the page here.


// include('inc/header.php');
?>
<title>Performance Computers LLC - ProActiveIT</title>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" href="css/style.css" />
<script src="js/ajax.js"></script>
<!-- <?php include('inc/container.php'); ?> -->
<div class="container contact">
	<h2 style="text-align:center">Performance Computers LLC<br />ProActiveIT</h2>
	<div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-10">
					<h3 class="panel-title"></h3>
				</div>
				<div class="col-md-2" align="right">
					<button type="button" name="add" id="addRecord" class="btn btn-success">Add New Record</button>
				</div>
			</div>
		</div>
		<table id="recordListing" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Device ID</th>
					<th>Due Date</th>
					<th>Client Name</th>
					<th>Package</th>
					<th>Payment Method</th>
					<th>AutoPay</th>
					<th>Amount</th>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Notes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					<th>ToS</th>
					<th>SLA</th>
					<th>PWNED</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
		</table>
	</div>
	<script>
		$(function() {
			$("#duedate").datepicker({
				dateFormat: 'mm/dd',
				changeYear: false, // this line disables the year dropdown
				showDropdowns: 'month',
				maxDate: new Date("9999", "0", "0"), // set a far future date to disable year selection entirely
			}).click(function() {
				$(this).datepicker('show');
			});
			$("#duedate").focus(function() {
				$(".ui-datepicker-year").hide(); // hide the year dropdown
			});
		});
	</script>
	<div id="recordModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="recordForm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Edit Cust Info</h4>
					</div>
					<div class="modal-body">
						<div class="form-group" <label for="devid" class="control-label">Device ID</label>
							<input type="text" class="form-control" id="devid" name="devid" placeholder="ID #" required>
						</div>
						<div class="form-group" <label for="duedate" class="control-label">duedate</label>
							<input type="text" class="form-control" id="duedate" name="duedate" placeholder="" required>
						</div>
						<div class="form-group" <label for="name" class="control-label">Name</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="" required>
						</div>
						<div class="form-group">
							<label for="package" class="control-label">Package</label>
							<input type="text" class="form-control" id="package" name="package" placeholder="">
						</div>
						<div class="form-group">
							<label for="paymeth" class="control-label">Payment Method</label>
							<input type="text" class="form-control" id="paymeth" name="paymeth" placeholder="">
						</div>
						<div class="form-group">
							<label for="autopay" class="control-label">AutoPay?</label>
							<input type="text" class="form-control" id="autopay" name="autopay" placeholder="">
						</div>
						<div class="form-group">
							<label for="amount" class="control-label">Amount</label>
							<input type="text" class="form-control" id="amount" name="amount" placeholder="$">
						</div>
						<div class="form-group">
							<label for="notes" class="control-label">Notes</label>
							<textarea class="form-control" rows="5" class="form-control" id="notes" name="notes" placeholder="">
							</textarea>
						</div>
						<div class="form-group">
							<label for="tos" class="control-label">ToS</label>
							<input type="text" class="form-control" id="tos" name="tos" placeholder="ver.#">
						</div>
						<div class="form-group">
							<label for="sla" class="control-label">SLA</label>
							<input type="text" class="form-control" id="sla" name="sla" placeholder="ver.#" required>
						</div>
						<div class="form-group">
							<label for="pwned" class="control-label">PWNED</label>
							<input type="text" class="form-control" rows="5" id="pwned" name="pwned">
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="id" id="id" />
						<input type="hidden" name="action" id="action" value="" />
						<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include('inc/footer.php'); ?>