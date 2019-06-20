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
		<!-- jquery 3.3.1 -->
		<script src="js/jquery-3.3.1.min.js"></script>
		<!-- Simple line Icon -->
		<link rel="stylesheet" href="css/simple-line-icons.css">
		<!-- Themify Icon -->
		<link rel="stylesheet" href="css/themify-icons.css">
		<!-- Swipper Slider -->
		<link rel="stylesheet" href="css/swiper.min.css">
		<!-- Magnific Popup CSS -->
		<link rel="stylesheet" href="css/magnific-popup.css">
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
						<a class="navbar-brand" href="index.php"><img class="logo" src="images/logo.png" alt="" style="height: 50px; width: 200px"></a>
					</div>
					<!-- Navigation -->
					<div class="collapse navbar-collapse" id="navbar-menu">
						<ul class="nav navbar-nav menu">
							<!--<li><a href="">Trang chủ</a></li>					-->
							<!--session for login and logout-->		
							<?php
								if($flags == 0)
								{
									echo "<li><a href='index.php'>Trang chủ</a></li>";
									echo "<li><a href='login.php?location=".urlencode($_SERVER['REQUEST_URI'])."'>Đăng Nhập</a></li>";
									//copy above line to listing.php
									echo "<li><a href='register.php?location=".urlencode($_SERVER['REQUEST_URI'])."'>Đăng Ký</a></li>";
								}   
								if($flags == 1)
								{
									echo "<li><a href='index.php'>Trang chủ</a></li>";
									echo "<li><a href=''>".$usernamePhp."</a></li>";
								}
							?>
							<?php
							if($flags == 1){
								echo "<li><a href='logout.php?location=".urlencode($_SERVER['REQUEST_URI'])."'>Logout</a></li>"; //this line too
							}
							?>	
						</ul>
					</div>
				</div>   
			</nav><!-- Navbar end -->
		</header><!-- Header end -->

		<!-- Swiper -->
		<?php
				include 'DB_functions.php';
				include 'function.php';
				$review_id = $_GET['review_id'];
				$result = get_img_dir($review_id);
				$review = $result[0];
				$result_loai = get_loai($review_id);
				$loai = $result_loai[0];
				$result_mon_gia = get_mon_gia($review_id);
				// $sub_result = check_sub()
		?>
		<!-- <div clas -->
		<div class="swiper-container">
			<div class="swiper-wrapper">
			<?php
				//$path = "./images/15";
				$path = "images/".$review["id"];
				$allImages= scandir($path);
				$count = count($allImages) + 1;
				if($count % 3 == 0) {
					foreach ($allImages as $image) { 
						if($image !== "." && $image !== "..") {
							$imageInf= pathinfo($path ."/".$image); 
							echo '<div class="swiper-slide">';
							echo '<a href='.$path."/".$image.' class="grid image-link">';
							echo '<img src='.$path."/".$image.' class="img-fluid" alt="#">';
							echo '</a>';
							echo '</div>';
						}
					}
				}
				else if($count % 3 == 1) {
					foreach ($allImages as $image) { 
						if($image !== "." && $image !== "..") {
							$imageInf= pathinfo($path ."/".$image); 
							echo '<div class="swiper-slide">';
							echo '<a href='.$path."/".$image.' class="grid image-link">';
							echo '<img src='.$path."/".$image.' class="img-fluid" alt="#">';
							echo '</a>';
							echo '</div>';
						}
					}
					echo '<div class="swiper-slide">';
					echo '<a href='.$path."/".$image.' class="grid image-link">';
					echo '<img src='.$path."/".$image.' class="img-fluid" alt="#">';
					echo '</a>';
					echo '</div>';
					
					echo '<div class="swiper-slide">';
					echo '<a href='.$path."/".$image.' class="grid image-link">';
					echo '<img src='.$path."/".$image.' class="img-fluid" alt="#">';
					echo '</a>';
					echo '</div>';
				}
				else if($count % 3 == 2) {
					foreach ($allImages as $image) { 
						if($image !== "." && $image !== "..") {
							$imageInf= pathinfo($path ."/".$image); 
							echo '<div class="swiper-slide">';
							echo '<a href='.$path."/".$image.' class="grid image-link">';
							echo '<img src='.$path."/".$image.' class="img-fluid" alt="#">';
							echo '</a>';
							echo '</div>';
						}
					}
					echo '<div class="swiper-slide">';
					echo '<a href='.$path."/".$image.' class="grid image-link">';
					echo '<img src='.$path."/".$image.' class="img-fluid" alt="#">';
					echo '</a>';
					echo '</div>';
				}
			?>
				<!--<div class="swiper-slide">
					<a href="temp/reserve-slide1.jpg" class="grid image-link">
						<img src="temp/reserve-slide1.jpg" class="img-fluid" alt="#">
					</a>
				</div>
				-->
			</div>
			<!-- Add Pagination -->
			<div class="swiper-pagination swiper-pagination-white"></div>
			<!-- Add Arrows -->
			<div class="swiper-button-next swiper-button-white"></div>
			<div class="swiper-button-prev swiper-button-white"></div>
		</div>

		<!--============================= RATE A REVIEW =============================-->
		<section class="store-block">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h5 name="store_name"><?php echo $review["ten"]; ?></h5>
						<p><span>$$$</span>$$</p> <!-- Based on price range -->
						<p class="store-description" style="display: block;">
							<span class="store-description-type" name="store_type"><?php echo $loai["loai"]; ?></span>
							<?php
								$like_dislike_arr = get_num_of_like_dislike($review_id);
							?>
							<span class="store-description" style="display: inline-block; color: #b2b8c3">
								<span name="no_upvotes" id="num_of_likes" style="color: #b2b8c3"><?php echo $like_dislike_arr["likes"]; ?></span> người thấy review này hữu ích 
								<span style="display: inline-block; color: #b2b8c3; margin: 0 10px 0">•</span>
								<span name="no_downvotes" id="num_of_dislikes" style="color: #b2b8c3"><b><?php echo $like_dislike_arr["dislikes"]; ?></b></span> người thấy review này không hữu ích
							</span>
						</p>
					</div>
					<div class="col-md-6">
						<div class="store-seat-block">
							<div class="store-rating">
								<span><?php echo get_rating($review_id)?></span>
							</div>
							<script>
								$(document).ready(function(){

									// like and unlike click
									$(".like, .dislike").click(function(){
										var id = this.id;   // Getting Button id
										var split_id = id.split("_");

										var text = split_id[0];
										var postid = split_id[1];  // postid
										//get username
										var userid = "<?php echo $useridPhp;?>";
										// Finding click type
										var type = 0;
										if(text == "like"){
											type = 1;
										}else{
											type = 0;
										}

										// AJAX Request
										$.ajax({
											url: 'likeunlike.php',
											type: 'post',
											data: {postid:postid,type:type,userid:userid},
											dataType: 'json',
											success: function(data){
												var likes = data['likes'];
												var unlikes = data['dislikes']; 
												$("#num_of_likes").text(likes);        // setting likes
												$("#num_of_dislikes").text(unlikes);    // setting unlikes

												// style button when like or dislike here
												/*if(type == 1){
													$("#like_"+postid).css("color","#ffa449");
													$("#unlike_"+postid).css("color","lightseagreen");
												}

												if(type == 0){
													$("#unlike_"+postid).css("color","#ffa449");
													$("#like_"+postid).css("color","lightseagreen");
												}*/


											}
											
										});

									});

								});
							</script>
							<!--session for like dislike button-->
							<?php
							if ($flags == 1){ // loged in able to like and dislike
								echo'<div class="upvote-btn">';
								echo '<div class="featured-btn-wrap">';
									echo '<button class="btn know_btn like" id="like_'.$review_id.'" name="upvote" style="font-size: 14px">UPVOTE</button>';
								echo '</div>';
								echo '</div>';
								echo '<div class="downvote-btn">';
									echo '<button class="btn btn-outline-danger dislike" id="dislike_'.$review_id.'" name="downvote" style="font-size: 14px">DOWNVOTE</button>';
								echo '</div>';
							}else{ //not loged in like dislike button navigate to login site
								echo'<div class="upvote-btn">';
								echo '<div class="featured-btn-wrap">';
									echo '<button class="btn know_btn like disabled" id="like_'.$review_id.'" name="upvote" style="font-size: 14px; background: #A0A0A0;">UPVOTE</button>';
								echo '</div>';
								echo '</div>';
								echo '<div class="downvote-btn">';
									echo '<button class="btn btn-outline-danger dislike disabled" id="dislike_'.$review_id.'" name="downvote" style="font-size: 14px; background: #A0A0A0;">DOWNVOTE</button>';
								echo '</div>';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--//END RATE A REVIEW -->
		
		<!--============================= REVIEW DETAILS =============================-->
		<section class="light-bg review-details_wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-8 responsive-wrap">
						<div class="review-checkbox_wrap">
							<div class="review-checkbox" name="review_detail">
								<p><?php echo nl2br($review["review"]);?></p>
								<hr>
							</div>
							<div class="row">
							<?php
							foreach($result_mon_gia as $mon_gia){
								
								echo '<div class="col-md-4">';
									echo '<label class="custom-checkbox">';
										echo '<span class="ti-check-box"></span>';
										echo '<span class="custom-control-description" name="store_menu">'.$mon_gia["ten_mon"].'</span>';
									echo '</label>';
									echo '<br>';
									echo '<label class="custom-checkbox">';
									   echo '<span class="fa fa-tag minmaxpriceicon"></span>';
										echo '<span class="custom-control-description" name="store_menu_price">'.$mon_gia["gia"].'</span>';
									echo '</label>';
								echo '</div>';
							}
							?>
								<!--<div class="col-md-4">
									<label class="custom-checkbox">
										<span class="ti-check-box"></span>
										<span class="custom-control-description" name="store_menu">Buffethải sản </span>
									</label> 
									<br>
									<label class="custom-checkbox">
										<span class="fa fa-tag minmaxpriceicon"></span>
										<span class="custom-control-description" name="store_menu_price">159.000đ</span>
									</label>
								</div>
								<div class="col-md-4">
									<label class="custom-checkbox">
									   <span class="ti-check-box"></span>
									   <span class="custom-control-description" name="store_menu">Buffet thịt bò</span>
									</label>
									<label class="custom-checkbox">
									  <span class="fa fa-tag minmaxpriceicon"></span>
									  <span class="custom-control-description" name="store_menu_price">159.000đ</span>
									</label>
								</div>-->
							</div>
						</div>
						<!-- Write comment section -->
						<div class="review-checkbox_wrap mt-4" style="margin-top: 1.5rem!important; padding-bottom: 50px;">
							<h5>Viết nhận xét</h5>
							<?php
								if($flags == 1){
							?>
							<hr>
							<!-- Actual Comments --> <!-- TODO: -->
							<div class="customer-review_wrap">
								<div class="customer-img">
									<img src="<?php echo get_profile_pic("profile_pics/user".$useridPhp)?>" class="img-fluid" alt="#" name="user_avatar"> <!-- current user's profile pic -->
									<p name="user_comment"><?php echo $usernamePhp;?></p> <!-- current user's username -->
								</div>
								<div class="customer-content-wrap">
									<div class="customer-content">
										<div class="customer-review" style="width: 100%">
											<input type="text" name="store_name" id="title" required/>
										</div>
									</div>
									<textarea id="actual_comment" style="width: 100%; height: 200px; padding: 16px; margin-top: 20px"></textarea>
								</div>
							</div>
							<button id="<?php echo $useridPhp.'_'.$review_id;?>" class="comment-submit">Gửi</button> <!-- submit -->
							
							<hr>
							<?php
								}else{
							?>
							<!--html code for button to login here-->
							<div class="customer-review_wrap">
							<a class="notice_review" href='login.php?location=<?php echo urlencode($_SERVER['REQUEST_URI']);?>'>Đăng nhập để viết review</a></li>
							</div>
							<?php
								}
							?>
						</div>
						<!-- Ajax for writing comment -->
						<script>
							$(document).ready(function() {
								$(".comment-submit").click(postComment);

							});

							function postComment(){
								//$("#old_comment").html("posting comment ...");  
								var id = this.id;
								var splited = id.split("_");
								var user_id = splited[0];
								var review_id_comment = splited[1];
								var comment = $("#actual_comment").val();
								var title = $("#title").val();
								var username = "<?php echo $usernamePhp;?>";
								var large = '';
								$.ajax({
									url: 'receive_comment.php',
											type: 'post',
											data: {user_id: user_id, review_id_comment:review_id_comment, comment:comment, title: title},
											dataType: 'json',
											success: function(data){
												
												var profile_picture = data['profile_picture'];
												large += '<div class="customer-review_wrap">		<div class="customer-img">			<img src="'+data['profile_picture']+'" class="img-fluid" alt="#" name="user_avatar">			<p name="user_comment">'+username+'</p>		</div>		<div class="customer-content-wrap">			<div class="customer-content">				<div class="customer-review">					<h6 name="comment_title">'+data['title']+'</h6>				</div>			</div>			<p class="customer-text" name="comment_detail">'+data['comment']+'</p>		</div>	</div> <hr>';
												$("#comments_box").prepend(large);
												
												}
									
								});
										
											
									}/*,
									error : function() {
										alert("Error reaching the server. Check your connection");
									}*/
								
									
						</script>
						<!--end write comment -->
						<!-- Comment section -->
						<div id="comments_box_title" class="review-checkbox_wrap mt-4" style="margin-top: 1.5rem!important;">
						<?php
								$result_num_comment = get_number_of_comments($review_id);
								if(empty($result_num_comment)) {
									$cnt["cnt"] = 0; 
								}
								else 
									$cnt = $result_num_comment[0]; 
							?>
							<h5 name="no_comments"><?php echo $cnt["cnt"]." nhận xét";?></h5>
							<hr>
						</div>
						<div  id="comments_box" class="review-checkbox_wrap mt-4">
							<?php
								if($cnt["cnt"] != 0)
									// echo '<hr>';
							?>
							<!-- Actual Comments -->
							<?php
							$result_comment_user = get_comment_user($review_id);
							$num = count($result_comment_user);
							$count = 0;
							// foreach ($result_comment_user as $user_comment) {
							for($i=0; $i<$num && $i<3; $i++){
							echo '<div class="customer-review_wrap">';
								echo '<div class="customer-img">';
									$result_user_commented = getUserById($result_comment_user[$i]["user_id"]);
									$user_commented = $result_user_commented[0];
								
									echo '<img src="'.get_profile_pic('profile_pics/user'.$result_comment_user[$i]["user_id"]).'"class="img-fluid" alt="#" name="user_avatar">';
									echo '<p name="user_comment">'.$user_commented["username"].'</p>';
								echo '</div>';
								echo '<div class="customer-content-wrap">';
									echo '<div class="customer-content">';
										echo '<div class="customer-review">';
											echo '<h6 name="comment_title">'.$result_comment_user[$i]["summary"].'</h6>';
										echo '</div>';
									echo '</div>';
									echo '<p class="customer-text" name="comment_detail">'.$result_comment_user[$i]["comment"].'</p>';
								echo '</div>';
							echo '</div>';
							if($count < $num-1) {
								echo '<hr>';
							}
							$count++;
							}
							?>
							<button id="taithem" class="comment-submit">TAI THEM</button> <!-- submit -->
						</div>
						<script>
							$(document).ready(function(){
								$('#taithem').click(function(){
									var review_id = '<?php echo $review_id;?>';
									var cnt = '<?php echo $count;?>';
									alert(cnt);
									$.ajax({
										url:'load_comments.php',
										type:'post',
										data:{review_id:review_id, cnt:cnt},
										dataType:'json',
										success: function(data){
											alert("success");
											alert(data["cntmore"]);
											alert(data[2]['comment']);
										}
 
									});
								});
							});
						</script>
						
					</div>
					<div class="col-md-4 responsive-wrap">
						<div class="contact-info">
							<div class="address">
								<span class="icon-location-pin"></span>
								<p name="store_address"> <?php echo $review["dia_chi"];?></p>
							</div>
							<div class="address">
								<?php
									$result_price_range = get_price_range($review_id);
									$low = $result_price_range[0]["gia"];
									$high = $result_price_range[1]["gia"];
									//if($low === $high)
								?>
								<span class="fa fa-tag minmaxpriceicon"></span>
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
							</div>
							<div class="address">
								<?php
									$result_time_range = get_time_range($review_id);
									$time_low = $result_time_range[0]["time_open"];
									$time_high = $result_time_range[0]["time_close"];
									//if($low === $high)
								?>
								<span class="ti-time"></span>
								<p style="margin-bottom: 16px" name="store_opening"><?php echo $time_low." - ".$time_high?><br>
								<?php
									date_default_timezone_set("Asia/Ho_Chi_Minh");
									$time = date("H:i:s");
									if (strtotime($time) >= strtotime($time_low) && strtotime($time) <= strtotime($time_high)){
										echo '<span class="open-now" style="margin-top: 10px">OPEN NOW</span></p> <!-- Based on opening time -->';
									}
									else{
										echo '<span class="closed-now" style="margin-top: 10px">CLOSE NOW</span></p> <!-- Based on opening time -->';
									}
									?>
							</div>
						</div>
						<div class="follow">
							<div class="follow-img">
								<?php
									$result_profile = get_user($review_id);
									$user = $result_profile[0];
									// echo $user['id'], $useridPhp;
									$sub_status = check_sub($user['id'], $useridPhp);
								?>
								<img src="<?php echo get_profile_pic('profile_pics/user'.$user["id"]);?>" class="img-fluid" alt="#" name="writer-avatar">
								<h6 name="writer-name"><?php echo $user["username"];?></h6>
								<?php
								if($sub_status == 0 && $flags == 1){
									echo'<button class="sub_but" id="sub_button" style="margin-top:10px; background-color: #46cd38; border-radius: 10px; border: none; color:white; height: 40px; width: 120px; /*opacity: 0.5; cursor: not-allowed;*/" type="button">SUBSCRIBE</button>';
								}
								else if($sub_status > 0 && $flags == 1){
									echo '<button class="sub_but" id="sub_button" style="margin-top:10px; /*background-color: #46cd38;*/ border-radius: 10px; border: none; color:grey; height: 40px; width: 120px; opacity: 0.5; /*cursor: not-allowed;*/" type="button" disabled>SUBSCRIBED</button>';
								}
								else{
									echo '<button class="sub_but" id="sub_button" style="margin-top:10px; background-color: #46cd38; border-radius: 10px; border: none; color:white; height: 40px; width: 120px; opacity: 0.5; /*cursor: not-allowed;*/" type="button" disabled title="login to subscribe">SUBSCRIBE</button>';
								}
								?>
							</div>
							<ul class="social-counts">
								<li>
									<h6 name="writer_no_reviews"><?php echo get_number_of_post_by_user($user["id"]);?></h6>
									<span>Reviews</span>
								</li>
								<li>
									<h6 id="writer_subscribers" name="writer_no_subscriber"><?php echo get_number_of_subscribers($user["id"]);?></h6>
									<span>Subscribers</span>
								</li>
								<li>
									<h6 id="writer_likes" name="writer_no_upvotes"><?php echo get_number_of_like_of_user($user["id"]);?></h6>
									<span>Upvotes</span>
								</li>
								<li>
									<h6 id="writer_dislikes" name="writer_no_downvotes"><?php echo get_number_of_dislike_of_user($user["id"]);?></h6>
									<span>Downvotes</span>
								</li>
							</ul>
						</div>
						<script type="text/javascript">
							$(document).ready(function(){
								$('#sub_button').click(function(){
									var posterId = "<?php echo $user["id"];?>";
									var subscriberId = "<?php echo $useridPhp;?>";
									alert(posterId);
									alert(subscriberId);
									$.ajax({
										url:'subscribe.php',
										type:'post',
										data:{posterId:posterId, subscriberId:subscriberId},
										dataType:'json',
										success: function(data){
											alert(data["result"]);

										}

									});
								});
							});
						</script>
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
		<script src="js/jquery-1.12.1.min.js"></script>
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
		<!-- Swipper Slider JS -->
		<script src="js/swiper.min.js"></script>
		<script>
			var swiper = new Swiper('.swiper-container', {
				slidesPerView: 3,
				slidesPerGroup: 3,
				loop: true,
				loopFillGroupWithBlank: true,
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
			});
		</script>
		<script>
			if ($('.image-link').length) {
				$('.image-link').magnificPopup({
					type: 'image',
					gallery: {
						enabled: true
					}
				});
			}
			if ($('.image-link2').length) {
				$('.image-link2').magnificPopup({
					type: 'image',
					gallery: {
						enabled: true
					}
				});
			}
		</script>
	</body>	
</html>	