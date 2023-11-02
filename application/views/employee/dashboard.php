<style>
    @media only screen and (max-width: 600px) {
        .img-logo {
        width:300px;
        }
    }
    @media only screen and (min-width: 600px) {
        .img-logo {
        width:600px;
        }
    }
</style>
<div class="card p-3">
    <div class="row">
        <div class="col-md-7">
            <div class="text-center">
                <img src="<?=base_url();?>assets/images/logo-icon.png" class='img-logo' alt="logo icon">
            </div>
        </div>
         <div class="col-md-5">
            <div class="">
                <h4 class="text-center">Electronics and Furniture Available in Easy EMI</h4><br>
               <h4>Mobile No : 9924963026 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 8733959677</h4>
               <h4>Email :  support@rkgroupfinance.in</h4>
            </div>
        </div>
    </div>
</div>

 	<div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-4 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0"><?=$count_customer;?> <span class="float-right"><i class="zmdi zmdi-accounts-outline"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Total Customer </p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-4 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0"><?=$count_loan;?> <span class="float-right"><i class="zmdi zmdi-assignment-check"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Total Loan</p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-4 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0"><?=$account;?> <span class="float-right"><i class="zmdi zmdi-balance"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Total Account Opened </p>
                </div>
            </div>
        </div>
    </div>
 </div>