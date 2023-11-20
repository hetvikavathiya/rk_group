<div class="row mt-3">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="card-title">Customer Report</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="form-label">Status</label>
						<select class="form-select" id="select" name="document_type" aria-label="Default select example">
							<option selected value="">Select Status</option>
							<option value="Approved">Approved</option>
							<option value="Pending">Pending</option>
							<option value="Rejected">Rejected</option>
						</select>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-hover" id="example1">
						<thead>
							<tr>
								<th scope="col">Edit</th>
								<th scope="col">Sl No</th>
								<th scope="col">Name</th>
								<th scope="col">Account type</th>
								<th scope="col">Status</th>
								<th scope="col">Aadhaar Card No</th>
								<th scope="col">Mobile No</th>
								<th scope="col">Alternate Mobile</th>
								<th scope="col">Address</th>
								<th scope="col">Email</th>
								<th scope="col">City</th>
								<th scope="col">Photo</th>
								<th scope="col">Signature</th>
								<th scope="col">Frontside Document</th>
								<th scope="col">Backside Document</th>
								<th scope="col">Document Type</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var userDataTable = $('#example1').DataTable({
			dom: 'Bfrtip',
			buttons: ['print', 'csv', 'excel', 'pdf'],
			processing: true,
			serverSide: true,
			paging: true,
			searching: true,
			ordering: true,
			'serverMethod': 'get',
			'ajax': {
				'url': '<?php echo base_url(); ?>admin/customer_report/report',
				'data': function(data) {
					data.select = $('#select').val();
				}
			},
			"columns": [{
					data: 'edit'
				},
				{
					data: 'id'
				},
				{
					data: 'name'
				},
				{
					data: 'acc_type'
				},
				{
					data: 'status'
				},
				{
					data: 'aadhar'
				},
				{
					data: 'mobile'
				},
				{
					data: 'a_mobile'
				},
				{
					data: 'address'
				},
				{
					data: 'email'
				},
				{
					data: 'city'
				},
				{
					data: 'photo'
				},
				{
					data: 'signature'
				},
				{
					data: 'frontside_document'
				},
				{
					data: 'backside_document'
				},
				{
					data: 'document_type'
				},
			],
		});
		$(document).on('change', '#select', function() {
			userDataTable.draw();
		});
	});
</script>