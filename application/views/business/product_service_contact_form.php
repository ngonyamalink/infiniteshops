
<div>
	<?php
	  $this->load->view('alert');
	?>
</div>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-10">
			<div class="card shadow-lg border-0 rounded-lg mt-5">
				<img src="<?php echo $productservice['url']; ?>" class="img-rounded" alt="" width="100%" height="350px"> 



				<div class="card-body">
					<form
						action='<?php echo base_url("business/submit_product_service_contact_form")?>'
						method="POST">
						
						
						 <label> <font size="5">R <?php echo $productservice['price']; ?></font></label>

<input
								class="form-control py-4" id="inputFirstName" type="hidden"
								 name="productservice_id" value="<?php echo $productservice['productservice_id']; ?>" readonly />

						<div class="form-group">
							<label class="small mb-1" for="inputFirstName">Email To</label> <input
								class="form-control py-4" id="inputFirstName" type="text"
								 name="emailto" value="<?php echo $productservice['email']; ?>" readonly />
						</div>
						
						
						<div class="form-group">
							<label class="small mb-1" for="inputFirstName">Your Email</label> <input
								class="form-control py-4" id="inputFirstName" type="text"
								 name="emailfrom"  />
						</div>

						<div class="form-group">
							<label class="small mb-1" for="inputFirstName">Subject</label> <input
								class="form-control py-4" id="inputFirstName" type="text"
								placeholder="Enter subject" name="subject" value="<?php echo $productservice['productservice_name']; ?>"/>
						</div>

						<div class="form-group">
							<label for="exampleFormControlTextarea1">Message</label>
							<textarea class="form-control" id="exampleFormControlTextarea1"
								rows="3" name="message"></textarea>
						</div> 



						<div class="form-group mt-4 mb-0" align="center">
							<input type="submit" class="btn btn-primary"  value="Send Message"/>
						</div>
					</form>
				</div>


	 
		
		<br/>
			</div>
		</div>
	</div>
</div>
