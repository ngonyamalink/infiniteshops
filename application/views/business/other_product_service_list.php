<div class="container-fluid">
	<h3 align="center"><font color='red'>SMART</font>ADS</h3>
	<br />
 


	<form method="POST"
		action="<?php echo base_url("business/other_product_service_list");?>">
		<div class="input-group">
			<input id="search-input" type="search" class="form-control"
				placeholder="Search anything..." name="keyword"> <input
				type="submit" value="Search" />
		</div>
	</form>



	<div class="container content">
		<!-- Add this ... -->


<?php
foreach ($product_service_list as $psl) {
    ?>

		<div class="post" style="margin-left: 0px;">
			<img src="<?php echo $psl['url']; ?>" class="post_image" alt="">
			<!-- Added this if statement... -->

			<a
				href="<?php echo base_url("business/product_service_contact_form/$psl[productservice_id]"); ?>"
				class="btn category"> R <?php echo $psl['price']; ?></a> <a
				href="<?php echo base_url("business/product_service_preview/$psl[productservice_id]");?>">
				<div class="post_info">
					<h3><?php echo $psl['productservice_name']; ?></h3>
					<div class="info">
						<span><?php   echo substr($psl['productservice_description'], 0, 20);?>...</span>
					</div>
				</div>

			</a> <a
				href="<?php echo base_url("business/product_service_contact_form/$psl[productservice_id]"); ?>">
				<div class="post_info">

					<div class="info">
						<span class="read_more">Contact the seller.</span>
					</div>
				</div>
			</a>


		</div>


<?php } ?>
	
	</div>




</div>

<br/>

<style type="text/css">

/* CONTENT */
.content {
	margin: 5px auto;
	border-radius: 5px;
	min-height: 400px;
}

.content:after {
	content: "";
	display: block;
	clear: both;
}

.content .content-title {
	margin: 10px 0px;
	color: #374447;
	font-family: 'Averia Serif Libre', cursive;
}

.content .post {
	width: 335px;
	margin: 9px;
	min-height: 320px;
	float: left;
	border-radius: 2px;
	border: 1px solid #b3b3b3;
	position: relative;
}

.content .post .category {
	margin-top: 0px;
	padding: 3px 8px;
	color: #374447;
	background: white;
	display: inline-block;
	border-radius: 2px;
	border: 1px solid #374447;
	box-shadow: 3px 2px 2px;
	position: absolute;
	left: 5px;
	top: 5px;
	z-index: 3;
}

.content .post .category:hover {
	box-shadow: 3px 2px 2px;
	color: white;
	background: #374447;
	transition: .4s;
	opacity: 1;
}

.content .post .post_image {
	height: 260px;
	width: 100%;
	background-size: 100%;
}

.content .post .post_image {
	width: 100%;
	height: 260px;
}

.content .post .post_info {
	height: 100%;
	padding: 0px 5px;
	font-weight: 200;
	font-family: 'Noto Serif', serif;
}

.content .post .post_info {
	color: #222;
}

.content .post .post_info span {
	color: #A6A6A6;
	font-style: italic;
}

.content .post .post_info span.read_more {
	position: absolute;
	right: 5px;
	bottom: 5px;
}
</style>

<style>
body {
	margin-top: 20px;
}

.carbon-example {
	padding: 8px;
	background-color: #fff;
	width: 295px;
	box-sizing: border-box;
	border-radius: 6px;
	-webkit-box-align: start;
	-ms-flex-align: start;
	-webkit-align-items: flex-start;
	-moz-align-items: flex-start;
	align-items: flex-start;
	position: relative;
	z-index: 5;
	box-shadow: 0 2px 20px 0 rgba(0, 0, 0, 0.1);
	margin-top: 20px;
}

.carbon-example img {
	margin-right: 9px;
	max-width: 125px;
}

.carbon-example .inner-wrapper {
	text-align: left;
}

.carbon-example .inner-wrapper p {
	font-size: 12px;
	line-height: 1.33;
	margin: 8px 0;
}

.carbon-example .inner-wrapper p.fine-print {
	font-size: 8px;
	color: #C5CDD0;
	line-height: 1.25;
	text-transform: uppercase;
	font-weight: 500;
}

.flex-wrapper {
	display: -webkit-box;
	display: -webkit-flex;
	display: -moz-flex;
	display: -ms-flexbox;
	display: flex;
	-webkit-box-align: center;
	-ms-flex-align: center;
	-webkit-align-items: center;
	-moz-align-items: center;
	align-items: center;
	-webkit-box-pack: justify;
	-ms-flex-pack: justify;
	-webkit-justify-content: space-between;
	-moz-justify-content: space-between;
	justify-content: space-between;
}

@media screen and (max-width: 991px) {
	.flex-wrapper.two-col {
		display: block;
		text-align: center;
	}
}

.flex-wrapper.two-col>* {
	width: 50%;
}

.flex-wrapper.two-col>*:first-of-type {
	padding-right: 130px;
}

@media screen and (max-width: 991px) {
	.flex-wrapper.two-col>* {
		width: 100%;
	}
	.flex-wrapper.two-col>*:first-of-type {
		padding-right: 0;
	}
}

