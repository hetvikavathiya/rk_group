<style>
	.color {
		color: white;
	}
</style>
<div class="modal-body">
	<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="pills-loan_details-tab" data-toggle="pill" href="#pills-loan_details" role="tab" aria-controls="pills-loan_details" aria-selected="true">Loan Details</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="pills-loan_emi_details-tab" data-toggle="pill" href="#pills-loan_emi_details" role="tab" aria-controls="pills-loan_emi_details" aria-selected="false">Installment Details</a>
		</li>
	</ul>
	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade show active" id="pills-loan_details" role="tabpanel" aria-labelledby="pills-loan_details-tab">
			<table class="table table-striped table-bordered">
				<tbody>
					<tr>
						<th class="color">Loan Amount</th>
						<td class="color"><?= $loan['loan_amount'] ?></td>
					</tr>
					<tr>
						<th class="color">Loan Interest</th>
						<td class="color"><?= $loan['loan_interest']; ?> %</td>
					</tr>
					<tr>
						<th class="color">Fixed Charge</th>
						<td class="color"><?= $loan['fixed_charge']; ?></td>
					</tr>
					<tr>
						<th class="color">Payable Amount</th>
						<td class="color"><?= $loan['payable_amount']; ?></td>
					</tr>
					<tr>
						<th class="color">Starting Date</th>
						<td class="color"><?= date("d-m-Y", strtotime($loan['s_date'])) ?></td>
					</tr>
					<tr>
						<th class="color">Ending Date</th>
						<td class="color"><?= date("d-m-Y", strtotime($loan['e_date'])) ?></td>
					</tr>
					<tr>
						<th class="color">Reference Person Name</th>
						<td class="color"><?= $loan['name'] ?></td>
					</tr>

					<tr>
						<th class="color">Reference Person Mobile</th>
						<td class="color"><?= $loan['mobile'] ?></td>
					</tr>
					<tr>
						<th class="color">Reference Person Aadhaar Card</th>
						<td class="color"><?= $loan['aadhar_card'] ?></td>
					</tr>
					<tr>
						<th class="color">Reference Person 2 Name</th>
						<td class="color"><?= $loan['name_2'] ?></td>
					</tr>
					<tr>
						<th class="color">Reference Person 2 Mobile</th>
						<td class="color"><?= $loan['mobile_2'] ?></td>
					</tr>
					<tr>
						<th class="color">Reference Person 2 Aadhaar Card</th>
						<td class="color"><?= $loan['aadhar_card_2'] ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="tab-pane fade" id="pills-loan_emi_details" role="tabpanel" aria-labelledby="pills-loan_emi_details-tab">
		    <div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<th>Installment<br> Date</th>
					<th>Installment<br> Amount</th>
					<th>Status</th>
					<th>Payment <br>Date</th>
					<th>Late Fee<br> Charge</th>
					<th>Payment Mode</th>
					<th>Payment<br> Proof</th>
					<th>Remark</th>
				</thead>
				<tbody>
					<?php
					foreach ($loan_details as $row_loan_details) {
					    if($row_loan_details['status']=='Received'){
					        $color="success";
					    }else{
					         $color="danger";
					    }
					?>
						<tr>
							<td class="color"><?= date("d-m-Y", strtotime($row_loan_details['installment_date'])); ?></td>
							<td class="color"><?= $row_loan_details['installment_amount'];?></td>
							<td class="color"><span class="badge badge-<?=$color;?>"><?= $row_loan_details['status']; ?></span> <?php if($row_loan_details['status']=='Pending'){?>  &nbsp;&nbsp;&nbsp;&nbsp;	<button type="button" class="btn btn-info btn-pay" data-id="<?= $row_loan_details['id'] ?>" data-bs-toggle="modal" data-date="<?= date("Y-m-d", strtotime($row_loan_details['installment_date'])); ?>" data-amount="<?= $row_loan_details['installment_amount'] ?>" data-bs-target="#staticBackdrop1">Pay Installment</button><?php }else{?>  &nbsp;&nbsp;&nbsp;&nbsp;	<a href="<?=base_url('admin/loan/update_status/');?><?= $row_loan_details['id']; ?>/<?= $customer_id;?>" onclick="return confirm('Are you sure?')" class="btn btn-warning">Change Status</a><?php }?></td>
							<td class="color"><?php if(!empty($row_loan_details['payment_date'])){?><?= date("d-m-Y", strtotime($row_loan_details['payment_date'])); ?><?php }?></td>
							<td class="color"><?= $row_loan_details['late_fee_charge']; ?></td>
							<td class="color"><?= $row_loan_details['mode']; ?></td>
							<td class="color"><?php if(!empty($row_loan_details['payment_proof'])){?><a href="<?=base_url('upload/');?><?= $row_loan_details['payment_proof']; ?>" target="_blank"><i class="fa fa-eye fa-2x" aria-hidden="true"></i></a><?php } ?></td>
							<td class="color"><?= $row_loan_details['remark']; ?></td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade pay_amount_modal" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-image:url(<?= base_url('assets/'); ?>images/bg-themes/1.png);">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Pay Installment</h5>
        <button type="button" class="btn-close modal_close"></button>
      </div>
      <div class="modal-body">
        	<form method="post" action="<?=base_url('admin/loan/loan_emi_details');?>"  enctype="multipart/form-data">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
				<input type="hidden" value="<?= $late_fee_percentage;?>" id="late_fee_percentage">
				<input type="hidden" value="<?= $customer_id;?>" name="customer_id">
				<input type="hidden" value="" name="loan_emi_details_id" id="loan_emi_details_id">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="i-date">INSTALLMENT DATE<span class="text-danger">*</span></label>
							<input type="date" class="form-control" readonly id="i-date" name="i_date" required>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="p-date">payment date<span class="text-danger">*</span></label>
							<input type="date" class="form-control" value="<?php echo date('Y-m-d');?>" readonly id="p-date" name="p_date" required>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="i-amount">INSTALLMENT Amount<span class="text-danger">*</span></label>
							<input type="hidden" value="" id="hidden_amount">
							<input type="text" id='i-amount' readonly class="form-control" name="name" placeholder="Enter Installment Amount" required>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="late_fee_charge">late fee charge</label>
							<input type="text" class="form-control" id="late_fee_charge" name="late_fee_charge">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="p_amount">payable amount</label>
							<input type="text" readonly class="form-control" id="p_amount" name="p_amount">
						</div>
					</div>
			        <div class="col-lg-6">
						<div class="form-group">
							<label for="p_amount">payment mode<span class="text-danger">*</span></label>
						<select class="form-select" class="payment_mode" name="payment_mode" id="selected" required>
						    <option value="">Select Payment Mode</option>
						    <?php 
						    foreach($payment_mode as $payment_mode){?>
						        <option value="<?=$payment_mode['id'];?>"><?=$payment_mode['mode'];?></option>
						  <?php } ?>
						</select>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<label for="remark">remark</label>
							<input type="text" class="form-control" id="remark" placeholder="Enter Remark" name="remark">
						</div>
					</div>
					<div class="col-lg-12">
						<div class="form-group">
							<label for="remark">payment proof</label>
							<input type="file" class="form-control" id="proof" name="proof">
						</div>
					</div>
				</div>
			    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal_close">Close</button>
                    <button type="submit" class="btn btn-primary pay">Pay</button>
                </div>
			</form>
      </div>
    </div>
  </div>
</div>
<script>
	$(document).ready(function() {
        $('.modal_close').click(function() {
            $('.pay_amount_modal').modal('hide');
        });
         $('.pay').click(function() {
           return confirm('Are you sure?')
        });
         $('.btn-pay').on("click", function(e) {
             $('#selected').val('');
              $('#remark').val('');
               $('#proof').val('');
            //   $('#selected').attr("selected", "selected");

            var installment_amount = parseFloat($(this).data('amount'));
                $('#i-amount').val(installment_amount);
                $('#hidden_amount').val(installment_amount);
            var installment_date = $(this).data('date');
                $('#i-date').val(installment_date);
            var loan_emi_details_id = $(this).data('id'); 
                $('#loan_emi_details_id').val(loan_emi_details_id);
            var payment_date =  $('#p-date').val();
            var late_fee_percentage =  parseFloat($('#late_fee_percentage').val());
            var payable_amount = 0;
            var late_fee_charge = 0;
            if(payment_date >= installment_date){
                const diff = new Date(payment_date) - new Date(installment_date);
		        const numberOfDays = (diff / (1000 * 60 * 60 * 24));
		        var percentage = ((numberOfDays)*(late_fee_percentage)) / 1;
                var late_fee_charge = (installment_amount * percentage)/100;
                var payable_amount = installment_amount + late_fee_charge;
            }else{
                var payable_amount = installment_amount;
                var late_fee_charge = 0;
            }
            $('#late_fee_charge').val(late_fee_charge.toFixed(2));
            $('#p_amount').val(payable_amount.toFixed(2));
            
        });
        $("#late_fee_charge").on("keyup change", function(e) {
            var installment_amount =  $('#hidden_amount').val();
            var insert_charge =0;
            var late_fee_charge = $(this).val();
            if(late_fee_charge==''){
                var insert_charge = 0;
            }else{
                var insert_charge = late_fee_charge;
            }
            
            var total = parseFloat(installment_amount) + parseFloat(insert_charge);
            $('#p_amount').val(total.toFixed(2));
        })
    });
</script>