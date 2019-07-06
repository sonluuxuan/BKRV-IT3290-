<?php
	include 'DB_functions.php';
	include 'function.php';
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
				$userProfilePic = get_profile_pic("profile_pics/".$useridPhp);
				$userDescription = get_user_description($useridPhp);
				$userEmail = get_user_email($useridPhp);
				$posterId = $_GET['userid'];
				$poster = getUserById($posterId);
				$posternamePhp = $poster[0]['username'];
				$posterProfilePic = get_profile_pic("profile_pics/".$posterId);
				$posterDescription = get_user_description($posterId);
				$posterEmail = get_user_email($posterId);
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
		<!-- AngularJS -->
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
		<!-- Simple line Icon -->
		<link rel="stylesheet" href="css/simple-line-icons.css">
		<!-- Themify Icon -->
		<link rel="stylesheet" href="css/themify-icons.css">
		<!-- Magnific Popup CSS -->
		<link rel="stylesheet" href="css/magnific-popup.css">
		<script src="js/jquery-1.12.1.min.js"></script>
		<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
		<script src="https://ajax.aspnetcdn.com/ajax/mvc/5.2.3/jquery.validate.unobtrusive.min.js"></script>
		<script src="http://malsup.github.com/jquery.form.js"></script> 
		<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<!------ Include the above in your HEAD tag ---------->
		<!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet"> -->
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
									// echo "<li><a href=''>".$usernamePhp."</a></li>";
									echo "<li><a href='logout.php'>Logout</a></li>";
									echo "<a href='profile2.php'><img href='profile2.php' src=".$userProfilePic." style='height: 50px; width:auto; margin-top:15px; border-radius:50%'></a>";
								}
							?>
						</ul>
					</div>
				</div>   
			</nav><!-- Navbar end -->
		</header><!-- Header end -->

		

		<!--============================= DESCRIPTIONS =============================-->

		<div class="container" style="width:100%; margin:0; padding:5;">
		    <div class="span3 well" style="width:100%">
		        <center>
		        <a href="#aboutModal" data-toggle="modal" data-target="#myModal"><img src="<?php echo $posterProfilePic;?>" name="aboutme" style = "width:140px; height:140px;" class="img-circle"></a>
		        <h3 style="margin-bottom: 10px; margin-top: 10px;"><?php echo $posternamePhp;?></h3>
		        <br>
		        <div>
                    <span class="label label-success spanlabel2"><?php echo get_number_of_like_of_user($posterId);?> Likes</span>
                    <span style="background-color:red" class="label label-info spanlabel2"><?php echo get_number_of_dislike_of_user($posterId);?> Dislikes</span>
                    <span class="label label-warning spanlabel2"><?php echo get_number_of_post_by_user($posterId);?> Posts</span>
                    <span class="label label-info spanlabel2"><?php echo get_number_of_subscribers($posterId);?> Subscribers</span>
                    <style>
                    	.spanlabel2{
                    		text-align : center;
                    		font-size: 20px;
						  	padding : 0.5em;
						  	/*width  : 20em;*/
						  	/*height : 6em;
						  	/*border-radius: 100%;*/
                    	}
                    </style>
		        <br>
		        <br>
		        </div>
		        <em>click picuture for more</em>
				</center>
		    </div>
		    <!-- Modal -->
		    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
		        <div class="modal-dialog">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		                    <h4 class="modal-title" id="myModalLabel">More About <?php echo $posternamePhp;?></h4>
		                    </div>
		                <div class="modal-body">
		                    <center>
		                    <img src="<?php echo $posterProfilePic;?>" name="aboutme" border="0" class="img-circle" style = "width:140px; height:140px;"></a>
		                    <h3 class="media-heading"><?php echo $posternamePhp;?></h3>
		                    <span><strong>Infos: </strong></span>
		                        <span class="label label-success spanlabel"><?php echo get_number_of_like_of_user($posterId);?> Likes</span>
		                        <span style="background-color:red" class="label label-info spanlabel"><?php echo get_number_of_dislike_of_user($posterId);?> Dislikes</span>
		                        <span class="label label-warning spanlabel"><?php echo get_number_of_post_by_user($posterId);?> Posts</span>
		                        <span class="label label-info spanlabel"><?php echo get_number_of_subscribers($posterId);?> Subscribers</span>
		                        <style>
		                        	.spanlabel{
		                        		height:50px;
		                        		padding : 0.3em;
		                        		font-size: 17px;
		                        	}
		                        </style>
		                    </center>
		                    <hr>
		                    <center>
		                    <p class="text-left"><strong>Email: </strong>
		                        <?php echo $posterEmail;?></p>
		                    <p class="text-left"><strong>Bio: </strong><br>
		                        <?php echo $posterDescription;?></p>
		                    <br>
		                    </center>
		                </div>
		                <div class="modal-footer">
		                    <center>
		                    <button type="button" class="btn btn-default" data-dismiss="modal">Minimize</button>
		                    </center>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<!--//END DESCRIPTION -->
		
		<!--============================= REVIEW DETAILS =============================-->
		<div id="reviews" class="tabcontent">
			<?php
				$result3 = get_posted_review($posterId);
			?>
			<!-- POSTED REVIEWS BEGIN -->
			<section class="main-block">
				<div class="container" id="row_of_review">
					<div class="row justify-content-center">
						<div class="col-md-5">
							<div class="styled-heading">
								<h3>POSTED</h3>
							</div>
						</div>
					</div>
					<div class="row" > <!-- LIKED REIVEWS -->
			<?php
					$cnt = 0;
					if(!empty($result3)) {
						$cnt_result = count($result3);
					}
					// print($cnt)
					else $cnt_result = 0;
					// echo($cnt);
					//echo var_dump($result);
					while($cnt < 3 && $cnt < $cnt_result){ // 3 reviews per row
						if($result3[$cnt]["rating"] < 5){
							$class_rating = "featured-rating";
						}else if($result3[$cnt]["rating"] >= 5 && $result3[$cnt]["rating"] < 8){
							$class_rating = "featured-rating-orange";
						}else if($result3[$cnt]["rating"] >= 8){
							$class_rating = "featured-rating-green";
						}
					?>
						<div class="col-md-4 featured-responsive">
							<div class="featured-place-wrap">
								<a href="detail.php?review_id=<?php echo $result[$cnt]["id"]; ?>">

								<!--session for detail.php not in ajax-->
								<?php
									echo '<a href="detail.php?review_id='.$result3[$cnt]["id"].'">';
								?>
									<img src="<?php echo get_thumbnail("images/".$result3[$cnt]["id"]);?>" class="img-fluid" alt="#">
									<span class="<?php echo $class_rating?>"><?php echo $result3[$cnt]["rating"];?></span>
									<div class="featured-title-box">
										<h6 name="store_name"><?php echo $result3[$cnt]["ten"];?></h6>
										<?php $result_loai = get_loai($result3[$cnt]["id"]);?>
										<p name="store_type"><?php echo $result_loai[0]["loai"];?></p>
										<!--<p><span>$$$</span>$$</p>--> <!-- Based on price range -->
										<ul>
											<li><span class="ti-location-pin"></span>
												<p name="store_address"><?php echo $result3[$cnt]["dia_chi"];?></p>
											</li>
											<li><span class="fa fa-tag minmaxpriceicon"></span>
											<?php
												$result_price_range = get_price_range($result3[$cnt]["id"]);
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
												$result_time_range = get_time_range($result3[$cnt]["id"]);
												$time_low = $result_time_range[0]["time_open"];
												$time_high = $result_time_range[0]["time_close"];
												//if($low === $high)
											?>
												<p name="store_opening"><?php echo $time_low." - ".$time_high?></p>
											</li>
										</ul>
										<h4 style="font-style:italic; font-size: 15px; color:grey;"> <?php echo getUserById($result3[$cnt]["user_id"])[0]["username"]?> </h4>
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
												$like_dislike_arr = get_num_of_like_dislike($result3[$cnt]["id"]);
											?>
											<span class="ti-heart"><span class="upvote display-number" name="store_point"><?php echo $like_dislike_arr["likes"];?></span></span> 
											<!-- Number of upvotes - number of downvotes -->
											<?php
												$result_num_comment = get_number_of_comments($result3[$cnt]["id"]);
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
					</div> 				
				</div>
			<div class="featured_btn_wrap" style="width: 100%" >
						<a class="wtf view_more_button" style="position:relative; left:5%;" href="listing.php?button=posterpost&posterid=<?php echo $posterId;?>" id="<?php echo $button?>">XEM THÊM</a> 
					</div>
			</section>
			<hr>
		</div>
		<!-- POSTED REVIEWS END -->
		<!--=================================== END REVIEW DETAILS ==================================-->



		<!--=================================== PERSONAL INFORMATION ================================-->
		
		<!--=================================== END PERSONAL INFORMATION ============================-->


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
		document.getElementById("defaultOpenTab").click();
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