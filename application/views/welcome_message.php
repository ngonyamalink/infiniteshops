<br/>
<div class="container-fluid">
 
	<div class="card mb-4">

		<div class="col-lg-12 text-center">
			<h1 class="mt-5">Welcome to FrigateBird.</h1>
			<p class="lead">Gone are days where you had to walk lenghty distances searching
				for a transport on the streets. We are advancing now, you can find us
				conveniently on the click of a button. Isn't that awesome ?</p>

			<p class="lead">
				Don't wait any further, give us your <b><u>Starting Point</u></b>
				and <b><u>Destination Point</u></b>, and we'll take you there. We cater for both local and long distances.
			</p>

			<h2 class="mt-5">
						
			<a href="<?php echo base_url("index.php/welcome/listyourtransport")?>">
					<button type="button" class="btn btn-danger">List Your Transport</button></a>
			
				<a href="<?php echo base_url("index.php/user/create_request")?>">
					<button type="button" class="btn btn-primary">Request A Trip</button></a>
			</h2>

		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%"
					cellspacing="0">
					<thead>
						<tr>
							<th>Reg No</th>
							<th>VIN No</th>
							<th>Mode</th>
							<th>Trip Date</th>
							<th>Starting point</th>
							<th>Destination</th>
							<th>Edit</th>

						</tr>
					</thead>
					<tfoot>
						<tr>

							<th>Reg No</th>
							<th>VIN No</th>
							<th>Mode</th>
							<th>Trip Date</th>
							<th>Starting point</th>
							<th>Destination</th>
							<th>Edit</th>

						</tr>
					</tfoot>
				<tbody>
                    <?php
                    
                    $transportmode = alltransportmode();
                    $cnt = 0;
                    foreach ($transport as $t) {
                        $cnt = $cnt + 1;
                        echo "<tr>";
                        echo "<td> $t[registration_number]  </td>";
                        echo "<td> $t[vin_number]  </td>";
                        echo "<td>". $transportmode[$t['transport_mode']]  ."</td>";
                        echo "<td> $t[trip_date]  </td>";
                    	echo "<td> $t[starting_point]  </td>";
                    	echo "<td> $t[destination]  </td>";
                        echo "<td><a href=" . base_url('user/request_available_transport/' . $t['id']) . ">Request</a> </td>";
                        echo "</tr>";
                    }
                    
                    ?> 
                                                            
                 </tbody>
				</table>
			</div>
		</div>
		
	</div>
</div>