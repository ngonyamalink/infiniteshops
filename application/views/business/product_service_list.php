
<br />
<div class="container-fluid">

<p class="lead">

We host unlimited number of businesses that want to advertise their products and services. An online shopping platform that is easy to navigate and helps customers locate the shops they want, with the search engine users can easily filter what they are looking for.

</p>
<br/>



	<div class="card mb-4">
		 
			<div class="card-header" align="center">
			<a href="<?php echo base_url("business/product_service_create_form/$business_id");?>"><button type="button" class="btn btn-danger">Post Free Ad</button> </a>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%"
					cellspacing="0">
					<thead>
						<tr>
							<th>Name</th>
							<th>Image</td>
							<th>Description</th>
							<th>Code</th>
							<th>Price (R)</th>
							<th>Edit</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Name</th>
							<th>Image</th>
							<th>Description</th>
							<th>Code</th>
							<th>Price (R)</th>
							<th>Edit</th>

						</tr>
					</tfoot>
					<tbody>
                                        
                                        
                                          <?php
                                        foreach ($product_service_list as $psl) {
                                            echo "<tr>";
											echo "<td>$psl[productservice_name]</td>";
											echo "<td nowrap> <img src=".$psl['url']." class='img-thumbnail' alt='' style = 'max-width:2.5cm;max-height:2.5cm'> </td>";
                                            echo "<td>$psl[productservice_description]</td>";
                                            echo "<td>$psl[productservice_code]</td>";
                                            echo "<td>$psl[price]</td>";
                                            echo "<td><a href=" . base_url("business/product_service_edit_form/$psl[business_id]/$psl[productservice_id]") . ">Edit</a></td>";
                                            echo "</tr>";
                                        }

                                        ?>
                        </tbody>
				</table>
			</div>
		</div>
	</div>
</div>






