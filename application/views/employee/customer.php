<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Customer <?php if(!empty($row_data)){echo 'Edit';}?></div>
                <hr>
                <form method="post" action="<?php if(!empty($row_data)){echo base_url('employee/customer_report/update/').$row_data['id'];}else{echo base_url('employee/customer/add');}?>" enctype="multipart/form-data">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="input-1">First Name<span class="text-danger">*</span></label>
                                <input type="hidden" value="<?php if(!empty($check)){echo $check ;}?>" name="check">
                                <input type="text" class="form-control" id="input-1" value="<?php if(!empty($row_data)){echo $row_data['first_name'];}?>" name="first_name" placeholder="Enter First Name" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="input-2">Middle Name</label>
                                <input type="text" class="form-control" id="input-2" name="middle_name" value="<?php if(!empty($row_data)){echo $row_data['middle_name'];}?>" placeholder="Enter Your Middle Name">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="input-3">Last Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="input-3" name="last_name" value="<?php if(!empty($row_data)){echo $row_data['last_name'];}?>" placeholder="Enter Your Last Name" required>
                            </div>
                        </div>
                         <div class="col-lg-4">
                            <div class="form-group">
                                <label for="input-3311">AAdhar Card No<span class="text-danger">*</span></label>
                                <input type="text" value="<?php if(!empty($row_data)){echo $row_data['aadhar_card'];}?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" pattern=".{10,}"  minlength="12" maxlength="12" class="form-control" id="input-3311" name="aadhar_card" placeholder="Enter Aadhar Card No" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="input-33">Mobile No<span class="text-danger">*</span></label>
                                <input type="text" value="<?php if(!empty($row_data)){echo $row_data['mobile'];}?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" pattern=".{10,}"  minlength="10" maxlength="10" class="form-control" id="input-33" name="mobile" placeholder="Enter Your Mobile No" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="input-4">Password<span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" id="input-4" placeholder="Enter Password" <?php if(empty($row_data)){echo 'required';}?>>
                                <div class="icheck-material-white">
                                    <input type="checkbox" onclick="myFunction()" id="user-checkbox1"/>
                                    <label for="user-checkbox1">Show</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="input-533">Email</label>
                                <input type="email" value="<?php if(!empty($row_data)){echo $row_data['email'];}?>" class="form-control" name="email" id="input-533" placeholder="Your Email Address">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="input-5">Address</label>
                                <input type="text" value="<?php if(!empty($row_data)){echo $row_data['address'];}?>" class="form-control" name="address" id="input-5" placeholder="Your Address">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="input-5">City</label>
                                <input type="text" value="<?php if(!empty($row_data)){echo $row_data['city'];}?>" name="city" class="form-control" id="input-5" placeholder="Your City">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="input-23">Alternate Mobile No</label>
                                <input type="text" value="<?php if(!empty($row_data)){echo $row_data['alternate_mobile_no'];}?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" pattern=".{10,}"  minlength="10" maxlength="10" name="a_mobile" class="form-control" id="input-23" placeholder="Your Alternate Mobile No">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="select">Document Type</label>
                            <select class="form-select" id="select" name="document_type" aria-label="Default select example">
                              <option selected value="">Select Document Type</option>
                              <option value="Aadhaar Card" <?php if(!empty($row_data) && $row_data['document_type'] == 'Aadhaar Card'){echo 'selected';}?>>Aadhaar Card</option>
                              <option value="Pan Card" <?php if(!empty($row_data) && $row_data['document_type'] == 'Pan Card'){echo 'selected';}?>>Pan Card</option>
                              <option value="Election card" <?php if(!empty($row_data) && $row_data['document_type'] == 'Election card'){echo 'selected';}?>>Election card</option>
                              <option value="Driving Licence" <?php if(!empty($row_data) && $row_data['document_type'] == 'Driving Licence'){echo 'selected';}?>>Driving Licence</option>
                              <option value="Passport" <?php if(!empty($row_data) && $row_data['document_type'] == 'Passport'){echo 'selected';}?>>Passport</option>
                              <option value="Other" <?php if(!empty($row_data) && $row_data['document_type'] == 'Other'){echo 'selected';}?>>Other</option>
                            </select>
                        </div>
                         <div class="col-lg-4">
                            <div class="form-group">
                                <label for="input-document">Frontside Document</label>
                                <input type="file"  name="frontside_document" class="form-control" id="input-document" placeholder="Your document">
                            </div>
                        </div>
                         <div class="col-lg-4">
                            <div class="form-group">
                                <label for="input-document-2">Backside Document</label>
                                <input type="file"  name="backside_document" class="form-control" id="input-document-2" placeholder="Your document">
                            </div>
                        </div>
                         <div class="col-lg-4">
                            <div class="form-group">
                                <label for="input-photo">Photo</label>
                                <input type="file"  name="photo" class="form-control" id="input-photo" placeholder="Your photo">
                            </div>
                        </div>
                         <div class="col-lg-4">
                            <div class="form-group">
                                <label for="input-signature">Signature</label>
                                <input type="file"  name="signature" class="form-control" id="input-signature" placeholder="Your signature">
                            </div>
                        </div>
                        <div class="col-lg-4 py-2">
                            <label for="select121">Status</label>
                            <select class="form-select" id="select121" name='status' aria-label="Default select example">
                              <option value="">Select Status</option>
                              <option value="Approved" <?php if(!empty($row_data) && $row_data['status'] == 'Approved'){echo 'selected';}?>>Approved</option>
                              <option value="Pending" <?php if(!empty($row_data) && $row_data['status'] == 'Pending'){echo 'selected';}?>>Pending</option>
                              <option value="Rejected" <?php if(!empty($row_data) && $row_data['status'] == 'Rejected'){echo 'selected';}?>>Rejected</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-light px-5">Submit</button>
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
    </script>