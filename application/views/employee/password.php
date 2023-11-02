 <?php if ($this->session->flashdata('flash_message') != "") {
    	$message = $this->session->flashdata('flash_message');  ?>
    	<div class="alert alert-<?= $message['class']; ?> alert-dismissible" role="alert">
    		<div>
    			<h5 class="alert-title p-3"><?= $message['message']; ?></h5>
    		</div>
    		<a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
    	</div>
    <?php $this->session->set_flashdata('flash_message', "");
    }  ?>
<div class="card p-3">
    <form action="<?=base_url('employee/password/change');?>" method="post">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <label for="">Old Password</label>
                    <div class="form-group">
                        <input required class="form-control btn-square" autocomplete="off" name="old_password" id="old_password" type="password" placeholder="Enter Old Password">
                        <div class="icheck-material-white">
                            <input type="checkbox" id="user-checkbox1" onclick="myFunction()" />
                            <label for="user-checkbox1">Show</label>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-4">
                    <label for="">New Password</label>
                    <div class="input-group">
                        <input required class="form-control btn-square" autocomplete="off" name="new_password" id="new_password" type="password" onChange="onChange()" placeholder="Enter New Password">
                     </div>
                </div>
                <div class="col-md-4">
                    <label for="">Confirm  Password</label>
                    <div class="input-group">
                        <input required class="form-control btn-square" autocomplete="off" name="re_password" id="re_password" type="password" onChange="onChange()" placeholder="Enter Re-Enter name">
                    </div>
                </div>
                 <div class="col-md-1 pt-3">
                   <button class="btn btn-primary" type="submit" data-original-title="btn btn-primary-gradien" title="">Submit</button>
                </div>
                 
            </div>
        </div>
    </form>
</div>
<script>
    function myFunction() {
      var x = document.getElementById("old_password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
       var z = document.getElementById("re_password");
      if (z.type === "password") {
        z.type = "text";
      } else {
        z.type = "password";
      }
      var y = document.getElementById("new_password");
      if (y.type === "password") {
        y.type = "text";
      } else {
        y.type = "password";
      }
    }
    
    
    function onChange() {
    const password = document.getElementById("new_password");
    const confirm = document.getElementById("re_password");
    if (confirm.value === password.value) {
        confirm.setCustomValidity('');
    } else {
        confirm.setCustomValidity('Passwords do not match');
    } 
    
    }
    
  
</script>






