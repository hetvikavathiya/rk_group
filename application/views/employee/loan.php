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
<div class="row">
	<div class="col-lg-12">
		<div class="card p-3">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 col-12">
					<label for="select121">Aadhaar Card No<span class="text-danger">*</span></label>
					<select class="form-select permission" id="select121" aria-label="Default select example" required>
						<option selected value="">Select Customer</option>
						<?php if (!empty($customer)) {
							foreach ($customer as $customer) {
						?>
								<option value="<?= $customer['id']; ?>" <?php if (!empty($customer_id) && $customer_id == $customer['id']) {
																			echo 'selected';
																		} ?>><?= $customer['aadhar_card']; ?> (<?= $customer['first_name']; ?> <?= $customer['middle_name']; ?> <?= $customer['last_name']; ?>)</option>
						<?php }
						} ?>
					</select>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-12" id='profile-hide'>
					<div class="card profile-card-2">
						<div class="card-img-block">
						</div>
						<div class="card-body pt-5">
							<img src="<?= base_url('upload/'); ?><?php if(!empty($row_data['photo'])){echo $row_data['photo'];}else{ echo 'avatar.png';}?>" alt="profile-image" class="profile">
							<h5 class="card-title text-center pt-3">Name : <?php if (!empty($row_data)) {
																echo $row_data['first_name'];
															} ?> <?php if (!empty($row_data)) {
																		echo $row_data['middle_name'];
																	} ?> <?php if (!empty($row_data)) {
																				echo $row_data['last_name'];
																			} ?></h5>
							<p class="card-text text-center"> Mobile No : <?php if (!empty($row_data)) {
																	echo $row_data['mobile'];
																} ?></p>
							<div class="icon-block text-center">
								Email : <?php if (!empty($row_data)) {
											echo $row_data['email'];
										} ?>
							</div>
						</div>
					</div>
				</div>
				<?php if (!empty($row_data)) { ?>
					<div class="col-lg-12">
						<div class="form-group">
							<button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" class="btn btn-primary px-5"> Create Loan</button>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<div class="row mt-3 loan_report">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header justify-content-between">
				<h3 class="card-title"><b>Loan Report</h3>
			</div>
			<input type="hidden" value="<?php if(!empty($customer_id)){echo $customer_id;}?>" id="customer_id">
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" style="background-image:url(<?= base_url('assets/'); ?>images/bg-themes/1.png);">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Create Loan</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url('employee/loan/create/' . $customer_id); ?>">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
					<span>Reference Person 1</span>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="input-1">Name<span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="input-1" name="name" placeholder="Enter Name" required>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="input-33">Mobile No<span class="text-danger">*</span></label>
								<input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" pattern=".{10,}" minlength="10" maxlength="10" class="form-control" id="input-33" name="mobile" placeholder="Enter Your Mobile No" required>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="input-3311">Aadhaar Card No<span class="text-danger">*</span></label>
								<input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" pattern=".{10,}" minlength="12" maxlength="12" class="form-control" id="input-3311" name="aadhar_card" placeholder="Enter Aadhaar Card No" required>
							</div>
						</div>
					</div>
					<span>Reference Person 2</span>
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="input-1">Name<span class="text-danger">*</span></label>
								<input type="text" class="form-control" id="input-1" name="name_2" placeholder="Enter Name" required>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="input-33">Mobile No<span class="text-danger">*</span></label>
								<input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" pattern=".{10,}" minlength="10" maxlength="10" class="form-control" id="input-33" name="mobile_2" placeholder="Enter Your Mobile No" required>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="input-3311">Aadhaar Card No<span class="text-danger">*</span></label>
								<input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" pattern=".{10,}" minlength="12" maxlength="12" class="form-control" id="input-3311" name="aadhar_card_2" placeholder="Enter Aadhaar Card No" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="input-33">Loan Amount<span class="text-danger">*</span></label>
								<input type="number" step="any" class="form-control loan_amount calculating" id="input-33" name="loan_amount" placeholder="Enter Your Amount" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="input-33">Loan Interest<span class="text-danger">*</span></label>
								<input type="number" step="any" class="form-control loan_interest calculating" id="input-33" name="loan_interest" placeholder="Enter Loan Interest" required>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="input-33">Starting Date<span class="text-danger">*</span></label>
								<input type="date" class="form-control s_date calculating" id="input-33" name="s_date" required>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="input-33">Ending Date<span class="text-danger">*</span></label>
								<input type="date" class="form-control e_date calculating" id="input-33" name="e_date" required>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="input-33">Fixed Charge<span class="text-danger">*</span></label>
								<input type="number" step="any" class="form-control fixed_charge calculating" id="input-33" name="fixed_charge" placeholder="Enter Charge" required>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="input-33">Payable Amount<span class="text-danger">*</span></label>
								<input type="number" step="any" class="form-control payable_amount" id="input-33" name="payable_amount" placeholder="Payable Amount" readonly>
							</div>
						</div>
					</div>
					<div id="append_emi_data">
						<div class="row">
							<div class="col-lg-4">
								<div class="form-group">
									<label for="input-33">INSTALLMENT DATE<span class="text-danger">*</span></label>
									<input type="date" class="form-control" id="input-33" name="installment_date[]" required>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<label for="input-33">INSTALLMENT Amount<span class="text-danger">*</span></label>
									<input type="number" step="any" class="form-control installment_amount" id="input-33" name="installment_amount[]" placeholder="Enter Amount" required>
								</div>
							</div>
						</div>
					</div>
	                <div class="col-lg-3 my-3 p-0">
						<span class="btn btn-light" id="add_emi_btn">Add EMI Installment</span>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary create_loan">Submit</button>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>
<div class="add_one_data">
	<div class="row">
		<div class="col-lg-4">
			<div class="form-group">
				<label for="input-33">INSTALLMENT DATE<span class="text-danger">*</span></label>
				<input type="date" class="form-control" id="input-33" name="installment_date[]" required>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-group">
				<label for="input-33">INSTALLMENT Amount<span class="text-danger">*</span></label>
				<input type="number" step="any" class="form-control installment_amount" id="input-33" name="installment_amount[]" placeholder="Enter Amount" required>
			</div>
		</div>
		<div class="col-lg-4 pt-4">
			<a href="javascript:void(0)" class="remove_row"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a>
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
        $(':input[type="submit"]').prop('disabled', true);
    	$('body').on('change', '.installment_amount', function() {
            var p_amount = $('.payable_amount').val();
            var i_amount = 0;
            for(var i = 0; i < $('.installment_amount').length; i++){
                var one = parseFloat($('.installment_amount:eq('+i+')').val());
                i_amount += isNaN(parseFloat(one)) ? 0 : parseFloat(one);
            }
            if(p_amount == i_amount){
                $(':input[type="submit"]').prop('disabled', false);
            }else{
                alert('Payable Amount And Installment Amount Are Not Same');
                $(':input[type="submit"]').prop('disabled', true);
            }
        });
        $('.create_loan').click(function() {
          return confirm('Are you sure?')
        });
		// csrf token
		var csrf_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
		var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';

		$('#profile-hide').hide();
		$('.add_one_data').hide();
		$('.loan_report').hide();
		$(".permission").select2({
			placeholder: "Select a Aadhaar Card No",
			allowClear: true
		});

		<?php if (!empty($customer_id)) { ?>
			$('#profile-hide').show();
			$('.loan_report').show();
		<?php } ?>


		$(document).on('change', '.permission', function() {
			var customer_id = $(this).val();
			var url = '<?= base_url("employee/loan/profile/"); ?>';
			window.location.href = url + customer_id;
		});

		var main_row = "";
		main_row = $(".add_one_data").html();

		$(document).on('click', '#add_emi_btn', function() {
			$('#append_emi_data').append(main_row);
		});

		$(document).on('click', '.remove_row', function() {
			$(this).parent().parent().remove();
			var p_amount = $('.payable_amount').val();
            var i_amount = 0;
            for(var i = 0; i < $('.installment_amount').length; i++){
                var one = parseFloat($('.installment_amount:eq('+i+')').val());
                i_amount += isNaN(parseFloat(one)) ? 0 : parseFloat(one);
            }
            if(p_amount == i_amount){
                $(':input[type="submit"]').prop('disabled', false);
            }else{
                alert('Payable Amount And Installment Amount Are Not Same');
                $(':input[type="submit"]').prop('disabled', true);
            }
		});

		$(document).on("keyup change", ".calculating", function() {
			// var data = parseFloat($(this).val()) || 0;

			var loan_amount = $(this).val();
			var loan_interest = $(this).val();
			var fixed_charge = $(this).val();
			var s_date = $(this).val();
			var e_date = $(this).val();

			if (loan_amount > 0 && loan_interest > 0 && fixed_charge > 0 && s_date != "" && e_date != "") {
				calculatingAmount($(this));
			} else {
				calculatingAmount($(this));
			}
		});

		function calculatingAmount(row) {
			var mainRef = row.parent().parent().parent();

			var loan_interest = parseFloat(mainRef.find(".loan_interest").val()) || 0;
			var loan_amount = parseFloat(mainRef.find(".loan_amount").val()) || 0;
			var fixed_charge = parseFloat(mainRef.find(".fixed_charge").val()) || 0;

			var starting_date = mainRef.find(".s_date").val();
			var ending_date = mainRef.find(".e_date").val();

			const diff = new Date(ending_date) - new Date(starting_date);
			const numberOfDays = (diff / (1000 * 60 * 60 * 24));

			var year = parseFloat(numberOfDays / 365);

			// console.log(year, "year");

			var interest_final = ((year * loan_interest) / 1);

			// console.log(interest_final, "interest_final");

			var interest_amount = ((interest_final * loan_amount) / 100);

			// console.log(interest_amount, "interest_amount");

			var payable_amount = loan_amount + interest_amount + fixed_charge;

			$(".payable_amount").val(payable_amount.toFixed(2));
		}

		$(document).on("click", ".loan_details", function() {
			$("#loan_details_modal").modal('show');
			$("#loan_details_append").html(null);
			var loan_id = $(this).data("loan_id");
            var customer_id = $('#customer_id').val();
			$.ajax({
				url: "<?= base_url("employee/loan/get_loan_details"); ?>",
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
				'url': '<?php echo base_url(); ?>employee/loan/report',
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
			"dom": 'lBfrtip',
			"buttons": [
				'copy', 'csv', 'excel', 'pdf', 'print',
			],
		});

		$(document).on("change", "#aadhar_card_no", function() {
			loanData.clear();
			loanData.draw();
		});

	});
</script>
