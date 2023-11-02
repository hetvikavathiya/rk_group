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
				<?php if (!empty($row_data['photo']) &&!empty($row_data['frontside_document']) && !empty($row_data['backside_document']) && !empty($row_data['document_type']) && !empty($row_data['signature']) && $row_data['account_status'] == 0) { ?>
					<div class="col-lg-12">
						<div class="form-group">
							<button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" class="btn btn-primary px-5">Open Account</button>
						</div>
					</div>
				<?php }else if(!empty($row_data) && $row_data['account_status'] == 0){ ?>
				    <div class="col-lg-12">
				        <h6>Please Below Document To Open Account (<?php if(empty($row_data['photo'])){echo 'Photo, ';}?><?php if(empty($row_data['frontside_document, '])){echo 'Frontside Document,';}?><?php if(empty($row_data['backside_document'])){echo 'Backside Document, ';}?><?php if(empty($row_data['signature'])){echo 'Signature, ';}?><?php if(empty($row_data['document_type'])){echo 'Document Type';}?>)</h6>
						<div class="form-group">
							<a href="<?=base_url('admin/customer_report/edit/');?><?php if(!empty($customer_id)){echo $customer_id;}?>/1" class="btn btn-primary px-5">Upload Document</a>
						</div>
					</div>
				<?php }else if(!empty($row_data)){ ?>
				 	<span>Account Already Exists &nbsp;<a href="<?=base_url('admin/credit_debit/profile/');?><?php if(!empty($customer_id)){echo $customer_id;}?>" class="btn btn-primary px-5">View Account</a></span>
			<?php }?>
			</div>
		</div>
	</div>
</div>

<!--Modal open account-->
<?php if(!empty($customer_id)){?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" style="background-image:url(<?= base_url('assets/'); ?>images/bg-themes/1.png);">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Open Account</h5>
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url('admin/account/open/' . $customer_id); ?>"  enctype="multipart/form-data">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="input-1">Open Account Date<span class="text-danger">*</span></label>
								<input type="date" class="form-control" value="<?php echo date('Y-m-d');?>" readonly id="p-date" name="open_a_date" required>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="input-33">Amount<span class="text-danger">*</span></label>
								<input type="number" step="any" class="form-control" id="input-33" name="amount" value="<?php if(!empty($open_account_charge['open_account_charge'])){echo $open_account_charge['open_account_charge'];}?>" required>
							</div>
						</div>
						<div class="col-lg-4">
    						<div class="form-group">
    							<label for="p_amount">payment mode<span class="text-danger">*</span></label>
    						    <select class="form-select" class="payment_mode" name="payment_mode" id="selected" required>
        						    <option value="">Select Payment Mode</option>
        						    <?php
        						    if(!empty($payment_mode)){
        						    foreach($payment_mode as $payment_mode){?>
        						        <option value="<?=$payment_mode['id'];?>"><?=$payment_mode['mode'];?></option>
        						    <?php } }?>
    						    </select>
    						</div>
						</div>
						<div class="col-lg-6">
    						<div class="form-group">
    							<label for="remark">remark</label>
    							<input type="text" class="form-control" id="remark" placeholder="Enter Remark" name="remark">
    						</div>
					    </div>
    					<div class="col-lg-6">
    						<div class="form-group">
    							<label for="remark">payment proof</label>
    							<input type="file" class="form-control" id="proof" name="proof">
    						</div>
    					</div>
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
<?php }?>
<script>
    $(document).ready(function() {
        $('#profile-hide').hide();
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
			var url = '<?= base_url("admin/account/profile/"); ?>';
			window.location.href = url + customer_id;
		});
    });
</script>