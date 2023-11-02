 <style>
	.form-select {
		border: 0px solid #e5eaef;
		background-color: rgba(255, 255, 255, 0.2);
		color: #fff !important;
	}

	.form-select:focus {
		background-color: rgba(0, 0, 0, .2);
		box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.45)
	}

	.select2-container--default .select2-results__option--selected {
		background-color: #007bff;
	}

	.select2-results__option {
		background: #0d0d0d;
	}

	.select2-container--default .select2-selection--single {
		border: 0px solid #e5eaef;
		background-color: rgba(255, 255, 255, 0.2);
		height: 40px;
		color: #fff !important;
	}

	.select2-container--default .select2-selection--single .select2-selection__rendered {
		color: white;
		padding: 6px;
	}

	.select2-container--default .select2-selection--single .select2-selection__choice__display {
		color: #000;
	}

	.profile-card-2 .card-img-block {
		height: 70px;
	}

	.profile-card-2 .profile {
		left: 50%;
		top: -68px;
		width:100%;
		max-width: 118px;
		max-height: 130px;
	}
</style>
<div class="row mt-3 loan_report">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header justify-content-between">
				<h3 class="card-title"><b>Loan Report</h3>
			</div>
			<div class="card-body">
				<div class="table-responsive mt-3">
					<table class="table table-hover" id="loan_report">
						<thead>
							<tr>
								<th>SR No</th>
								<th>Loan Details</th>
								<th>Unique Id</th>
								<th>Customer Name</th>
								<th>Name</th>
								<th>Loan Amount</th>
								<th>Mobile No</th>
								<!-- <th>Starting Date</th>
								<th>Ending Date</th>
								<th>Aadhar Card No</th>
								<th>P2 Name</th>
								<th>P2 Mobile No</th>
								<th>P2 Aadhar Card No</th>
								<th>Loan Interest</th>
								<th>Fixed Charge</th>
								<th>Payable Amount</th> -->
								<th>Created At</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="loan_details_modal" tabindex="-1" databs-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" style="background-image:url(<?= base_url('assets/'); ?>images/bg-themes/1.png);">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Loan Details</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
			</div>
			<div id="loan_details_append">
				<div class="d-flex justify-content-center" id="loading_loan_details" style="display: none;">
					<div class="spinner-border" role="status">
						<span class="sr-only">Loading...</span>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
	    	// csrf token
		var csrf_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
		var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
		var loanData = $('#loan_report').DataTable({
			"iDisplayLength": 25,
			"fixedHeader": true,
			"lengthMenu": [
				[10, 25, 50, 100, 500, 1000, 5000],
				[10, 25, 50, 100, 500, 1000, 5000]
			],
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			'ajax': {
				'url': '<?php echo base_url(); ?>customer/loan_report/report',
				'data': {
					[csrf_name]: csrf_token,
					customer_id: $('#customer_id').val()
				}
			},
			"columns": [{
					data: 'sno'
				},
				{
					data: 'loan_details'
				},
				{
					data: 'unique_id'
				},
				{
					data: 'customer_name'
				},
				{
					data: 'name'
				},
			    {
					data: 'loan_amount'
				},
				{
					data: 'mobile'
				},
				{
					data: 'created_at'
				},
			],
			"dom": 'Bfrtip',
			"buttons": [
				'copy', 'csv', 'excel', 'pdf', 'print',
			],
		});
	    $(document).on("click", ".loan_details", function() {
			$("#loan_details_modal").modal('show');
			var loan_id = $(this).data("loan_id");
            var customer_id = $('#customer_id').val();
			$.ajax({
				url: "<?= base_url("customer/loan_report/get_loan_details"); ?>",
				type: "POST",
				timeout: 5000,
				processData: true,
				data: {
					[csrf_name]: csrf_token,
					loan_id: loan_id,
					customer_id:customer_id
				},
				beforeSend: function() {
					$("#loading_loan_details").show();
				},
				success: function(response) {
					$("#loan_details_append").html(response);
				},
				complete: function() {
					$("#loading_loan_details").hide();
				},
			});

		});
		$(document).on("change", "#aadhar_card_no", function() {
			loanData.clear();
			loanData.draw();
		});

	});
</script>
