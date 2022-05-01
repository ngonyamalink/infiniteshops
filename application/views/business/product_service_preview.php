<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-7">
			<div class="card shadow-lg border-0 rounded-lg mt-5">
				<div class="card-header">
					<h3 class="text-center font-weight-light my-4"><?php echo $productservice['productservice_name'];?></h3>
				</div>

				<img src="<?php echo $productservice['url']; ?>" class="img-rounded"
					alt="" width="100%" height="350px">


				<div class="card-body">
					<form
						action='<?php echo base_url("business/submit_product_service_edit")?>'
						method="POST">


						<label> <font size="5">R <?php echo $productservice['price']; ?></font></label>

						<div class="form-row">
							<label class="small mb-1" for="inputFirstName">Category</label> <select
								class="form-control" name="businesscategorylist_includes_id"
								readonly>
									
									
									<?php

        foreach (all_subcategories() as $sc) {

            if ($productservice['businesscategorylist_includes_id'] == $sc['id']) {
                echo "<option value=$sc[id] selected>$sc[includes_item]</option>";
            } else {
                echo "<option value=$sc[id]>$sc[includes_item]</option>";
            }
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
										name="productservice_name"
										value="<?php echo $productservice['productservice_name'];?>"
										readonly />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="small mb-1" for="inputConfirmPassword">Description</label>
									<input class="form-control py-4" id="inputConfirmPassword"
										type="text" placeholder="Description"
										name="productservice_description"
										value="<?php echo $productservice['productservice_description'];?>"
										readonly />
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="small mb-1" for="inputPassword">Code</label> <input
								class="form-control py-4" id="inputPassword" type="text"
								placeholder="Enter product service code"
								name="productservice_code"
								value="<?php echo $productservice['productservice_code'];?>"
								readonly />


						</div>

						<input class="form-control py-4" id="inputConfirmPassword"
							type="hidden" placeholder="Business Id" name="business_id"
							value="<?php echo $productservice['business_id'];?>" /> <input
							class="form-control py-4" id="inputConfirmPassword" type="hidden"
							placeholder="Business Id" name="productservice_id"
							value="<?php echo $productservice['productservice_id'];?>"
							readonly /> <label class="small mb-1" for="inputConfirmPassword">Price
							(R)</label> <input class="form-control py-4"
							id="inputConfirmPassword" type="text" placeholder="Business Id"
							name="price" value="<?php echo $productservice['price']; ?>"
							readonly /> <br />

						<p align="center">
							<a
								href="<?php echo base_url('business/product_service_contact_form/'.$productservice['productservice_id']); ?>">
								<button type="button" class="btn btn-primary">Enquire From Seller</button>
							</a>
						</p>


					</form>



				 

				</div>




			</div>
		</div>
	</div>
</div>