

<br />
<link
	href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
	rel="stylesheet" id="bootstrap-css">
<script
	src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script
	src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
	<div class="card-header">
		<h3 class="text-center font-weight-light my-4">About <?php echo $aboutcontent['business_name']; ?></h3>
	</div>
	<div class="row">

		<div class="col-md-12" align="center">

	 

			<form action='<?php echo base_url("business/submit_about_edit")?>'
				method="POST">


				<input class="form-control py-4" id="inputPassword" type="hidden"
					placeholder="Enter product service price" name="business_id"
					value="<?php echo $business_id; ?>" /> <label class="small mb-1"
					for="inputLastName"><b>Who are we ?</b></label>

				<textarea class="form-control" style="height: 150px;"
					name="who_are_we"><?php echo $aboutcontent['who_are_we']; ?> </textarea>
				<br /> <label class="small mb-1" for="inputLastName"><b>Who are we ?</b></label>

				<textarea class="form-control" style="height: 150px;"
					name="what_we_do"><?php echo $aboutcontent['what_we_do']; ?></textarea>
				<br /> <label class="small mb-1" for="inputLastName"><b>Our mission ?</b></label>
				<textarea class="form-control" style="height: 150px;"
					name="our_mission"><?php echo $aboutcontent['our_mission']; ?></textarea>
				<br /> <label class="small mb-1" for="inputLastName"><b>We love our
					clients ?</b></label>
				<textarea class="form-control" style="height: 150px;"
					name="we_love_our_clients"><?php echo $aboutcontent['we_love_our_clients']; ?></textarea>
				<br /> <input type="submit" class="btn btn-primary" />

			</form>
		</div>

	</div>

</div>
