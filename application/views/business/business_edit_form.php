
<div>
	<?php
	  $this->load->view('alert');
	?>
</div>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-10">
			<div class="card shadow-lg border-0 rounded-lg mt-5">
				<div class="card-header">
					<h3 class="text-center font-weight-light my-4">Edit Business Profile</h3>
				</div>
				<div class="card-body">
				 
					<?php echo form_open_multipart(base_url() . 'business/submit_business_edit'); ?>
						<input class="form-control py-4" id="inputFirstName"
										type="hidden" placeholder="Enter business name"
										name="business_id" value="<?php echo $business['business_id'];?>"/>
					
						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="small mb-1" for="inputFirstName">Business Name</label>
									<input class="form-control py-4" id="inputFirstName"
										type="text" placeholder="Enter business name"
										name="business_name" value="<?php echo $business['business_name'];?>"/>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="small mb-1" for="inputLastName">Contact Number</label>
									<input class="form-control py-4" id="inputLastName" type="text"
										placeholder="Enter contact number" name="contact_no" value="<?php echo $business['contact_no'];?>" />
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="small mb-1" for="inputEmailAddress">Location</label>
							<input class="form-control py-4" id="inputEmailAddress"
								type="text" aria-describedby="emailHelp"
								placeholder="Enter location" name="location" value="<?php echo $business['location'];?>" />
						</div>
						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="small mb-1" for="inputPassword">Fax</label> <input
										class="form-control py-4" id="inputPassword" type="text"
										placeholder="Enter fax" name="fax" value="<?php echo $business['fax'];?>" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="small mb-1" for="inputConfirmPassword">Email</label>
									<input class="form-control py-4" id="inputConfirmPassword"
										type="email" placeholder="Email" name="email" value="<?php echo $business['email'];?>" />
								</div>
							</div>
						</div>


						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="small mb-1" for="inputPassword">Web Url</label> <input
										class="form-control py-4" id="inputPassword" type="text"
										placeholder="Enter web url" name="website_url" value="<?php echo $business['website_url'];?>"/>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="small mb-1" for="inputConfirmPassword">Logo</label>
									<input class="form-control" id="inputConfirmPassword"
										type="file" name="userfile" />
								</div>
							</div>
						</div>
						
						<div class="form-group mt-4 mb-0">
							<input type="submit" class="btn btn-primary" />
						</div>
					<?php echo form_close(); ?>
				</div>

			</div>
		</div>
	</div>
</div>