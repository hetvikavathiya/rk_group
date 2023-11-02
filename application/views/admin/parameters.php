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
<style>
  .dataTables_wrapper .dataTables_filter input[type="search"]{
        margin-left:0px;
    }
</style>
<div class="card p-4">
    
    <form class="theme-form" action="<?php if(isset($row_data)){ echo base_url().'admin/parameters/update/'.$row_data['id']; }else{ echo base_url('admin/parameters/insert'); } ?>" method="post">
         <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <div class="row">
             <?php if(isset($row_data)){?>
                <div class="col-md-4">
                    <label for="">Master Pin<span class="text-danger">*</span></label>
                        <input required class="form-control btn-square" autocomplete="off" name="master_pin" id="master_pin" type="number" placeholder="Enter Mater Pin">
                </div>
                <?php }?>
                <div class="mb-3 col-md-4 draggable">
                    <label for="input-text-1"><?php if(isset($row_data)){ echo 'Update'; }else{ echo 'Add'; } ?> parameters<span class="text-danger">*</span></label>
                    <input required class="form-control btn-square" value="<?php if(isset($row_data)){ echo $row_data['parameters_name']; } ?>" name="parameters_name" id="input-text-1" type="text" placeholder="Enter parameters name">
                </div>
            </div>
        <button class="btn btn-primary" type="submit" data-original-title="btn btn-primary-gradien" title=""><?php if(isset($row_data)){ echo 'Update'; }else{ echo 'Add'; } ?></button>
    </form>
</div>
<?php if(!empty($parameters)){?> 
    <div class="col-sm-12">
                <div class="card p-3">
                  <div class="card-header ps-0">
                    <h3>Parameters Report</h3>
                  </div>
                  <div class="card-block row">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                      <div class="table-responsive">
                        <table id="example" class="table">
                          <thead class="table-primary">
                            <tr>
                              <th scope="col">Sl no</th>
                              <th scope="col">Parameters Name</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $i=1;
                            foreach($parameters as $parameters){
                            ?>
                            <tr>
                                <td><?=$i;?></td>
                                <td><?=$parameters['parameters_name'];?></td>
                                <td>
                                    <a href="<?php echo site_url('admin/parameters/edit/'.$parameters['id']); ?>"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>&nbsp;&nbsp;
                                </td>
                            </tr>
                              <?php $i++; } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
<?php } ?>