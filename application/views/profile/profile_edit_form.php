<div>
	<?php
	  $this->load->view('alert');
	?>
</div>

<div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">View/Edit Profile</h3></div>
                                    <div class="card-body">
                                        <form action='<?php echo base_url("profile/update_profie")?>'  method="POST">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">First Name</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter first name" name="member_name" value="<?php echo $member_name;?>"   />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Last Name</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter last name" name="member_surname" value="<?php echo $member_surname;?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" name="member_email" value="<?php echo $email;?>"/>
                                            </div>
                                           
                                            <div class="form-group mt-4 mb-0"> <input type="submit" class="btn btn-primary" value ="Update"/></div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="<?php echo base_url("login")?>">Change Password</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
