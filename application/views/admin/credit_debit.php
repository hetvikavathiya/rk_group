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
					 <?php if (!empty($row_data)) {?>
					<div class="px-5 pt-5 pb-0">
				        <div class='card p-3 m-0'>
					        <span class="text-center h2">Balance</span>
					         <span class="text-center h2"><?php if (!empty($row_data)) { echo $row_data['balance']; } ?> <i class="fa fa-inr" aria-hidden="true"></i></span>
					    </div>
					</div>
					<?php }?>
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
							<div class="icon-block text-center pt-2">
								 Account Opening Date : <?php if (!empty($row_data)) {
											echo date("d-m-Y", strtotime($row_data['account_open_date']));
										} ?>
							</div>
						</div>
					</div>
				</div>
				<?php if (!empty($customer_id) && !empty($row_data) && $row_data['account_status']==1) {?>
				<div class="col-lg-2 col-md-2 col-sm-3 col-3">
				    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">Credit</button>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-4 col-4">
				    <button type="button" class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Debit</button>
				</div>
    				<?php if(!empty($row_data) && $row_data['balance'] == 0){?>
    				<div class="col-lg-3 col-md-3 col-sm-4 col-4">
    				    <a href="<?=base_url('admin/credit_debit/close/');?><?php if(!empty($customer_id)){echo $customer_id;}?>" class="btn btn-danger"  onclick="return confirm('Are you sure?')">Close Bank Account</a>
    				</div>
    				<?php }?>
				
				<?php }else if(!empty($customer_id) && $row_data['account_status'] == 2){ echo 'Bank Account is Closed.';?>
				    
				<?php }?>
				
			</div>
		</div>
	</div>
