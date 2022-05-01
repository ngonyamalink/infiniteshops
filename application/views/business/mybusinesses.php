
<br />
<div class="container-fluid">

	<h4 align="center">Manage Your Businesses</h4>

	<br />

	<div class="card mb-4">

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped" id="dataTable" width="100%"
					cellspacing="0">
					<thead>
						<tr>
							<th>Image</th>



						</tr>
					</thead>
					<tfoot>
						<tr>

							<th>Image</th>


						</tr>
					</tfoot>
					<tbody>
                                          <?php
                                        foreach ($businesses as $b) {
                                            echo "<tr>";
                                            echo "<td nowrap> <img src=" . $b['logo_url'] . " class='img-thumbnail' alt='company logo' style = 'max-width:2.5cm;max-height:2.5cm'/> 

<br/>
<a href=" . base_url("business/about_edit_form/$b[business_id]") . ">$b[business_name]</a>

<br/>

<i class='fa fa-map-marker' aria-hidden='true' style='font-size:170%; color:blue;'></i>&nbsp;  $b[location]  $b[fax] / $b[email]

<br/>
 <a href=" . base_url("business/product_service_list/$b[business_id]") . ">Products / Services</a> |  <a href=" . base_url("business/product_service_create_form/$b[business_id]") . ">Add</a> | 

                                           <a href=" . base_url("business/business_edit_form/$b[business_id]") . "> Edit </a> 

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






