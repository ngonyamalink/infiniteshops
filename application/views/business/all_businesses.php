
<br />
<div class="container-fluid">
	<div class="card mb-4">
		<div class="card-header">
			<i class="fas fa-table mr-1"></i>Business List
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%"
					cellspacing="0">
					<thead>
						<tr>
							<th></th>
							<th>Location</th>

						</tr>
					</thead>
					<tfoot>
						<tr>
							<th></th>
							<th>Location</th>

						</tr>
					</tfoot>
					<tbody>
                                        
                                        
                                          <?php
                                        foreach ($businesses as $b) {
                                            echo "<tr>";

                                            echo "<td nowrap> <img src=" . $b['logo_url'] . " class='img-thumbnail' alt='company logo' style = 'max-width:2.5cm;max-height:2.5cm'> </td>";
                                            echo "<td><font size='4'>$b[business_name]</font>


<br/>

<font size='3' color='grey'> $b[location]</font>
<br/>

<a href=" . base_url("business/product_service_list/$b[business_id]") . ">Products / Services</a>


</td>";

                                            echo "</tr>";
                                        }

                                        ?>
                                        </tbody>
				</table>
			</div>
		</div>
	</div>
</div>






