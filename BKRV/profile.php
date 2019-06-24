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
									echo "<li><a href=''>".$usernamePhp."</a></li>";
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
						<h5 style="margin-bottom: 4px;">YOURS</h5>
						<!-- <p class="store-description" style="display: block;">
							<span class="store-description-type">Chia sẻ địa điểm của bạn với cộng đồng ngay!</span>
						</p> -->
				</div>
			</div>
		</section>
		<!--//END DESCRIPTION -->
		
		<!--============================= REVIEW DETAILS =============================-->
		<!-- Liked review -->
		<?php
				$result = get_latest_review();
				$result2 = get_popular_reviews();
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
				if($flags == 1){
					if(count($result0) > 0){
						?>
						<section id="new">
							<div class="container">
								<div class="button__header">
									<h2 class="styled-heading">LIKED REVIEW</h2>
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
		</section><!-- liked review end -->
						
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