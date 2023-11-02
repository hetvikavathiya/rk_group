<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Category <?php if (!empty($update_data)) {
                                                        echo 'Edit';
                                                    } ?></div>
                <hr>

                <form method="post" action="<?php if (!empty($update_data)) {
                                                echo base_url('admin/category/update');
                                            } else {
                                                echo base_url('admin/category/add');
                                            } ?>">
                    <input type="hidden" name="id" value="<?php if (isset($update_data)) {
                                                                echo $update_data['id'];
                                                            } ?>">
                    <div class="row">
                        <div class="col-lg-5 mt-3">
                            <div class="form-group">
                                <label for="input-1">Category Name<span class="text-danger">*</span></label>

                                <input type="text" class="form-control" id="input-1" value="<?php if (!empty($update_data)) {
                                                                                                echo $update_data['name'];
                                                                                            } ?>" name="name" placeholder="Enter category Name" required>
                            </div>
                        </div>

                        <div class="col-lg-4 mt-5">
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="<?= isset($update_data) ? "UPDATE" : "ADD" ?> CATEGORY">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Category Report</div>
                    <div class="table-responsive">
                        <table class="table table-hover datatable" id="example1">
                            <thead>
                                <tr>
                                    <th scope="col">action</th>
                                    <th scope="col">Sl No</th>
                                    <th scope="col">Name</th>
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
                'url': '<?php echo base_url(); ?>admin/category/report',
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
                    data: 'created_at'
                },
            ],
        });
        $(document).on('click', '.deleterecord', function() {
            var recordId = $(this).data('id');
            if (confirm('Are you sure you want to delete this record?')) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('admin/Category/delete'); ?>',
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