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
                    <div class="col-md-1">
                        <div class="form-group pt-4 mt-1">
                            <button type="button" class="btn btn-primary search" id="search">Search</button>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group card pt-4 mt-1">
                            <span class="h4 p-2">BALANCE  : <?= $balance['balance'];?>  <i class="fa fa-inr" aria-hidden="true"></i></span>
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
				'url': '<?php echo base_url(); ?>customer/account_report/report',
				'data': function(data) {
				    data.from_date = $('#from_date').val();
                    data.to_date = $('#to_date').val();
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

        $('.modal_close').click(function() {
            $('.pay_amount_modal').modal('hide');
        });
			
    });
    
</script>