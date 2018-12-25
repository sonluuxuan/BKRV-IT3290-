<?php
	session_start();
	$flags = 0;
	if(isset($_GET["username"]))
	{
		$usernameGet = $_GET["username"];
		if(isset($_SESSION[$usernameGet][1]))
			{
				$usernamePhp = $_SESSION[$usernameGet][0];
				$flags = 1;
			}
	}
	else {
		$usernamePhp = 'none';
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<!-- Custom Fonts -->
		<link rel="stylesheet" href="custom-font/fonts.css" />
		<!-- Bootstrap -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<!-- Font Awesome -->
		<link rel="stylesheet" href="css/font-awesome.min.css" />
		<!-- Bootsnav -->
		<link rel="stylesheet" href="css/bootsnav.css">
		<!-- Fancybox -->
		<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.5" media="screen" />	
		<!-- Custom stylesheet -->
		<link rel="stylesheet" href="css/listing-detail.css" />
		<!-- AngularJS -->
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
		<!-- Simple line Icon -->
		<link rel="stylesheet" href="css/simple-line-icons.css">
		<!-- Themify Icon -->
		<link rel="stylesheet" href="css/themify-icons.css">
		<!--ajax lib-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	<body>

		<!-- Preloader -->

		<div id="loading">
			<div id="loading-center">
				<div id="loading-center-absolute">
					<div class="object"></div>
					<div class="object"></div>
					<div class="object"></div>
					<div class="object"></div>
					<div class="object"></div>
					<div class="object"></div>
					<div class="object"></div>
					<div class="object"></div>
					<div class="object"></div>
					<div class="object"></div>
				</div>
			</div>
		</div>

		<!--End off Preloader -->

		<!-- Header -->
		<header>
			<!-- Navbar -->
			<nav class="navbar bootsnav">
				<div class="container">
					<!-- Header Navigation -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
							<i class="fa fa-bars"></i>
						</button>
						<a class="navbar-brand" href=""><img class="logo" src="images/logo.png" alt="" style="width: 200px; height: 50px"></a>
					</div>
					<!-- Navigation -->
					<div class="collapse navbar-collapse" id="navbar-menu">
						<ul class="nav navbar-nav menu">

							<!--session for login and logout-->		
							<?php
							$a = 1;
								if($flags == 0)
								{
									echo "<li><a href='index.php'>Trang chủ</a></li>";
									echo "<li><a href='login.php?location=".urlencode($_SERVER['REQUEST_URI'])."'>Đăng Nhập</a></li>";
									echo "<li><a href='register.php'>Đăng Ký</a></li>";
								}   
								if($flags == 1)
								{
									echo "<li><a href='index.php?username=".$usernamePhp."'>Trang chủ</a></li>";
									echo "<li><a href=''>".$usernamePhp."</a></li>";
								}
							?>
							<!--session for logout-->
							<?php
							if($flags == 1){
								//echo "<li><a href='logout.php?username=".$usernamePhp."'>Logout</a></li>";// this line to
								if(isset($_GET['button'])){
									echo "<li><a href='logout.php?location=".urlencode(($_SERVER['REQUEST_URI']))."&username=".$usernamePhp."'>Logout</a></li>";
								}
								else{
									echo "<li><a href='logout.php?username=".$usernamePhp."'>Logout</a></li>";
								}
							}
							?>
						</ul>
					</div>
				</div>   
			</nav><!-- Navbar end -->
		</header><!-- Header end -->


		<section id="home" class="home">
			<!-- Carousel -->
			<div id="carousel" class="carousel slide" data-ride="carousel">
				<!-- Carousel-inner -->
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img src="images/listing-food.jpg">
						<div class="overlay" ng-app="myApp" ng-controller="myCtrl" ng-init="show='false'">
							<!--<form>
								<div class="inner-form">
									<div class="input-field first-wrap">
										<input id="search" type="text" placeholder="Quán ăn / món ăn / địa chỉ" />
										<i class="fa fa-sliders" style="margin-top: 3px" ng-click="switchShow()"></i>
									</div>
									<div class="input-field third-wrap">
										<button class="btn know_btn" type="button" style="border-radius: 30px" onclick="window.location.href='listing.php'">Tìm</button>
									</div>
								</div>
							</form>-->
							<!-- session for form -->
							<?php
								if($flags == 0)
								{
									echo '<form action="listing.php" method="post">';
								}   
								if($flags == 1)
								{
									echo '<form action="listing.php?username='.$usernamePhp.'" method="post">';
								}
							?>						
									<div class="inner-form">
										<div class="input-field first-wrap">
											<input class="search_box" id="search" name="search_input" type="text" placeholder="Quán ăn / món ăn / địa chỉ" />
											<i class="fa fa-sliders" style="margin-top: 3px" ng-click="switchShow()"></i>
										</div>
										<div class="input-field third-wrap">
											<input id="ignored_element" class="btn know_btn" type="submit" name="find" value="Tìm"></input>
										</div>
									</div>
								</form>
							<!-- Advanced Search Bar -->
							<div class="advance-search unselectable" ng-init="type='area'" ng-hide="show!='true'">
								<div class="sf-left">
									<ul class="sf-cate">
										<li ng-click="changeType('area')">
											<i class="fa fa-location-arrow"></i>
											<label style="margin-bottom: 0px; margin-left: 3px;">Khu vực</label>
											<i class="fa fa-angle-right" style="float: right"></i>
										</li>
										<li ng-click="changeType('price')">
											<i class="fa fa-bars"></i>
											<label style="margin-bottom: 0px; margin-left: 3px;">Mức giá</label>
											<i class="fa fa-angle-right" style="float: right"></i>
										</li>
										<li ng-click="changeType('category')">
											<i class="fa fa-cutlery"></i>
											<label style="margin-bottom: 0px; margin-left: 3px;	">Phân loại</label>
											<i class="fa fa-angle-right" style="float: right"></i>
										</li>
									</ul>
								</div>
								<script>
									var app = angular.module('myApp', []);
									app.controller('myCtrl', function($scope, $http) {
										$scope.Districts = [{
											Name: "Quận Đống Đa"
											}, {
											Name: "Quận Hoàn Kiếm"
											}, {
											Name: "Quận Ba Đình"
											}, {
											Name: "Quận Tây Hồ"
											}, {
											Name: "Quận Thanh Xuân"
											}, {
											Name: "Quận Hai Bà Trưng"
											}, {
											Name: "Quận Cầu Giấy"
											}, {
											Name: "Quận Hoàng Mai"
											}, {
											Name: "Quận Long Biên"
											}, {
											Name: "Quận Hà Đông"
											}, {
											Name: "Quận Nam Từ Liêm"
											}, {
											Name: "Quận Bắc Từ Liêm" 
										}];
										$scope.Prices = [{
											Name: "0 - 50000"
											}, {
											Name: "50000 - 100000"
											}, {
											Name: "100000 - 200000"
											}, {
											Name: "200000 - 500000"
											}, {
											Name: "> 500000" 
										}];
										$scope.Cates = [{
											Name: "Ăn vặt - Vỉa hè"
											}, {
											Name: "Cafe - Dessert"
											}, {
											Name: "Nhà hàng"
											}, {
											Name: "Bar - Pub" 
										}];
										$scope.changeType = function($type) {
											$scope.type = $type;
										};
										$scope.switchShow = function() {
											if ($scope.show == 'true') {
												$scope.show = 'false';
											} else {
												$scope.show = 'true';
											}
										};
										$scope.clearFilter = function() {
											angular.forEach($scope.Districts, function(district) {
											district.Selected = false;
											});
											angular.forEach($scope.Prices, function(price) {
											price.Selected = false;
											});
											angular.forEach($scope.Cates, function(cate) {
											cate.Selected = false;
											});
										};
										$scope.selDistrict = 0;
										$scope.selPrice = 0;
										$scope.selCate = 0;
										$scope.sel = {};
										$scope.search = function() {
											$scope.selDistrictArray = [];
											angular.forEach($scope.Districts, function(district) {
												if(district.Selected == true) {
													$scope.selDistrict = $scope.selDistrict + 1;
													$scope.selDistrictArray.push(district.Name);
												}
											});
											$scope.selPriceArray = [];
											angular.forEach($scope.Prices, function(price) {
												if(price.Selected == true) {
													$scope.selPrice = $scope.selPrice + 1;
													$scope.selPriceArray.push(price.Name);
												}
											});
											$scope.selCateArray = [];
											angular.forEach($scope.Cates, function(cate) {
												if(cate.Selected == true) {
													$scope.selCate = $scope.selCate + 1;
													$scope.selCateArray.push(cate.Name);
												}
											});
											$scope.sel['no_districts'] = $scope.selDistrict;
											$scope.sel['no_prices'] = $scope.selPrice;
											$scope.sel['no_cates'] = $scope.selCate;
											$scope.sel['selected_dist'] = $scope.selDistrictArray;
											$scope.sel['selected_price'] = $scope.selPriceArray;
											$scope.sel['selected_cate'] = $scope.selCateArray;
											console.log($.param($scope.sel));
											// working //
											//session for filter 
											<?php
												if($flags == 0)
												{
													?>
													window.location.href=('listing.php?button=filter' + '&' + $.param($scope.sel));
											<?php
													
												}   
												if($flags == 1)
												{
													?>
													window.location.href=('listing.php?button=filter&username=<?php echo $usernamePhp?>' + '&' + $.param($scope.sel));
													<?php
												}
											?>
											//window.location.href=('listing.php' + '?' + $.param($scope.sel)); //swap filtertest.php with listing.php // 
											//TODO: //
										};
									});
								</script>
								<div class="sf-right">
									<div class="sf-result" ng-hide="type!='area'">
										<ul>
											<li ng-repeat="district in Districts">
												<label class="checkbox-container" style="font-family: arial">{{district.Name}}
													<input type="checkbox" ng-model="district.Selected">
													<span class="checkmark"></span>
												</label>
											</li>	
										</ul>
									</div>
									<div class="sf-result" ng-hide="type!='price'">
										<ul>
											<li ng-repeat="price in Prices">
												<label class="checkbox-container" style="font-family: arial">{{price.Name}}
													<input type="checkbox" ng-model="price.Selected">
													<span class="checkmark"></span>
												</label>
											</li>
										</ul>
									</div>
									<div class="sf-result" ng-hide="type!='category'">
										<ul>
											<li ng-repeat="cate in Cates">
												<label class="checkbox-container" style="font-family: arial">{{cate.Name}}
													<input type="checkbox" ng-model="cate.Selected">
													<span class="checkmark"></span>
												</label>
											</li>
										</ul>
									</div>
								</div>
								<div class="sf-bottom">
									<div class="sf-btns">
										<a class="fd-btn" href="" style="text-decoration:none;" ng-click="search()">Tìm kiếm</a>
										<a class="fd-btn" href="" style="text-decoration:none;" ng-click="clearFilter()">Xóa bộ lọc</a>
									</div>
								</div>
							</div>
							<!-- Advanced Search Bar end -->			
						</div>
					</div>        
				</div><!-- Carousel-inner end -->
			</div><!-- Carousel end-->
		</section>
		
		<!--============================= FEATURED PLACES =============================-->
		<section class="main-block">
			<div class="container" id="row_of_review">
				<div class="row justify-content-center">
					<div class="col-md-5">
						<div class="styled-heading">
							<h3>Kết quả tìm kiếm</h3>
						</div>
					</div>
				</div>
				<div class="row" > <!-- add new row for new content -->
				<?php
						include 'DB_functions.php';
						include 'function.php';
						$districts = ['Quận Đống Đa', 'Quận Hoàn Kiếm', 'Quận Ba Đình', 'Quận Tây Hồ', 'Quận Thanh Xuân', 'Quận Hai Bà Trưng', 'Quận Cầu Giấy', 'Quận Hoàng Mai', 'Quận Long Biên', 'Quận Hà Đông', 'Quận Nam Từ Liêm', 'Quận Bắc Từ Liêm'];
						$prices = ['0 - 50000', '50000 - 100000', '100000 - 200000', '200000 - 500000', '> 500000'];
						$cates = ['Ăn vặt - Vỉa hè', 'Cafe - Dessert', 'Bar - Pub', 'Nhà hàng'];
						if(isset($_GET['button'])){
							$button = $_GET['button'];
							if($button == "latest"){
								$result = get_latest_review();
								$no_districts = 0;
								$no_prices = 0;
								$no_cates = 0;
							}else if($button == "popular"){
								$result = get_popular_reviews();
								$no_districts = 0;
								$no_prices = 0;
								$no_cates = 0;
							}else if($button == "filter"){
								$no_districts = $_GET['no_districts'];
								$no_prices = $_GET['no_prices'];
								$no_cates = $_GET['no_cates'];	
								$prices_arr = array();
								$price_arr = array();
								$exploded = array();
								if(isset($_GET['selected_dist'])){
									$districts = $_GET['selected_dist'];
								}
								if(isset($_GET['selected_price'])){
									$prices = $_GET['selected_price'];
								}
								if(isset($_GET['selected_cate'])){
									$cates = $_GET['selected_cate'];
								}
								if($prices != null){
									foreach ($prices as $price) {
										$exploded = explode(" ", $price);
										if(count($exploded)==3){
											$price_arr[0] = $exploded[0];
											$price_arr[1] = $exploded[2];
											$prices_arr[] = $price_arr;
										}
										else{
											$price_arr[0] = $exploded[1];
											$price_arr[1] = 10000000000;
											$prices_arr[] = $price_arr;
										}

									}
								}
								if($no_prices == 0 && $no_districts == 0 && $no_cates == 0){
									//header("Location: .?error=emptyfields");
									//exit();
								}else{
									$result = filter($no_districts, $no_cates, $no_prices, $districts, $cates, $prices_arr);
								}
							}
							else if($button == "an_vat_via_he"){
								$result = get_quick_search(1);
								$no_districts = 0;
								$no_prices = 0;
								$no_cates = 0;
							}
							else if($button == "cafe_dessert"){
								$result = get_quick_search(2);
								$no_districts = 0;
								$no_prices = 0;
								$no_cates = 0;
							}
							else if($button == "bar_pub"){
								$result = get_quick_search(4);
								$no_districts = 0;
								$no_prices = 0;
								$no_cates = 0;
							}
							else if($button == "nhahang"){
								$result = get_quick_search(3);
								$no_districts = 0;
								$no_prices = 0;
								$no_cates = 0;
							}
						}
						
						$search_input = "none";
						if (isset($_POST['find'])){
							$button = "find";
							$no_districts = 0;
							$no_prices = 0;
							$no_cates = 0;
							//$search_input = $_POST['search_input'];
							if(!isset($_POST['search_input'])){
								header("Location: .?error=emptyfields");
								exit();
							}
							else{
								$search_input = $_POST['search_input'];
								$result = getReviewBySearchInput($search_input);
							}
						}
						$cnt = 0;
						if(!empty($result)) {
							$cnt_result = count($result);
						}
						else $cnt_result = 0;
						while($cnt < 3 && $cnt < $cnt_result){ // 3 reviews per row
							if($result[$cnt]["rating"] < 5){
								$class_rating = "featured-rating";
							}else if($result[$cnt]["rating"] >= 5 && $result[$cnt]["rating"] < 8){
								$class_rating = "featured-rating-orange";
							}else if($result[$cnt]["rating"] >= 8){
								$class_rating = "featured-rating-green";
							}
				?>
					<div class="col-md-4 featured-responsive">
						<div class="featured-place-wrap">
							<a href="detail.php?review_id=<?php echo $result[$cnt]["id"]; ?>">

							<!--session for detail.php not in ajax-->
							<?php
								if($flags == 0)
								{
									echo '<a href="detail.php?review_id='.$result[$cnt]["id"].'">';
								}   
								if($flags == 1)
								{
									echo '<a href="detail.php?review_id='.$result[$cnt]["id"].'&username='.$usernamePhp.'">';
								}
							?>
								<img src="<?php echo get_thumbnail("images/".$result[$cnt]["id"]);?>" class="img-fluid" alt="#">
								<span class="<?php echo $class_rating?>"><?php echo $result[$cnt]["rating"];?></span>
								<div class="featured-title-box">
									<h6 name="store_name"><?php echo $result[$cnt]["ten"];?></h6>
									<?php $result_loai = get_loai($result[$cnt]["id"]);?>
									<p name="store_type"><?php echo $result_loai[0]["loai"];?></p>
									<!--<p><span>$$$</span>$$</p>--> <!-- Based on price range -->
									<ul>
										<li><span class="ti-location-pin"></span>
											<p name="store_address"><?php echo $result[$cnt]["dia_chi"];?></p>
										</li>
										<li><span class="fa fa-tag minmaxpriceicon"></span>
										<?php
											$result_price_range = get_price_range($result[$cnt]["id"]);
											$low = $result_price_range[0]["gia"];
											$high = $result_price_range[1]["gia"];
											//if($low === $high)
										?>
											<p name="store_pricerange"> 
												<?php
													if($low === $high){
														echo $low;
													}
													else{
														echo $low." - ".$high;
													}	
												?>
											</p>
										</li>
										<li><span class="ti-time"></span>
										<?php
											$result_time_range = get_time_range($result[$cnt]["id"]);
											$time_low = $result_time_range[0]["time_open"];
											$time_high = $result_time_range[0]["time_close"];
											//if($low === $high)
										?>
											<p name="store_opening"><?php echo $time_low." - ".$time_high?></p>
										</li>
									</ul>
									<div class="bottom-icons">
										<!--<div class="closed-now">CLOSED NOW</div> --><!-- Based on opening hour -->
										<?php
											date_default_timezone_set("Asia/Ho_Chi_Minh");
											$time = date("H:i:s");
											if (strtotime($time) >= strtotime($time_low) && strtotime($time) <= strtotime($time_high)){
												echo '<div class="open-now">OPEN NOW</div> <!-- Based on opening time -->';
											}
											else{
												echo '<div class="closed-now">CLOSED NOW</div> <!-- Based on opening time -->';
											}
										?>
										<?php
											$like_dislike_arr = get_num_of_like_dislike($result[$cnt]["id"]);
										?>
										<span class="ti-heart"><span class="upvote display-number" name="store_point"><?php echo $like_dislike_arr["likes"];?></span></span> 
										<!-- Number of upvotes - number of downvotes -->
										<?php
											$result_num_comment = get_number_of_comments($result[$cnt]["id"]);
											if(empty($result_num_comment)) {
												$cnt_comment["cnt"] = 0; 
											}
											else 
												$cnt_comment = $result_num_comment[0]; 
										?> 
										<span class="ti-comments"><span class="comment display-number" name="no_comments"><?php echo $cnt_comment["cnt"];?></span></span>
									</div>
								</div>
							</a>
						</div>
					</div>
					<?php
					$cnt = $cnt+1;
					//echo "_____________________________________".$cnt;
					}
					?>
					<!--<p><?php// echo "these are chosen districts:".var_dump($districts).$districts[0];?></p>   -->
				</div>
				<script>
					$(document).ready(function(){
						console.log("ready");
						var cnt = <?php echo $cnt;?>;
						var flags = <?php echo $flags;?>;
						var username = "none";
						username =  "<?php echo $usernamePhp;?>";
						console.log(username);
						
						$(".wtf").click(function(){
							console.log("clicked");
							var id = this.id;   // Getting Button id
							var type = id;
							var cnt_post = cnt;  // postid
							//alert(cnt_post);
							//alert(type);
							var search_input = "";
							var districts = [];
							var prices = [];
							var cates = [];
							var no_districts = 0;
							var no_cates = 0;
							var no_prices = 0;
							console.log(<?php echo json_encode($districts)?>);
							if (type == 'find'){
								search_input = "<?php echo $search_input;?>";
								console.log(search_input);
							}
							else if(type == 'filter'){
								console.log("yes");
								var i, j, k;
								no_districts = <?php echo $no_districts;?>;
								no_cates = <?php echo $no_cates;?>;
								no_prices = <?php echo $no_prices;?>;
								
								districts = <?php echo json_encode($districts)?>;
								prices = <?php echo json_encode($prices)?>;
								cates = <?php echo json_encode($cates)?>;
								
								//alert(districts);
							}
							else {
								console.log(type);
							}
							var data = {cnt_post:cnt_post, type:type, search_input:search_input, no_districts:no_districts, no_prices:no_prices, no_cates:no_cates,districts:districts,prices:prices,cates:cates};
							console.log(data);
							$.ajax({
											url: 'view_more.php',
											type: 'post',
											data: {cnt_post:cnt_post, type:type, search_input:search_input, no_districts:no_districts, no_prices:no_prices, no_cates:no_cates,districts:districts,prices:prices,cates:cates},
											dataType: 'json',
											success: function(data){
												console.log("success");
												var cnt_received = data['cnt_received'];
												var large = '<div class="row"> ' ;
												if (flags == 0){
													for (i=0; i<cnt_received; i++){
														large += '<div class="col-md-4 featured-responsive">	                    <div class="featured-place-wrap">	                        <a href="detail.php?review_id='+data[i]['id']+'">	                            <img src="'+data[i]['thumbnail']+'" class="img-fluid" alt="#">	                            <span class="'+data[i]['class_rating']+'">'+data[i]['rating']+'</span>	                            <div class="featured-title-box">	                                <h6>'+data[i]['ten']+'</h6>	                                <p>'+data[i]['loai']+'</p>	                                <ul>	                                    <li><span class="ti-location-pin"></span>	                                        <p name="store_name">'+data[i]['dia_chi']+'</p>	                                    </li>	                                    <li><span class="fa fa-tag minmaxpriceicon"></span>	                                        <p name="store_pricerange">'+data[i]['low']+' - '+data[i]['high']+'</p>	                                    </li>	                                    <li><span class="ti-time"></span>	                                        <p name="store_opening">'+data[i]['time_low']+' - '+data[i]['time_high']+'</p>	                                    </li>	                                </ul>	                                <div class="bottom-icons">	                                    <div class="'+data[i]['class_time']+'">'+data[i]['status']+'</div>	                                    <span class="ti-heart"><span class="upvote display-number" name="no_upvotes">'+data[i]['likes']+'</span></span>	                                    <span class="ti-comments"><span class="comment display-number" name="no_comments">'+data[i]['comments']+'</span></span>	                                </div>	                            </div>	                        </a>	                    </div>	                </div>';
														cnt = cnt+1;
														//alert(cnt);
													}
												} else{
													for (i=0; i<cnt_received; i++){
														large += '<div class="col-md-4 featured-responsive">	                    <div class="featured-place-wrap">	                        <a href="detail.php?review_id='+data[i]['id']+'&username='+username+'">	                            <img src="'+data[i]['thumbnail']+'" class="img-fluid" alt="#">	                            <span class="'+data[i]['class_rating']+'">'+data[i]['rating']+'</span>	                            <div class="featured-title-box">	                                <h6>'+data[i]['ten']+'</h6>	                                <p>'+data[i]['loai']+'</p> 	                                <ul>	                                    <li><span class="ti-location-pin"></span>	                                        <p name="store_name">'+data[i]['dia_chi']+'</p>	                                    </li>	                                    <li><span class="fa fa-tag minmaxpriceicon"></span>	                                        <p name="store_pricerange">'+data[i]['low']+' - '+data[i]['high']+'</p>	                                    </li>	                                    <li><span class="ti-time"></span>	                                        <p name="store_opening">'+data[i]['time_low']+' - '+data[i]['time_high']+'</p>	                                    </li>	                                </ul>	                                <div class="bottom-icons">	                                    <div class="'+data[i]['class_time']+'">'+data[i]['status']+'</div>	                                    <span class="ti-heart"><span class="upvote display-number" name="no_upvotes">'+data[i]['likes']+'</span></span>	                                    <span class="ti-comments"><span class="comment display-number" name="no_comments">'+data[i]['comments']+'</span></span>	                                </div>	                            </div>	                        </a>	                    </div>	                </div>';
														cnt = cnt+1;
														//alert(cnt);
													}
												}
												large += '</div>';
												$("#row_of_review").append(large);
												//alert(data);
											}
											});		
							//btn know_btn
					});
				});
				</script>
			</div>
				<div class="featured_btn_wrap" style="width: 100%" >
					<button class="wtf view_more_button" id="<?php echo $button?>">XEM THÊM</button> <!-- load 3 each time -->
				</div>
				<p id="test"></p>
		</section>
		<!--//END FEATURED PLACES -->

		<!-- Footer -->
		<footer>
			<!-- Footer top -->
			<div class="container footer_top">
				<div class="row">
					<div class="col-lg-4 col-sm-7">
						<div class="footer_item">
							<h4>About Company</h4>
							<img class="logo" src="images/logo.png" style="width: 200px; height: 50px" />
							<p>Sản phẩm là quá trình sản sinh tri thức một cách khách quan và tự nguyện của một nhóm bạn trẻ SDL Đại Học Bách Khoa Hà Nội .Lấy ý tưởng từ phần mềm diệt virus BKAV , BKRV ra đời nhằm mục đích quảng bá món ăn Việt Nam đến với bạn bè Thế Giới .</p>

							<ul class="list-inline footer_social_icon">
								<li><a href=""><span class="fa fa-facebook"></span></a></li>
								<li><a href=""><span class="fa fa-twitter"></span></a></li>
								<li><a href=""><span class="fa fa-youtube"></span></a></li>
								<li><a href=""><span class="fa fa-google-plus"></span></a></li>
								<li><a href=""><span class="fa fa-linkedin"></span></a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-sm-5">
						<div class="footer_item">
							<h4>Sponsers</h4>
							<ul class="list-unstyled footer_menu">
								<li><a href="https://www.facebook.com/cafetrasuathayphuong/"><span class="fa fa-play"></span> Citea FUN</a>
								<li><a href="https://www.facebook.com/chienhedspi"><span class="fa fa-play"></span> TSCBSM Group</a>
								<li><a href="https://www.facebook.com/vingroup.net/"><span class="fa fa-play"></span> Vin Group</a>
								<li><a href="https://www.foody.vn/ha-noi"><span class="fa fa-play"></span> Foody.vn</a>
								<li><a href="https://lala.vn/"><span class="fa fa-play"></span> LALA</a>
								<li><a href="https://www.facebook.com/The.ThanosMadTitan"><span class="fa fa-play"></span> Thanos</a>
								<li><a href="https://www.facebook.com/vuduc153"><span class="fa fa-play"></span> Spider MAN</a>
								<li><a href="https://www.facebook.com/hedspi.nichibu/"><span class="fa fa-play"></span> Hedspi Nichibu</a>
								<li><a href="https://www.facebook.com/JAV-Company-233850186650513/"><span class="fa fa-play"></span> JAV Company</a>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-sm-7">
						<div class="footer_item">
							<h4>Don't read the lines below</h4>
							<ul class="list-unstyled post">
								<li><a href=""><span class="date">03 <small>MBR</small></span>  Project made by SDL Team<br/>with 3 members</a></li>
								<li><a href=""><span class="date">02 <small>WRK</small></span>  Number of people really doing this project</a></li>
								<li><a href=""><span class="date">01 <small>TER</small></span>  Takes 1 month of implementation</a></li>
								<li><a href=""><span class="date">10 <small>DIM</small></span><b>  Số điểm mà nhóm mong muốn có được</b></a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-sm-5">
						<div class="footer_item">
							<h4>Come with us</h4>
							<ul class="list-unstyled footer_contact">
								<li><a href=""><span class="fa fa-map-marker"></span> 17 Ta Quang Buu , HBC HN VN</a></li>
								<li><a href=""><span class="fa fa-envelope"></span> Email.Never.Read@gmail.com</a></li>
								<li><a href=""><span class="fa fa-mobile"></span><p>+84 24 66 711 211 <br />+84 69 96 069 069</p></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div><!-- Footer top end -->

			<!-- Footer bottom -->
			<div class="footer_bottom text-center">
				<p class="wow fadeInRight">
					Made with 
					<i class="fa fa-heart"></i>
					by 
					<a target="_blank" href="http://bootstrapthemes.co">Bootstrap Themes</a> 
					2016. All Rights Reserved
				</p>
			</div><!-- Footer bottom end -->
		</footer><!-- Footer end -->

		<!-- JavaScript -->
		<script src="js/jquery-1.12.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

		<!-- Bootsnav js -->
		<script src="js/bootsnav.js"></script>

		<!-- JS Implementing Plugins -->
		<script src="js/isotope.js"></script>
		<script src="js/isotope-active.js"></script>
		<script src="js/jquery.fancybox.js?v=2.1.5"></script>

		<script src="js/jquery.scrollUp.min.js"></script>

		<script src="js/main.js"></script>
	</body>	
</html>	

<!-- kanseishimashit -->