.flex-wrapper.two-col.reversed>*:first-of-type {
	order: 2;
	padding-right: 0;
}

@media screen and (min-width: 992px) {
	.flex-wrapper.two-col.reversed>*:first-of-type {
		padding-left: 130px;
	}
}

.flex-wrapper.three-col {
	text-align: left;
	-webkit-box-align: start;
	-ms-flex-align: start;
	-webkit-align-items: flex-start;
	-moz-align-items: flex-start;
	align-items: flex-start;
	margin-top: 40px;
}

@media screen and (max-width: 767px) {
	.flex-wrapper.three-col {
		-webkit-flex-wrap: wrap;
		-moz-flex-wrap: wrap;
		-ms-flex-wrap: wrap;
		flex-wrap: wrap;
	}
}

.flex-wrapper.three-col>* {
	width: 33.3%;
}

@media screen and (max-width: 767px) {
	.flex-wrapper.three-col>* {
		width: 100%;
	}
}

@media screen and (min-width: 768px) {
	.flex-wrapper.three-col li {
		padding-left: 20px;
		padding-right: 20px;
	}
	.flex-wrapper.three-col li:first-child {
		padding-left: 0;
	}
	.flex-wrapper.three-col li:last-child {
		padding-right: 0;
	}
}

.flex-wrapper.three-col .flex-wrapper {
	-webkit-box-align: start;
	-ms-flex-align: start;
	-webkit-align-items: flex-start;
	-moz-align-items: flex-start;
	align-items: flex-start;
	margin-top: 0;
}

@media screen and (max-width: 767px) {
	.flex-wrapper.three-col .flex-wrapper {
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		-webkit-justify-content: center;
		-moz-justify-content: center;
		justify-content: center;
	}
	.flex-wrapper.three-col .flex-wrapper:not(:first-of-type) {
		margin-top: 40px;
	}
}

.flex-wrapper.three-col .flex-wrapper .icon {
	top: 0;
	transform: none;
}

.sidebar-social {
	margin: 0;
	padding: 0;
}

.sidebar-social ul {
	margin: 0;
	padding: 5px;
}

.sidebar-social li {
	text-align: center;
	width: 31.9%;
	margin-bottom: 3px !important;
	background-color: #fff;
	border: 1px solid #eee;
	display: inline-block;
	font-size: 10px;
	padding: 0;
}

.sidebar-social i {
	display: block;
	margin: 0 auto 10px auto;
	width: 32px;
	height: 32px;
	margin: 10px auto 0;
	line-height: 32px;
	text-align: center;
	font-size: 20px;
	color: #444444;
	margin-top: 0;
	padding-top: 5px;
}

.sidebar-social a {
	text-decoration: none;
	width: 100%;
	height: 100%;
	display: block;
	margin: 0;
	padding: 0;
}

.sidebar-social a span {
	color: black;
	font-size: 10px;
	padding: 5px 0 10px 0;
	display: block;
	text-transform: uppercase;
	font-family: 'Josefin Sans';
	letter-spacing: 1px;
}

.sidebar-social a:hover i.fa-shopping-cart {
	color: #FF0000;
}

.sidebar-social a:hover i.fa-car {
	color: #00ABE3
}

.sidebar-social a:hover i.fa-music {
	color: #FFD400
}

.sidebar-social a:hover i.fa-hand-o-up {
	color: #FF0000
}

.sidebar-social a:hover i.fa-bullhorn {
	color: #cb2027
}

.sidebar-social a:hover i.fa-graduation-cap {
	color: #FF57AE
}

.sidebar-social a:hover i.fa-500px {
	color: #00ABE3
}

.sidebar-social a:hover i.fa-youtube {
	color: #FF1F25
}

.sidebar-social a:hover i.fa-behance {
	color: #FF57AE
}
</style>





<!-- 



<div class="container-fluid">
	<h3 align="center">Products and Services</h3>
	<br />
	
	
	
	
	
	
	
	<div class="card mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Product</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Product</th>
						</tr>
					</tfoot>
					<tbody>
					
					
					
					
					
					
                                        
                                          <?php
                                        /*
                                         * $cnt = 0;
                                         * foreach ($product_service_list as $psl) {
                                         * echo "<tr>";
                                         * echo "<td nowrap>";
                                         * echo "<a href=" . base_url("business/product_service_preview/$psl[productservice_id]") . ">";
                                         * echo "<img src=" . $psl['url'] . " class='img-thumbnail' alt='' style = 'max-width:4.5cm;max-height:4.5cm'>";
                                         * echo "</a>";
                                         * echo "<br/><font size='5' color='#800080'>$psl[productservice_name]</font>";
                                         * echo "<br/> <font color='grey' size='3'>$psl[productservice_description] ($psl[productservice_code])</font>";
                                         * echo "<br/><font size='5' color='#800080'>R $psl[price]</font>";
                                         * echo "</td>";
                                         *
                                         * echo "</tr>";
                                         * }
                                         */
                                        ?>
                        </tbody>
				</table>
			</div>
		</div>
	</div>
</div>

 -->
