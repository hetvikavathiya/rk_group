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
					<th>Payment <br>Date</th>
					<th>Late Fee<br> Charge</th>
					<th>Payment Mode</th>
					<th>Status</th>
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
							<td class="color"><?php if(!empty($row_loan_details['payment_date'])){?><?= date("d-m-Y", strtotime($row_loan_details['payment_date'])); ?><?php }?></td>
							<td class="color"><?= $row_loan_details['late_fee_charge']; ?></td>
							<td class="color"><?= $row_loan_details['mode']; ?></td>
							<td class="color"><span class="badge badge-<?=$color;?>"><?= $row_loan_details['status']; ?></span></td>
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

<script>
	$(document).ready(function() {
        $('.modal_close').click(function() {
            $('.pay_amount_modal').modal('hide');
        });
    });
</script>