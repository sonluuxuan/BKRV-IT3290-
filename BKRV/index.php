<?php
	include 'DB_functions.php';
	include 'function.php';

	session_start();
	$flags = 0;
	$usernamePhp = "none";
	$useridPhp = -10;
	if(isset($_SESSION["logged_in"]))
	{
		$flags = $_SESSION["logged_in"];
		if($flags == 1)
			{
				$usernamePhp = $_SESSION['username'];
				$useridPhp = $_SESSION['userid'];
				$userProfilePic = get_profile_pic("profile_pics/".$useridPhp);
			}
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
		<link rel="stylesheet" href="css/custom.css" />
		<!-- AngularJS -->
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
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
						<a class="navbar-brand" href=""><img class="logo" src="images/logo.png" alt="" style="height: 50px; width: 200px"></a>
					</div>
					<!-- Navigation -->
					<div class="collapse navbar-collapse" id="navbar-menu">
						<ul class="nav navbar-nav menu">
							<li><a href="">Trang chủ</a></li>					
							<!--session for login and logout-->		
							<?php
								if($flags == 0)
								{
									echo "<li><a href='login.php'>Đăng Nhập</a></li>";
									echo "<li><a href='register.php'>Đăng Ký</a></li>";
								}   
								if($flags == 1)
								{
									echo "<li><a href='logout.php?location=".urldecode($_SERVER['REQUEST_URI'])."'>Logout</a></li>";
								}
							?>
							<li><a href="#new">Mới</a></li>
							<li><a href="#popular">Phổ biến</a></li>
							<?php
								if($flags == 1)
								{
									// echo "<li><a href='profile2.php'>".$usernamePhp."</a></li>";
									echo "<a href='profile2.php'><img href='profile2.php' src=".$userProfilePic." style='height: 50px; width:auto; margin-top:15px; border-radius:50%'></a>";
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
						<img src="images/food.jpg">
						<div class="overlay" ng-app="myApp" ng-controller="myCtrl" ng-init="show='false'">
						<!-- session for form -->
						<?php
							echo '<form action="listing.php" method="post">'
							/*if($flags == 0)
							{
								echo '<form action="listing.php" method="post">';
							}   
							if($flags == 1)
							{
								echo '<form action="listing.php?username='.$usernamePhp.'" method="post">';
							}*/
						?>
							<!--<form action="listing.php" method="post">-->
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
											Name: "0 - 10000"
											}, {
											Name: "10000 - 50000"
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
									    	window.location.href=('listing.php?button=filter' + '&' + $.param($scope.sel));
									    	<?php
												/*if($flags == 0)
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
												}*/
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
							<div class="carousel-caption">
								<h3>Hedspi Food Review</h3>
								<h1>Đánh giá đồ ăn</h1>
								<h1 class="second_heading">Creative & Professional</h1>
								<!-- session for viet review -->
								<?php 
									if($flags == 1)
									{
										echo "<a href='post.php' class='btn know_btn'>Viết review</a>";
									}
									if ($flags == 0) {
										echo "<a href='login.php' class='btn know_btn'>Viết review</a>";
									}
								?>
							</div>					
						</div>
					</div>        
				</div><!-- Carousel-inner end -->
			</div><!-- Carousel end-->
		</section>

		<!-- New review -->
		<?php
				$result = get_latest_review();
				$result2 = get_popular_reviews();
				if($flags == 1){
					$result0 = get_subscribe_review($useridPhp);
				}
				if(!empty($result2[0]))
					$popular_review1 = $result2[0];
				if(!empty($result2[1]))
					$popular_review2 = $result2[1];
				if(!empty($result2[2]))
					$popular_review3 = $result2[2];
				if(!empty($result[0]))
					$review1 = $result[0];
				if(!empty($result[1]))
					$review2 = $result[1];
				if(!empty($result[2]))
					$review3 = $result[2];
				if(!empty($result0[0]))
					$sub_review1 = $result0[0];
				if(!empty($result0[1]))
					$sub_review2 = $result0[1];
				if(!empty($result0[2]))
					$sub_review3 = $result0[2];
				if($flags == 1){
					if(count($result0) > 0){
						?>
						<section id="new">
							<div class="container">
								<div class="button__header">
									<h2 class="styled-heading">SUBSCRIBE REVIEW</h2>
									<?php
										echo "<a class='btn-view__more' href='listing.php?button=subscribe'>Xem tất cả</a>";
									?>
								</div>
								<div class="row">
									<?php
									if(count($result0) < 3)
										$ele = count($result0);
									else $ele = 3;
									for ($i = 0; $i < $ele; $i++) {
									?>
									<div class="col-md-4">
										<div class="service_item">
											<img src="<?php echo get_thumbnail("images/".$result0[$i]["id"]);?>"/>
											<h3> <?php echo $result0[$i]["ten"]?> </h3>
											<h4 style="font-style:italic; font-size: 15px; color:grey;"> <?php echo getUserById($result0[$i]["user_id"])[0]["username"]?> </h4>
											<p> <?php echo nl2br($result0[$i]["review"]). "<br>";?> </p>
											<!--session for xem them button in-->
											<?php
												echo '<a href="detail.php?review_id='.$result0[$i]["id"].'" class="btn know_btn">xem thêm</a>';
											?>
										</div>
									</div>
									<?php
									} 
									?>
								</div>
							</div>
						</section><!-- Sub review end -->
						<?php
					}
				}
				if(count($result) > 0){
		?>
		<section id="new">
			<div class="container">
				<div class="button__header">
					<h2 class="styled-heading">REVIEW GẦN ĐÂY</h2>
					<?php
						echo "<a class='btn-view__more' href='listing.php?button=latest'>Xem tất cả</a>";
					?>
				</div>
				<div class="row">
					<?php
					if(count($result) <= 3)
						$ele = count($result);
					else $ele = 3;
					for ($i = 0; $i < $ele; $i++) {
					?>
					<div class="col-md-4">
						<div class="service_item">
							<img src="<?php echo get_thumbnail("images/".$result[$i]["id"]);?>"/>
							<h3> <?php echo $result[$i]["ten"]?> </h3>
							<h4 style="font-style:italic; font-size: 15px; color:grey;"> <?php echo getUserById($result0[$i]["user_id"])[0]["username"]?> </h4>
							<p> <?php echo nl2br($result[$i]["review"]). "<br>";?> </p>
							<!--session for xem them button in-->
							<?php
								echo '<a href="detail.php?review_id='.$result[$i]["id"].'" class="btn know_btn">xem thêm</a>';
							?>
						</div>
					</div>
					<?php
					} 
					?>
				</div>
			</div>
		</section><!-- New review end -->
		<?php
		}
		if(count($result2) > 0){
		?>
		<!-- Popular review -->
		<section id="popular">
			<div class="container">
				<div class="button__header">
					<h2 class="styled-heading">REVIEW PHỔ BIẾN</h2>
					<?php
						echo "<a class='btn-view__more' href='listing.php?button=popular'>Xem tất cả</a>";
							/*if($flags == 0)
							{
								echo "<a class='btn-view__more' href='listing.php?button=popular'>Xem tất cả</a>";
							}   
							if($flags == 1)
							{
								echo "<a class='btn-view__more' href='listing.php?button=popular&username=".$usernamePhp."'>Xem tất cả</a>";
							}*/
					?>
					<!--<a class="btn-view__more" href="listing.html">Xem tất cả</a>-->
				</div>
				<div class="row">
					<?php
					if(count($result2) <= 3)
						$ele = count($result2);
					else $ele = 3;
					for ($i = 0; $i < $ele; $i++) {
					?>
					<div class="col-md-4">
						<div class="service_item">
							<img src="<?php echo get_thumbnail("images/".$result2[$i]["id"]);?>"/>
							<h3> <?php echo $result2[$i]["ten"]?> </h3>
							<h4 style="font-style:italic; font-size: 15px; color:grey;"> <?php echo getUserById($result0[$i]["user_id"])[0]["username"]?> </h4>
							<p> <?php echo nl2br($result2[$i]["review"]). "<br>";?> </p>
							<!--session for xem them button in-->
							<?php
								echo '<a href="detail.php?review_id='.$result2[$i]["id"].'" class="btn know_btn">xem thêm</a>';
								/*if($flags == 0)
								{
									echo '<a href="detail.php?review_id='.$result2[$i]["id"].'" class="btn know_btn">xem thêm</a>';
								}   
								if($flags == 1)
								{
									echo '<a href="detail.php?review_id='.$result2[$i]["id"].'&username='.$usernamePhp.'" class="btn know_btn">xem thêm</a>';
								}*/
							?>
							<!--<a href="detail.php?review_id=<?php// echo$review1["id"]?>" class="btn know_btn">xem thêm</a>-->
						</div>
					</div>
					<?php
					} 
					?>
				</div>
			</div>
		</section><!-- Popular review end -->
		<?php
		}
		?>
		<!-- start blog Area -->		
		<section id="quick">
			<div class="container">
				<h2 class="styled-heading">TÌM KIẾM NHANH</h2>
				<div class="row">
					<div class="col-md-3">
						<div class="service_item">
						<!--session for an vat-via he-->
						<?php
							echo '<a href="listing.php?button=an_vat_via_he">';
							/*if($flags == 0)
							{
								echo '<a href="listing.php?button=an_vat_via_he">';
							}   
							if($flags == 1)
							{
								echo '<a href="listing.php?button=an_vat_via_he&username='.$usernamePhp.'">';
							}*/
						?>
							<!--<a href="listing.html">-->
								<div class ="container">
									<img class="img-fluid image" src="images/anvat.jpg"/>
									<div class="overlay">
										<div class="text">Ăn vặt / Vỉa hè</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="service_item">
						<!--session for cafe-dessert-->
						<?php
							echo '<a href="listing.php?button=cafe_dessert">';
							/*if($flags == 0)
							{
								echo '<a href="listing.php?button=cafe_dessert">';
							}   
							if($flags == 1)
							{
								echo '<a href="listing.php?button=cafe_dessert&username='.$usernamePhp.'">';
							}*/
						?>
							<!--<a href="listing.html">-->
								<div class ="container2">
									<img class="img-fluid image2" src="images/cake.jpg"/>
									<div class="overlay2">
										<div class="text">Café / Dessert</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="service_item">
							<!--session for cafe-dessert-->
						<?php
							echo '<a href="listing.php?button=bar_pub">';
							/*if($flags == 0)
							{
								echo '<a href="listing.php?button=bar_pub">';
							}   
							if($flags == 1)
							{
								echo '<a href="listing.php?button=bar_pub&username='.$usernamePhp.'">';
							}*/
						?>
								<div class ="container3">
									<img class="img-fluid image3" src="images/pub.jpg"/>
									<div class="overlay3">
										<div class="text">Bar / Pub</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="service_item">
							<!--session for cafe-dessert-->
						<?php
							echo '<a href="listing.php?button=nhahang">';
							/*if($flags == 0)
							{
								echo '<a href="listing.php?button=nhahang">';
							}   
							if($flags == 1)
							{
								echo '<a href="listing.php?button=nhahang&username='.$usernamePhp.'">';
							}*/
						?>
								<div class ="container4">
									<img class="img-fluid image4" src="images/restaurant.jpg"/>
									<div class="overlay4">
										<div class="text">Nhà hàng</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- end blog Area -->	

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