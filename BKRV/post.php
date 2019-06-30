<?php
	session_start();
	$flags = 0;
	$usernamePhp = "none";
	if(isset($_SESSION["logged_in"]))
	{
		$flags = $_SESSION["logged_in"];
		if($flags == 1)
			{
				$usernamePhp = $_SESSION['username'];
				$useridPhp = $_SESSION['userid'];
			}
	}
	if($flags == 0){
		header('Location: index.php');
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
		<link rel="stylesheet" href="css/post.css"/>
		<!-- AngularJS -->
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
		<!-- Simple line Icon -->
		<link rel="stylesheet" href="css/simple-line-icons.css">
		<!-- Themify Icon -->
		<link rel="stylesheet" href="css/themify-icons.css">
		<!-- Swipper Slider -->
		<link rel="stylesheet" href="css/swiper.min.css">
		<!-- Magnific Popup CSS -->
		<link rel="stylesheet" href="css/magnific-popup.css">
		<script src="js/jquery-1.12.1.min.js"></script>
		<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
		<script src="https://ajax.aspnetcdn.com/ajax/mvc/5.2.3/jquery.validate.unobtrusive.min.js"></script>
		<script src="http://malsup.github.com/jquery.form.js"></script> 
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
								if($flags == 1)
								{
									echo "<li><a href='index.php'>Trang chủ</a></li>";
									echo "<li><a href='profile2.php'>".$usernamePhp."</a></li>";
								}
							?>
							<?php
							if($flags == 1){
								echo "<li><a href='logout.php'>Logout</a></li>";
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
						<div class="overlay">
						</div>
					</div>        
				</div><!-- Carousel-inner end -->
			</div><!-- Carousel end-->
		</section>

		<!--============================= DESCRIPTION =============================-->
		<section class="store-block">
			<div class="container">
				<div class="row">
						<h5 style="margin-bottom: 4px">Thêm review mới</h5>
						<p class="store-description" style="display: block;">
							<span class="store-description-type">Chia sẻ địa điểm của bạn với cộng đồng ngay!</span>
						</p>
				</div>
			</div>
		</section>
		<!--//END DESCRIPTION -->
		
		<!--============================= REVIEW DETAILS =============================-->
		<script type="text/javascript">
			function submitForm (){
				// match anything not a [ or ]
				regexp = /^[^[\]]+/;
				var fileInput = $('.putImages input[type="file"]');
				var fileInputName = regexp.exec( fileInput.attr('name') );

				// make files available
				var data = new FormData();
				jQuery.each($(fileInput)[0].files, function(i, file) {
				    data.append(fileInputName+'['+i+']', file);
				});
				// HERE
			    $.ajax({
			        url:'upload_file.php',
			        type:'post',
			        method: 'POST',
			        contentType: false,
    				processData: false,
    				cache:false,
    				enctype: 'multipart/form-data',
			        data: data,
			        success:function(){
			            alert("Upload thành công!");
			            //window.location.href="index.php"; // TODO: swap index.php with index file 
			            window.location.href="index.php";
			        }
			    });
			}
		</script>
		<section class="light-bg review-details_wrap">
			<div class="container">
				<div class="review-checkbox_wrap" style="height: auto;">
					<div ng-app="mealApp" ng-controller="mealController">
						<div class="review-checkbox" name="basic_info" >
							<span class="ti-check-box"></span>
							<h6 style="display: inline-block;">Thông tin cơ bản</h6>
							<hr>
						</div>
						<div class="info-content">
							<div class="info-input">
									<div class="item-label">Tên địa điểm:</div>
									<div class="item-detail">
										<input type="text" name="store_name" id="storeNameId" required/>
									</div>
							</div>
							<div class="info-input">
								<div class="item-label">Địa chỉ:</div>
								<div class="item-detail">
										<input type="text" name="store_location" id="storeLocationId" required/>
								</div>
							</div>
							<div class="info-input">
									<div class="item-label">Loại hình:</div>
									<div class="item-detail">
										<select name="category" id="typeId"/>
											<option value="Ăn vặt - Vỉa hè">Ăn vặt / Vỉa hè</option>
											<option value="Cafe - Dessert">Café / Dessert</option>
											<option value="Bar - Pub">Bar / Pub</option>
											<option value="Nhà hàng">Nhà hàng</option>
										</select>
									</div>
							</div>
							<div class="info-input">
								<div class="item-label">Khu vực:</div>
								<div class="item-detail">
									<select name="area" id="areaId"/>
											<option value="Quận Đống Đa">Quận Đống Đa</option>
											<option value="Quận Hoàn Kiếm">Quận Hoàn Kiếm</option>
											<option value="Quận Ba Đình">Quận Ba Đình</option>
											<option value="Quận Tây Hồ">Quận Tây Hồ</option>
											<option value="Quận Thanh Xuân">Quận Thanh Xuân</option>
											<option value="Quận Hai Bà Trưng">Quận Hai Bà Trưng</option>
											<option value="Quận Cầu Giấy">Quận Cầu Giấy</option>
											<option value="Quận Hoàng Mai">Quận Hoàng Mai</option>
											<option value="Quận Long Biên">Quận Long Biên</option>
											<option value="Quận Hà Đông">Quận Hà Đông</option>
											<option value="Quận Nam Từ Liêm">Quận Nam Từ Liêm</option>
											<option value="Quận Bắc Từ Liêm">Quận Bắc Từ Liêm</option>
									</select>
								</div>
							</div>
							<div class="info-input">
									<div class="item-label">Giờ mở cửa:</div>
									<div class="item-detail">
										<select id="opening_time-hour" name="hour_open"><option value="00">00</option>
											<option value="01">01</option>
											<option value="02">02</option>
											<option value="03">03</option>
											<option value="04">04</option>
											<option value="05">05</option>
											<option value="06">06</option>
											<option value="07">07</option>
											<option value="08">08</option>
											<option value="09">09</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
											<option value="13">13</option>
											<option value="14">14</option>
											<option value="15">15</option>
											<option value="16">16</option>
											<option value="17">17</option>
											<option value="18">18</option>
											<option value="19">19</option>
											<option value="20">20</option>
											<option value="21">21</option>
											<option value="22">22</option>
											<option value="23">23</option>
										</select>
										<select id="opening_time-minute" name="minute_open" style="margin-left: 10px"><option value="00">00</option>
											<option value="01">01</option>
											<option value="02">02</option>
											<option value="03">03</option>
											<option value="04">04</option>
											<option value="05">05</option>
											<option value="06">06</option>
											<option value="07">07</option>
											<option value="08">08</option>
											<option value="09">09</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
											<option value="13">13</option>
											<option value="14">14</option>
											<option value="15">15</option>
											<option value="16">16</option>
											<option value="17">17</option>
											<option value="18">18</option>
											<option value="19">19</option>
											<option value="20">20</option>
											<option value="21">21</option>
											<option value="22">22</option>
											<option value="23">23</option>
											<option value="24">24</option>
											<option value="25">25</option>
											<option value="26">26</option>
											<option value="27">27</option>
											<option value="28">28</option>
											<option value="29">29</option>
											<option value="30">30</option>
											<option value="31">31</option>
											<option value="32">32</option>
											<option value="33">33</option>
											<option value="34">34</option>
											<option value="35">35</option>
											<option value="36">36</option>
											<option value="37">37</option>
											<option value="38">38</option>
											<option value="39">39</option>
											<option value="40">40</option>
											<option value="41">41</option>
											<option value="42">42</option>
											<option value="43">43</option>
											<option value="44">44</option>
											<option value="45">45</option>
											<option value="46">46</option>
											<option value="47">47</option>
											<option value="48">48</option>
											<option value="49">49</option>
											<option value="50">50</option>
											<option value="51">51</option>
											<option value="52">52</option>
											<option value="53">53</option>
											<option value="54">54</option>
											<option value="55">55</option>
											<option value="56">56</option>
											<option value="57">57</option>
											<option value="58">58</option>
											<option value="59">59</option>
										</select>
									</div>
							</div>
							<div class="info-input">
									<div class="item-label">Giờ đóng cửa:</div>
									<div class="item-detail">
										<select id="closing_time-hour" name="hour_close"><option value="00">00</option>
											<option value="01">01</option>
											<option value="02">02</option>
											<option value="03">03</option>
											<option value="04">04</option>
											<option value="05">05</option>
											<option value="06">06</option>
											<option value="07">07</option>
											<option value="08">08</option>
											<option value="09">09</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
											<option value="13">13</option>
											<option value="14">14</option>
											<option value="15">15</option>
											<option value="16">16</option>
											<option value="17">17</option>
											<option value="18">18</option>
											<option value="19">19</option>
											<option value="20">20</option>
											<option value="21">21</option>
											<option value="22">22</option>
											<option value="23">23</option>
										</select>
										<select id="closing_time-minute" name="minute_close" style="margin-left: 10px"><option value="00">00</option>
											<option value="01">01</option>
											<option value="02">02</option>
											<option value="03">03</option>
											<option value="04">04</option>
											<option value="05">05</option>
											<option value="06">06</option>
											<option value="07">07</option>
											<option value="08">08</option>
											<option value="09">09</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
											<option value="13">13</option>
											<option value="14">14</option>
											<option value="15">15</option>
											<option value="16">16</option>
											<option value="17">17</option>
											<option value="18">18</option>
											<option value="19">19</option>
											<option value="20">20</option>
											<option value="21">21</option>
											<option value="22">22</option>
											<option value="23">23</option>
											<option value="24">24</option>
											<option value="25">25</option>
											<option value="26">26</option>
											<option value="27">27</option>
											<option value="28">28</option>
											<option value="29">29</option>
											<option value="30">30</option>
											<option value="31">31</option>
											<option value="32">32</option>
											<option value="33">33</option>
											<option value="34">34</option>
											<option value="35">35</option>
											<option value="36">36</option>
											<option value="37">37</option>
											<option value="38">38</option>
											<option value="39">39</option>
											<option value="40">40</option>
											<option value="41">41</option>
											<option value="42">42</option>
											<option value="43">43</option>
											<option value="44">44</option>
											<option value="45">45</option>
											<option value="46">46</option>
											<option value="47">47</option>
											<option value="48">48</option>
											<option value="49">49</option>
											<option value="50">50</option>
											<option value="51">51</option>
											<option value="52">52</option>
											<option value="53">53</option>
											<option value="54">54</option>
											<option value="55">55</option>
											<option value="56">56</option>
											<option value="57">57</option>
											<option value="58">58</option>
											<option value="59">59</option>
										</select>
									</div>
							</div>						
						</div>

						<div class="review-checkbox" name="detailed_info" style="margin-top: 50px">
							<span class="ti-check-box"></span>
							<h6 style="display: inline-block;">Thông tin chi tiết</h6>
							<hr>
						</div>
						<script>
							var Mapp = angular.module('mealApp', []);
							Mapp.controller('mealController', function($scope, $http) {
								$scope.Meals = [{
									Id: 1,
									Name: "",
									Price: ""
									}];
								$scope.id = 2;
								$scope.addElement = function() {
									$scope.Meals.push({
										Id: $scope.id,
										Name: "",
										Price: ""
									});
									$scope.id = $scope.id + 1;

								};
								$scope._submit = function() {
									$scope.sel = {};
									$scope.selMealName = [];
									$scope.selMealPrice = [];
									$scope.noMeals = $scope.id - 1;
									angular.forEach($scope.Meals, function(meal) {
									    $scope.selMealName.push(meal.Name);
									    $scope.selMealPrice.push(meal.Price);
								 	});
								 	$scope.storeName = document.getElementById("storeNameId").value;
								 	$scope.storeLocation = document.getElementById("storeLocationId").value;
								 	$scope.storeType = document.getElementById("typeId").value;
								 	$scope.storeArea = document.getElementById("areaId").value;
								 	$scope.storeOpnHour = document.getElementById("opening_time-hour").value;
								 	$scope.storeOpnMin = document.getElementById("opening_time-minute").value;
								 	$scope.storeClsHour = document.getElementById("closing_time-hour").value;
								 	$scope.storeClsMin = document.getElementById("closing_time-minute").value;
								 	$scope.storeRating = document.getElementById("ratingId").value;
								 	$scope.storeReview = document.getElementById("reviewId").value;

								 	$scope.sel['storeName'] = $scope.storeName;
									$scope.sel['storeLocation'] = $scope.storeLocation;
									$scope.sel['storeType'] = $scope.storeType;
									$scope.sel['storeArea'] = $scope.storeArea;
									$scope.sel['storeOpnHour'] = $scope.storeOpnHour;
									$scope.sel['storeOpnMin'] = $scope.storeOpnMin;
									$scope.sel['storeClsHour'] = $scope.storeClsHour;
									$scope.sel['storeClsMin'] = $scope.storeClsMin;
									$scope.sel['storeRating'] = $scope.storeRating;
									$scope.sel['mealName'] = $scope.selMealName;
									$scope.sel['mealPrice'] = $scope.selMealPrice;
									$scope.sel['storeReview'] = $scope.storeReview;
									$scope.sel['username'] = "<?php echo $usernamePhp;?>";
									console.log("message=" + $.param($scope.sel));
									// working //
									$http({
									    method: 'POST',
									    url: 'testpost.php', // TODO: path to php file // test file works fine 
									    data: $.param($scope.sel),
									    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
									})
									.then(function(response) {
								        console.log(response);
								        submitForm();
								    });
								};
							});
						</script>
						<div class="info-content">
							<div ng-repeat="meal in Meals">
								<div class="info-input">
									<div class="item-label">Tên món ăn:</div>
									<div class="item-detail">
										<input type="text" ng-model="meal.Name" />
									</div>
								</div>
								<div class="info-input">
									<div class="item-label">Mức giá:</div>
									<div class="item-detail">
										<input type="text" ng-model="meal.Price"/>
									</div>
								</div>
							</div>
							<div class="add-meal-btn" style="margin-bottom: 10px">
								<button type="button" ng-click="addElement()">+</button>
							</div>
						</div>
						<div class="info-content">
							<div class="info-input">
								<div class="item-label" style="width: 100%">Review chi tiết:</div>
								<textarea id="reviewId" style="width: 100%; height: 400px; padding: 16px"></textarea>
							</div>
							<div class="info-input">
									<div class="item-label">Rating:</div>
									<div class="item-detail">
										<select name="store_rating" id="ratingId"/>
											<option value="00">0</option>
											<option value="01">1</option>
											<option value="02">2</option>
											<option value="03">3</option>
											<option value="04">4</option>
											<option value="05">5</option>
											<option value="06">6</option>
											<option value="07">7</option>
											<option value="08">8</option>
											<option value="09">9</option>
											<option value="10">10</option>
										</select>
									</div>
							</div>
						</div>
						<div class="info-content">
							<div class="info-input">
								<div class="item-label" style="width: 100%">Upload ảnh:</div>
								<div id="wrapper" style="margin-top: 30px">
								<form id="uploadForm" action="upload_file.php" method="post" enctype="multipart/form-data" class="putImages">
									<input type="file" id="upload_file" name="upload_file[]" onchange="preview_image();" style="display: inline-block; font-size: 12px" multiple />
									<div id="image_preview"></div>
								</form>
								</div>
							</div>
						</div>
						<button type="button" class="btn submit_btn" ng-click="_submit()">Đăng bài</button>
					</div>
				</div>
			</div>
		</section>
		<!--//END REVIEW DETAILS -->

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
		<script>
		$(document).ready(function() 
		{ 
		 $('#uploadForm').ajaxForm(function() 
		 {
		  alert("Uploaded SuccessFully");
		 }); 
		});

		function preview_image() 
		{
		 var total_file=document.getElementById("upload_file").files.length;
		 for(var i=0;i<total_file;i++)
		 {
		  $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
		 }
		}
		</script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/popper.min.js"></script>

		<!-- Bootsnav js -->
		<script src="js/bootsnav.js"></script>

		<!-- JS Implementing Plugins -->
		<script src="js/isotope.js"></script>
		<script src="js/isotope-active.js"></script>
		<script src="js/jquery.fancybox.js?v=2.1.5"></script>

		<script src="js/jquery.scrollUp.min.js"></script>

		<script src="js/main.js"></script>
		<!-- Magnific popup JS -->
		<script src="js/jquery.magnific-popup.js"></script>
	</body>	
</html>	

<!-- kanseishimashita -->