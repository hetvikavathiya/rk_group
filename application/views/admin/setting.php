<div class="row mt-3">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<div class="card-title">Setting</div>
				<hr>

				<form method="post" action="<?= base_url("admin/setting/add"); ?>">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
					<div class="row">
						<div class="col-lg-4">
							<div class="form-group">
								<label for="input-1">Late Fee Per Day Percentage<span class="text-danger">*</span></label>
								<input type="number" step="any" class="form-control" id="input-1" name="charges" placeholder="Enter Charges" value="<?php if (isset($row_data)) {
																																				echo $row_data['late_fee_percentage'];
																																			} ?>" required>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label for="input-1">Yearly Interest Credit (in %)<span class="text-danger">*</span></label>
								<input type="number" step="any" class="form-control" id="input-1" name="y_credit" placeholder="Enter Yearly Interest Credit" value="<?php if (isset($row_data)) {
																																				echo $row_data['yearly_interest_credit'];
																																			} ?>" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-light px-5"><?= isset($row_data) ? "Update" : "Submit"; ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
