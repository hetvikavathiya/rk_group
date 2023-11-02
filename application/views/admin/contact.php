<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Contact Details <?php if (!empty($update_data)) {
                                                            echo 'Edit';
                                                        } ?></div>
                <hr>

                <form method="post" action="<?php if (!empty($update_data)) {
                                                echo base_url('admin/contact/update/') . $row_data['id'];
                                            }  ?>">
                    <input type="hidden" name="id" value="<?php if (isset($update_data)) {
                                                                echo $update_data['id'];
                                                            } ?>">
                    <div class="row">
                        <div class="col-lg-4 mt-3">
                            <div class="form-group">
                                <label for="input-1">Email<span class="text-danger">*</span></label>

                                <input type="text" class="form-control" id="input-1" value="<?php if (!empty($update_data)) {
                                                                                                echo $update_data['email'];
                                                                                            } ?>" name="email" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <div class="form-group">
                                <label for="input-1">Mobile No <span class="text-danger">*</span></label>

                                <input type="number" class="form-control" id="input-1" value="<?php if (!empty($update_data)) {
                                                                                                    echo $update_data['number'];
                                                                                                } ?>" name="number" required>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <div class="form-group">
                                <label for="input-1"> Address<span class="text-danger">*</span>
                                </label>

                                <input type="text" class="form-control" id="input-1" value="<?php if (!empty($update_data)) {
                                                                                                echo $update_data['address'];
                                                                                            } ?>" name="address" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-5">
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="UPDATE CONTACT">
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
                    <div class="card-title">Inquiry Report</div>
                    <div class="table-responsive">
                        <table class="table table-hover datatable" id="example1">
                            <thead>
                                <tr>
                                    <th scope="col">action</th>
                                    <th scope="col">Sl No</th>
                                    <th scope="col">Emial</th>
                                    <th scope="col">Mobile Number</th>
                                    <th scope="col">Address</th>
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
                'url': '<?php echo base_url(); ?>admin/contact/report',
                'data': function(data) {}
            },
            "columns": [{
                    data: 'action'
                },
                {
                    data: 'id'
                },
                {
                    data: 'email'
                },
                {
                    data: 'number'
                },
                {
                    data: 'address'
                },

                {
                    data: 'created_at'
                },
            ],
        });
    });
</script>