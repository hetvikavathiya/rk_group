<style>
    .form-select{
    border: 0px solid #e5eaef;
    background-color: rgba(255, 255, 255, 0.2);
    color: #fff !important;
}
.form-select:focus{
  background-color: rgba(0,0,0,.2);
  box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.45)
}
.select2-container--default .select2-results__option--selected {
    background-color: #007bff;
}
.select2-results__option{
    background:#0d0d0d;
}
.select2-container--default .select2-selection--multiple{
     border: 0px solid #e5eaef;
    background-color: rgba(255, 255, 255, 0.2);
    color: #fff !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__display{
    color:#000;
}
</style>
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Manage User</div>
                <hr>
                <form method="post" action=" <?php if(!empty($row_data)){echo base_url('admin/manage_user/update/').$row_data['id'];}else{echo base_url('admin/manage_user/add');}?>">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="input-1">First Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="input-1" value="<?php if(!empty($row_data)){echo $row_data['first_name'];}?>" name="first_name" placeholder="Enter First Name" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="input-2">Middle Name</label>
                                <input type="text" class="form-control" id="input-2" value="<?php if(!empty($row_data)){echo $row_data['middle_name'];}?>" name="middle_name" placeholder="Enter Your Middle Name">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="input-3">Last Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="input-3" value="<?php if(!empty($row_data)){echo $row_data['last_name'];}?>" name="last_name" placeholder="Enter Your Last Name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="input-33">Mobile No<span class="text-danger">*</span></label>
                                <input type="text" value="<?php if(!empty($row_data)){echo $row_data['mobile'];}?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" pattern=".{10,}"  minlength="10" maxlength="10" class="form-control" id="input-33" name="mobile" placeholder="Enter Your Mobile No" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="input-4">Password<span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" id="input-4" placeholder="Enter Password" <?php if(empty($row_data)){echo 'required';}?>>
                                <div class="icheck-material-white">
                                    <input type="checkbox" onclick="myFunction()" id="user-checkbox1"/>
                                    <label for="user-checkbox1">Show</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="input-5">Address</label>
                                <input type="text" value="<?php if(!empty($row_data)){echo $row_data['address'];}?>" class="form-control" name="address" id="input-5" placeholder="Your Address">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="input-5">City</label>
                                <input type="text" value="<?php if(!empty($row_data)){echo $row_data['city'];}?>" name="city" class="form-control" id="input-5" placeholder="Your City">
                            </div>
                        </div>
                         <div class="col-lg-6">
                            <label for="select">User Type<span class="text-danger">*</span></label>
                            <select class="form-select" id="select" name="user_type" aria-label="Default select example" required>
                              <option selected value="">Select User Type</option>
                              <option value="Manager" <?php if(!empty($row_data) && $row_data['user_type'] == 'Manager'){echo 'selected';}?>>Manager</option>
                              <option value="Staff" <?php if(!empty($row_data) && $row_data['user_type'] == 'Staff'){echo 'selected';}?>>Staff</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="select121">Permission<span class="text-danger">*</span></label>
                            <select class="form-select permission" id="select121" name='permission[]' aria-label="Default select example" multiple="multiple" required>
                                <?php  $faculty = explode(",", $row_data['permission']);?>
                              <option value="Account Opening" <?php if(!empty($row_data) && in_array('Account Opening',$faculty)){echo 'selected';}?>>Account Opening</option>
                              <option value="Credit-Debit" <?php if(!empty($row_data) && in_array('Credit-Debit',$faculty)){echo 'selected';}?>>Credit-Debit</option>
                              <option value="Loan" <?php if(!empty($row_data) && in_array('Loan',$faculty)){echo 'selected';}?>>Loan</option>
                              <option value="Manage Customer" <?php if(!empty($row_data) && in_array('Manage Customer',$faculty)){echo 'selected';}?>>Manage Customer</option>
                            </select>
                        </div>
                        <div class="col-lg-6 py-2">
                        <label for="user-checkbox33">Status</label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="status" value="1" id="flexRadioDefault1" <?php if(!empty($row_data) && $row_data['status'] == '1'){echo 'checked';}?>>
                          <label class="form-check-label" for="flexRadioDefault1">
                           Enable 
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="status" value="0" id="flexRadioDefault2" <?php if(!empty($row_data) && $row_data['status'] == '0'){echo 'checked';}?>>
                          <label class="form-check-label" for="flexRadioDefault2">
                            Disable 
                          </label>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-light px-5"> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function myFunction() {
      var x = document.getElementById("input-4");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    $(document).ready(function() {
        $(".permission").select2({
            placeholder: "Select a Permission",
            allowClear: true
        });
    });
</script>