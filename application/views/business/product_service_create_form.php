
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
					<h3 class="text-center font-weight-light my-4">Create
						Product/Service</h3>
				</div>
				<div class="card-body">
				 

						<?php echo form_open_multipart(base_url() . 'business/submit_product_service_create'); ?>


						<div class="form-row">
							<label class="small mb-1" for="inputFirstName">Category</label> <select
								class="form-control" name="businesscategorylist_includes_id">
									
									
									<?php

        foreach (all_subcategories() as $sc) {

            echo "<option value=$sc[id]>$sc[includes_item]</option>";
        }
        ?>
									
								
										
										
									</select>
						</div>

						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="small mb-1" for="inputPassword">Name</label> <input
										class="form-control py-4" id="inputPassword" type="text"
										placeholder="Enter product service name"
										name="productservice_name" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="small mb-1" for="inputConfirmPassword">Description</label>
									<input class="form-control py-4" id="inputConfirmPassword"
										type="text" placeholder="Description"
										name="productservice_description" />
								</div>
							</div>
						</div>


						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="small mb-1" for="inputPassword">Code</label> <input
										class="form-control py-4" id="inputPassword" type="text"
										placeholder="Enter product service code"
										name="productservice_code" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="small mb-1">Photo / or image url (.jpg or .png)</label>
									<input class="form-control" id="inputConfirmPassword"
										type="file" placeholder="Photo" name="userfile" />
								</div>
							</div>
						</div>


						<div class="form-row">

							<label class="small mb-1" for="inputPassword">Price (R)</label> <input
								class="form-control py-4" id="inputPassword" type="text"
								placeholder="Enter product service price" name="price" />


						</div>
						<input class="form-control py-4" id="inputConfirmPassword"
							type="hidden" placeholder="Business Id" name="business_id"
							value="<?php echo $business_id;?>" />

						<div class="form-group mt-4 mb-0">
							<input type="submit" class="btn btn-primary" />
						</div>
				<?php echo form_close(); ?>
				</div>

			</div>
		</div>
	</div>
</div>