</div>
	<?php if (!empty($customer_id)) {?>
<div class="row mt-3">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="card-title">Credit Debit Report</div>
				 <div class="row row-cards">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">From Date</label>
                            <input type="date" value="<?php echo date('Y-m-d') ?>"  class="form-control" id="from_date">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">To Date</label>
                            <input type="date" value="<?php echo date('Y-m-d') ?>"  class="form-control" id="to_date">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group pt-4 mt-1">
                            <button type="button" class="btn btn-primary search" id="search">Search</button>
                        </div>
                    </div>
                </div>
				<div class="table-responsive">
					<table class="table table-hover" id="example1">
						<thead>
							<tr>
								<th scope="col">Sl No</th>
								<th scope="col">Date</th>
								<th scope="col">Transaction Type</th>
								<th scope="col">Amount</th>
								<th scope="col">Balance</th>
								<th scope="col">Payment Mode</th>
								<th scope="col">Payment Proof</th>
								<th scope="col">Remark</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<!-- Modal -->
<div class="modal fade pay_amount_modal" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-image:url(<?= base_url('assets/'); ?>images/bg-themes/1.png);">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">CREDIT</h5>
        <button type="button" class="btn-close modal_close"></button>
      </div>
      <div class="modal-body">
        	<form method="post" action="<?=base_url('admin/credit_debit/credit/');?><?php if(!empty($customer_id)){echo $customer_id;}?>"  enctype="multipart/form-data">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<input type="hidden" value="<?php if(!empty($customer_id)){echo $customer_id;}?>" name="customer_id">
				<input type="hidden" value="" name="loan_emi_details_id" id="loan_emi_details_id">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="input-1">Date<span class="text-danger">*</span></label>
							<input type="date" class="form-control" value="<?php echo date('Y-m-d');?>" readonly id="p-date" name="date" required>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="input-33">Amount<span class="text-danger">*</span></label>
							<input type="number" step="any" class="form-control" id="input-33" placeholder="Enter Amount" name="amount" required>
						</div>
					</div>
			        <div class="col-lg-6">
						<div class="form-group">
							<label for="p_amount">payment mode<span class="text-danger">*</span></label>
						<select class="form-select" class="payment_mode" name="payment_mode" id="selected" required>
						    <option value="">Select Payment Mode</option>
						    <?php 
						    if(!empty($payment_mode)){
						    foreach($payment_mode as $payment_mode){?>
						        <option value="<?=$payment_mode['id'];?>"><?=$payment_mode['mode'];?></option>
						  <?php }} ?>
						</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="remark">payment proof</label>
							<input type="file" class="form-control" id="proof" name="proof">
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<label for="remark">remark</label>
							<input type="text" class="form-control" id="remark" placeholder="Enter Remark" name="remark">
						</div>
					</div>
				</div>
			    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal_close">Close</button>
                    <button type="submit" class="btn btn-primary pay">Submit</button>
                </div>
			</form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade pay_amount_modal" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-image:url(<?= base_url('assets/'); ?>images/bg-themes/1.png);">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">DEBIT</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        	<form method="post" action="<?=base_url('admin/credit_debit/debit/');?><?php if(!empty($customer_id)){echo $customer_id;}?>"  enctype="multipart/form-data">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<input type="hidden" value="<?php if(!empty($customer_id)){echo $customer_id;}?>" name="customer_id">
				<input type="hidden" value="" name="loan_emi_details_id" id="loan_emi_details_id">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="input-1">Date<span class="text-danger">*</span></label>
							<input type="date" class="form-control" value="<?php echo date('Y-m-d');?>" readonly id="p-date" name="date" required>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="input-33">Amount<span class="text-danger">*</span></label>
							<input type="number" step="any" class="form-control" id="input-33" placeholder="Enter Amount" name="amount" required>
						</div>
					</div>
			        <div class="col-lg-6">
						<div class="form-group">
							<label for="p_amount">payment mode<span class="text-danger">*</span></label>
						<select class="form-select" class="payment_mode" name="payment_mode" id="selected" required>
						    <option value="">Select Payment Mode</option>
						    <?php 
						      if(!empty($payment_mode2)){
						    foreach($payment_mode2 as $payment_mode){?>
						        <option value="<?=$payment_mode['id'];?>"><?=$payment_mode['mode'];?></option>
						  <?php }} ?>
						</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="remark">payment proof</label>
							<input type="file" class="form-control" id="proof" name="proof">
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<label for="remark">remark</label>
							<input type="text" class="form-control" id="remark" placeholder="Enter Remark" name="remark">
						</div>
					</div>
				</div>
			    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal_close">Close</button>
                    <button type="submit" class="btn btn-primary pay">Submit</button>
                </div>
			</form>
      </div>
    </div>
  </div>
</div>



<script>
    $(document).ready(function() {
      var userDataTable = $('#example1').DataTable({
			dom: 'Bfrtip',
			buttons: ['print', 'csv', 'excel', 'pdf'],
			processing: false,
			serverSide: true,
			paging: true,
			searching: false,
			ordering: false,
			'serverMethod': 'get',
			'ajax': {
					'url': '<?php echo base_url(); ?>admin/credit_debit/report',
				'data': function(data) {
				    data.from_date = $('#from_date').val();
                    data.to_date = $('#to_date').val();
                    data.c_id = <?php if(!empty($customer_id)){echo $customer_id;}else{echo 0;}?>;
				}
			},
			"columns": [{
					data: 'id'
				},
				{
					data: 'date'
				},
				{
					data: 'transaction_type'
				},
				{
					data: 'amount'
				},
				{
					data: 'balance'
				},
			
				{
					data: 'payment_mode'
				},
				{
					data: 'payment_proof'
				},
				{
					data: 'remark'
				},
			],
		});
		$(document).on('click', '#search', function() {
        userDataTable.draw();
        });
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

        $('.modal_close').click(function() {
            $('.pay_amount_modal').modal('hide');
        });
		$(document).on('change', '.permission', function() {
			var customer_id = $(this).val();
			var url = '<?= base_url("admin/credit_debit/profile/"); ?>';
			window.location.href = url + customer_id;
		});
			
    });
    
</script>