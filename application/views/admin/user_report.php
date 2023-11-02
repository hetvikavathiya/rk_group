<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">User Report</div>
	            <div class="table-responsive">
                    <table class="table table-hover" id="example1">
                        <thead>
                          <tr>
                            <th scope="col">Edit</th>
                            <th scope="col">Sl No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Mobile No</th>
                            <th scope="col">Address</th>
                            <th scope="col">City</th>
                            <th scope="col">User Type</th>
                            <th scope="col">Permission</th>
                            <th scope="col">Status</th>
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
                'url': '<?php echo base_url(); ?>admin/user_report/report',
                'data': function(data) {}
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
                    data: 'mobile'
                },
                {
                    data: 'address'
                },
                {
                    data: 'city'
                },
                {
                    data: 'user_type'
                },
                {
                    data: 'permission'
                },
                {
                    data: 'status'
                },
            ],
        });
    });
</script>