<div class="row mt-3">


    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Feedback Report</div>
                    <div class="table-responsive">
                        <table class="table table-hover datatable" id="example1">
                            <thead>
                                <tr>
                                    <th scope="col">action</th>
                                    <th scope="col">Sl No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Mobile No</th>
                                    <th scope="col">inquiry</th>
                                    <th scope="col">Created at</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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
                'url': '<?php echo base_url(); ?>admin/inquiry/report',
                'data': function(data) {}
            },
            "columns": [{
                    data: 'action'
                },
                {
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'mobile_no'
                },
                {
                    data: 'inquiry'
                },
                {
                    data: 'created_at'
                },
            ],
        });
        $(document).on('click', '.deleterecord', function() {
            var recordId = $(this).data('id');
            if (confirm('Are you sure you want to delete this record?')) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('admin/feedback/delete'); ?>',
                    data: {
                        id: recordId
                    },
                    success: function(response) {
                        if (response != 'success') {
                            alert('Refresh page data is deleted Successfully.');
                        }
                    },
                    error: function() {
                        alert('Error occurred during the AJAX request.');
                    }
                });
            }
        });
    });
</script>