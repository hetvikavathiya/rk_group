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
<?php if(empty($row_data)){?>
<div class="card p-4">
    <form class="theme-form" action="<?php echo base_url('admin/merge_parameters/insert');?>" method="post">
         <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <div class=" my-3 justify-content-center">
            <div class="col-md-4">
                <label for="input-text-1">Select Product Name<span class="text-danger">*</span></label>
                  <select required name="product_id" class="product_select form-control"></select>
            </div>
            <div id="param_div">
                <div class="row">
                    <div class="col-md-4 pt-3">
                        <label for="input-text-1 p-3">Parameters Name<span class="text-danger">*</span></label>
                        <select required name="parameters_id[]" class="main_select form-control"></select>
                    </div>
                  <div class="col-md-3 pt-3">
                      <label for="input-text-1 p-3">Amount<span class="text-danger">*</span></label>
                      <input required class="form-control btn-square" value="<?php if(isset($row_data)){ echo $row_data['amount']; } ?>" step="any" name="amount[]" id="input-text-1" type="number" placeholder="Enter amount">
                  </div>
                  <div class="col-md-4 pt-3">
                      <label for="input-text-1 p-3">Sop</label>
                      <textarea class="form-control btn-square" value="<?php if(isset($row_data)){ echo $row_data['sop']; } ?>" name="sop[]" id="input-text-1" type="text" placeholder="Enter Sop"></textarea>
                  </div>
                  <div class="col-md-1" style="padding:38px;">
                       <!--<a class="remove"><i class="fa fa-trash fa-2x text-danger" aria-hidden="true"></i></a>-->
                  </div>
                </div> 
                
            </div>
            <a class="btn btn-primary mt-3" id="add"  data-original-title="btn btn-primary-gradien" title="">ADD</a><br/>
             <button class="btn btn-primary mt-3" type="submit" data-original-title="btn btn-primary-gradien" title="">Submit</button>
             
        </div>
    </form>
     
</div>
<?php }?>
<?php if(!empty($row_data)){?>
<div class="card p-4">
    <form class="theme-form" action="<?php echo base_url('admin/merge_parameters/update/'.$row_data['id'])?>" method="post">
         <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash();?>" />
         <div class="row">
               <div class="col-md-4 pt-3">
                    <label for="">Master Pin<span class="text-danger">*</span></label>
                    <input required class="form-control btn-square" autocomplete="off" name="master_pin" id="master_pin" type="number" placeholder="Enter Mater Pin">
                </div>
              <div class="col-md-3 pt-3">
                  <label for="input-text-1 p-3">Amount<span class="text-danger">*</span></label>
                  <input required class="form-control btn-square" value="<?php if(isset($row_data)){ echo $row_data['amount']; } ?>" step="any" name="amount" id="input-text-1" type="number" placeholder="Enter amount">
              </div>
              <div class="col-md-4 pt-3">
                  <label for=" p-3">Sop</label>
                  <textarea class="form-control btn-square" name="sop" type="text" placeholder="Enter Sop"><?php if(isset($row_data)){ echo $row_data['sop']; } ?></textarea>
              </div>
            </div> 
            <button class="btn btn-primary mt-3" type="submit" data-original-title="btn btn-primary-gradien" title="">Update</button>
    </form>
</div>
<?php }?>
<div id="param_copy"  style="display:none;">
    <div class="row">
         <div class="col-md-4 pt-3">
             <label for="input-text-1 p-3">Parameters Name<span class="text-danger">*</span></label>
            <select required name="parameters_id[]" class="itemName form-control"></select>
            </div>
        <div class="col-md-3 pt-3">
          <label for="input-text-12 p-3">amount<span class="text-danger">*</span></label>
          <input required class="form-control btn-square" step="any" name="amount[]" type="number" placeholder="Enter amount">
        </div>
        <div class="col-md-4 pt-3">
          <label for="input-text-13 p-3">Sop</label>
          <textarea class="form-control btn-square" name="sop[]"  placeholder="Enter Sop"></textarea>
        </div>
         <div class="col-md-1" style="padding:38px;">
               <a class="remove"><i class="fa fa-trash fa-2x text-danger" aria-hidden="true"></i></a>
          </div>
    </div> 
</div>

<?php if(!empty($merge_parameters)){ ?>
  <div class="col-sm-12">
                <div class="card p-3">
                  <div class="card-header ps-0">
                    <h3>Merge Parameters Report</h3>
                  </div>
                  <div class="card-block row">
                    <div class="col-sm-12 col-lg-12 col-xl-12">
                      <div class="table-responsive">
                        <table id="example" class="table">
                          <thead class="table-primary">
                            <tr>
                              <th scope="col">Sl no</th>
                              <th scope="col">Product Name</th>
                              <th scope="col">Parameters Name</th>
                              <th scope="col">Amount</th>
                              <th scope="col">sop</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $i=1;
                            foreach($merge_parameters as $parameters){
                            ?>
                            <tr>
                                <td><?=$i;?></td>
                                <td><?=$parameters['product_name'];?></td>
                                <td><?=$parameters['parameters_name'];?></td>
                                <td><?=$parameters['amount'];?></td>                                
                                <td><?=$parameters['sop'];?></td>
                                <td>
                                    <a href="<?php echo site_url('admin/merge_parameters/edit/'.$parameters['id']); ?>"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>&nbsp;&nbsp;
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



<script>

    $(document).ready(function(){
        $('.main_select').select2({
        placeholder: '--Select Parameters Name--',
        ajax: {
          url: '<?php echo base_url("admin/merge_parameters/parameters_name");?>',
          type: "GET",
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        }
     });
      $('.product_select').select2({
        placeholder: '--Select Product Name--',
        ajax: {
          url: '<?php echo base_url("admin/merge_parameters/product_name");?>',
          type: "GET",
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        }
     });
        
        var main_row = "";
        main_row = $('#param_copy').html();
        
        $(document).on("click","#add",function(){
            $('#param_div').append(main_row);
            $('.itemName').select2({
                 minimumInputLength: 1,
                placeholder: '--Select Parameters Name--',
                ajax: {
                    url: '<?php echo base_url("admin/merge_parameters/parameters_name");?>',
                    type: "GET",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                          results: data
                        };
                    },
                    cache: true
                }
            });
        });
        $(document).on("click",".remove",function(){
            $(this).parent().parent().remove();
        });
        
    });
</script>