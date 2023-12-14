<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Product <?php if (!empty($update_data)) {
                                                    echo 'Edit';
                                                } ?></div>
                <hr>

                <form method="post" action="<?php if (!empty($update_data)) {
                                                echo base_url('admin/product/update');
                                            } else {
                                                echo base_url('admin/product/add');
                                            } ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php if (isset($update_data)) {
                                                                echo $update_data['id'];
                                                            } ?>">
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="select121">Category<span class="text-danger">*</span></label>
                            <select class="form-select" name="category_id" id="category">
                                <option>Select category</option>
                                <?php
                                $category = $this->db->get('category')->result();
                                foreach ($category as $value) {
                                ?>
                                    <option value="<?= $value->id; ?>" <?php if (isset($update_data) && $value->id == $update_data['category_id']) {
                                                                            echo 'selected';
                                                                        } ?>><?= $value->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class=" col-lg-3">
                            <div class="form-group">
                                <label for="input-1">Name<span class="text-danger">*</span></label>

                                <input type="text" class="form-control" id="input-1" value="<?php if (!empty($update_data)) {
                                                                                                echo $update_data['name'];
                                                                                            } ?>" name="name" placeholder="Enter product name" required>
                            </div>
                        </div>



                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="image">Image<span class="text-danger">*</span></label>
                                <input type="file" name="image" class="form-control" id="image" <?php if (!isset($update_data)) echo 'required' ?>>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="input-1">Discription<span class="text-danger">*</span></label>

                                <textarea type="text" class="form-control" id="input-1" value="<?php if (!empty($update_data)) {
                                                                                                    echo $update_data['discription'];
                                                                                                } ?>" name="discription" placeholder="Enter product  destination" required>
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="<?= isset($update_data) ? "UPDATE" : "ADD" ?> PRODUCT">
                    </div>

                </form>
            </div>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Product</div>
                    <div class="table-responsive">
                        <table class="table table-hover datatable" id="example1">
                            <thead>
                                <tr>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Sl No</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Discription</th>
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
                'url': '<?php echo base_url(); ?>admin/product/report',
                'data': function(data) {}
            },
            "columns": [{
                    data: 'action'
                },
                {
                    data: 'id'
                },
                {
                    data: 'category'
                },

                {
                    data: 'name'
                },
                {
                    data: 'image'
                },
                {
                    data: 'discription'
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
                    url: '<?php echo base_url('admin/product/delete'); ?>',
                    data: {
                        id: recordId
                    },
                    success: function(response) {
                        if (response != 'success') {
                            location.reload();
                        }
                    }
                  
                });
            }
        });
    });
</script>
