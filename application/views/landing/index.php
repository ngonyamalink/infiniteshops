
<br />



<div class="container-fluid">
	<h4 align="center">Service Providers</h4>
	<br />

	<div class="card mb-4">

		<div class="card-body">
			<div class="table-responsive">
				<table class="table" id="dataTable" width="100%" cellspacing="0"
					table-layout="auto">
					<thead>
						<tr>
							<th></th>

						</tr>
					</thead>
					<tfoot>
						<tr>
							<th></th>
						</tr>
					</tfoot>
					<tbody>
                                        
                                        
                                          <?php
                                        foreach ($businesses as $b) {
                                            echo "<tr>";
                                            echo "<td nowrap>";
                                            echo "<img src=" . $b['logo_url'] . " class='img-thumbnail' alt='company logo' style = 'max-width:4.5cm;max-height:4.5cm'>";
                                            echo "<br/><a href=" . base_url("business/about_edit_form/$b[business_id]") . "><font size='5'>About $b[business_name]</font></a>";
                                            echo "<br/> <i class='fa fa-map-marker' aria-hidden='true' style='font-size:170%; color:blue;'></i>&nbsp;<font color='grey' size='3'>$b[location],  $b[fax] </font>";
                                            echo "<br/> <font size='5'><a href=" . base_url("business/product_service_list/$b[business_id]") . ">Products / Services</a></font>";
                                            echo "</td>";
                                            echo "</tr>";
                                        }

                                        ?>
                                        </tbody>
				</table>
			</div>
		</div>
	</div>
</div>