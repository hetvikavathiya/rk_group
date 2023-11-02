<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3><?php echo $page_title; ?></h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="breadcrumb-item"><?php echo $page_title; ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="card p-3">
    <form action="<?=base_url('admin/master_pin/update');?>" method="post">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <label for="">New Master Pin<span class="text-danger">*</span></label>
                        <input required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" pattern=".{4,}"   minlength="4" maxlength="4"  class="form-control btn-square" autocomplete="off" value="<?php if(!empty($row_data)){echo $row_data;}?>" name="master_pin" id="master_pin" type="text" placeholder="Enter Mater Pin">
                </div>
                 <div class="col-md-1 pt-4">
                   <button class="btn btn-primary" type="submit" data-original-title="btn btn-primary-gradien" title="">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
</script>