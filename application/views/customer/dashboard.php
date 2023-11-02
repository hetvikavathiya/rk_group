<style>
	.form-select {
		border: 0px solid #e5eaef;
		background-color: rgba(255, 255, 255, 0.2);
		color: #fff !important;
	}

	.form-select:focus {
		background-color: rgba(0, 0, 0, .2);
		box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.45)
	}

	.select2-container--default .select2-results__option--selected {
		background-color: #007bff;
	}

	.select2-results__option {
		background: #0d0d0d;
	}

	.select2-container--default .select2-selection--single {
		border: 0px solid #e5eaef;
		background-color: rgba(255, 255, 255, 0.2);
		height: 40px;
		color: #fff !important;
	}

	.select2-container--default .select2-selection--single .select2-selection__rendered {
		color: white;
		padding: 6px;
	}

	.select2-container--default .select2-selection--single .select2-selection__choice__display {
		color: #000;
	}

	.profile-card-2 .card-img-block {
		height: 70px;
	}

	.profile-card-2 .profile {
		left: 50%;
		top: -68px;
		width:100%;
		max-width: 118px;
		max-height: 130px;
	}
</style>
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
<div class="row">
    	<div class="col-lg-6 col-md-6 col-sm-12 col-12" >
    	    <div class="card mt-3">
    <div class="card-content">
        <div class="row row-group m-0">
            <div class="col-12 col-lg-6 col-xl-6 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0"><?=$balance['balance'];?> <span class="float-right"><i class="zmdi zmdi-balance"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Total Balance </p>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-6 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0"><?=$count_loan;?> <span class="float-right"><i class="zmdi zmdi-assignment-check"></i></span></h5>
                    <div class="progress my-3" style="height:3px;">
                       <div class="progress-bar" style="width:55%"></div>
                    </div>
                  <p class="mb-0 text-white small-font">Total Loan </p>
                </div>
            </div>
        </div>
    </div>
 </div>
						
    	</div>
    		<div class="col-lg-6 col-md-6 col-sm-12 col-12" id='profile-hide'>
					<div class="card profile-card-2">
						<div class="card-img-block">
						</div>
						<div class="card-body pt-5">
							<img src="<?= base_url('upload/'); ?><?php if(!empty($row_data['photo'])){echo $row_data['photo'];}else{ echo 'avatar.png';}?>" alt="profile-image" class="profile">
							<h5 class="card-title text-center pt-3">Name : <?php if (!empty($row_data)) {
																echo $row_data['first_name'];
															} ?> <?php if (!empty($row_data)) {
																		echo $row_data['middle_name'];
																	} ?> <?php if (!empty($row_data)) {
																				echo $row_data['last_name'];
																			} ?></h5>
							<p class="card-text text-center"> Mobile No : <?php if (!empty($row_data)) {
																	echo $row_data['mobile'];
																} ?></p>
							<div class="icon-block text-center">
								Email : <?php if (!empty($row_data)) {
											echo $row_data['email'];
										} ?>
							</div>
							<div class="icon-block text-center pt-2">
								 Account Opening Date : <?php if (!empty($row_data)) {
											echo date("d-m-Y", strtotime($row_data['account_open_date']));
										} ?>
							</div>
						</div>
					</div>
				</div>
</div>
       