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
    <form class="theme-form" action="<?php if(isset($row_data)){ echo base_url('admin/party/update/'.$row_data['id']); }else{ echo base_url('admin/party/insert'); } ?>" method="post"  autocomplete="off">
         <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <div class=" my-3 justify-content-center">
                <div class="row">
                     <?php if(isset($row_data)){?>
                     <div class="col-md-4 pt-3">
                        <label for="">Master Pin<span class="text-danger">*</span></label>
                        <input required class="form-control btn-square" autocomplete="off" name="master_pin" id="master_pin" type="number" placeholder="Enter Mater Pin">
                    </div>
                <?php }?>
                  <div class="col-md-4 pt-3">
                      <label >Name<span class="text-danger">*</span></label>
                      <input required class="form-control btn-square" value="<?php if(isset($row_data)){ echo $row_data['name']; }elseif(isset($name)){echo $name;} ?>"  name="name"  type="text" placeholder="Enter Name">
                  </div>
                 <div class="col-md-4 pt-3">
                      <label>Mobile No<span class="text-danger">*</span></label>
                      <input required  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" pattern=".{10,}"   minlength="10" maxlength="10"   class="form-control btn-square" value="<?php if(isset($row_data)){ echo $row_data['mobile_no']; } ?>" id="textBoxId"  name="mobile_no"  type="text" placeholder="Enter mobile no">
                  </div>
                  <div class="col-md-4 pt-3">
                      <label >Email<span class="text-danger">*</span></label>
                      <input required  class="form-control btn-square" value="<?php if(isset($row_data)){ echo $row_data['email']; } ?>"  name="email" type="text" placeholder="Enter Email">
                  </div>
                  <div class="col-md-4 pt-3">
                      <label >Password<?php if(isset($row_data)){}else{ echo '<span class="text-danger">*</span>';} ?></label>
                      <input <?php if(isset($row_data)){}else{ echo 'required';} ?> class="form-control btn-square" value="<?php if(isset($row_data)){ echo ""; } ?>"  name="password"  type="password" placeholder="Enter Password">
                  </div>
                  <div class="col-md-4 pt-3">
                      <label >Address</label>
                      <input class="form-control btn-square" value="<?php if(isset($row_data)){ echo $row_data['address']; } ?>"  name="address"  type="text" placeholder="Enter Address">
                  </div>
                  <div class="col-md-4 pt-3">
                      <label >GST Number</label>
                      <input class="form-control btn-square" value="<?php if(isset($row_data)){ echo $row_data['gst_no']; } ?>"  name="gst_no"  type="text" placeholder="Enter GST No">
                  </div>
                   <div class="col-md-4 pt-3">
                      <label>Contact Person Name</label>
                      <input class="form-control btn-square" value="<?php if(isset($row_data)){ echo $row_data['contact_name']; }elseif(isset($contact_name)){echo $contact_name;} ?>"  name="contact_name"  type="text" placeholder="Enter Contact Person Name">
                  </div>
                   <div class="col-md-4 pt-3">
                      <label>Area</label>
                      <input class="form-control btn-square" value="<?php if(isset($row_data)){ echo $row_data['area']; }elseif(isset($area)){echo $area;} ?>"  name="area"  type="text" placeholder="Enter Area">
                  </div>
                </div> 
                
             <button class="btn btn-primary mt-3" type="submit" data-original-title="btn btn-primary-gradien" title=""><?php if(isset($row_data)){ echo 'Update'; }else{echo 'Submit';} ?></button>
             
        </div>
    </form>
     
</div>
<?php if(!empty($party)){?> 
    <div class="col-sm-12">
                <div class="card p-3">
                  <div class="card-header ps-0">
                    <h3>Parties Report</h3>
                  </div>
                  <div class="card-block row">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                      <div class="table-responsive">
                        <table id="example"  class="table">
                          <thead class="table-primary">
                            <tr>
                              <th scope="col">Sl no</th>
                              <th scope="col">Name</th>
                              <th scope="col">Contact Person Name</th>
                              <th scope="col">Area</th>
                              <th scope="col">Address</th>
                              <th scope="col">Mobile Nomber</th>
                              <th scope="col">Email</th>
                              <th scope="col">GST No</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $i=1;
                            foreach($party as $party){
                            ?>
                            <tr>
                                <td><?=$i;?></td>
                                <td><?=$party['name'];?></td>
                                <td><?=$party['contact_name'];?></td>
                                <td><?=$party['area'];?></td>
                                <td><?=$party['address'];?></td>
                                <td><?=$party['mobile_no'];?></td>
                                <td><?=$party['email'];?></td>
                                <td><?=$party['gst_no'];?></td>
                                <td>
                                    <a href="<?php echo site_url('admin/party/edit/'.$party['id']); ?>"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>&nbsp;&nbsp;
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


