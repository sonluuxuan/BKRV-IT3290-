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
						<a class="navbar-brand" href=""><img class="logo" src="temp/map.png" alt=""></a>
					</div>
					<!-- Navigation -->
					<div class="collapse navbar-collapse" id="navbar-menu">
						<ul class="nav navbar-nav menu">
							<li><a href="index_test2.php">Trang chủ</a></li>                    
							<li><a href="login.html">Đăng nhập</a></li>
							<li><a href="register.html">Đăng ký</a></li>
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
		?>
        <div clas
        <div class="swiper-container">
            <div class="swiper-wrapper">
            <?php
            	//$path = "./images/15";
            	$path = $review["anh"];
				$allImages= scandir($path);
				foreach ($allImages as $image) { 
					if($image !== "." && $image !== ".."){
				        $imageInf= pathinfo($path ."/".$image); 
				        echo '<div class="swiper-slide">';
				        echo '<a href='.$path."/".$image.' class="grid image-link">';
				        echo '<img src='.$path."/".$image.' class="img-fluid" alt="#">';
				        echo '</a>';
				        echo '</div>';
		    	}
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
								    	//alert('clicked');
								        var id = this.id;   // Getting Button id
								        var split_id = id.split("_");

								        var text = split_id[0];
								        var postid = split_id[1];  // postid

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
								            data: {postid:postid,type:type},
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
	                        <div class="upvote-btn">
	                            <div class="featured-btn-wrap">
	                                <button class="btn know_btn like" id="like_<?php echo $review_id; ?>" name="upvote" style="font-size: 14px">UPVOTE</button>
	                            </div>
	                        </div>
	                        <div class="downvote-btn">
	                            <button class="btn btn-outline-danger dislike" id="dislike_<?php echo $review_id; ?>" name="downvote" style="font-size: 14px">DOWNVOTE</button>
	                        </div>
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
	                            <p><?php echo $review["review"];?></p>
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
	                    <!-- Comment section -->
	                    <div class="review-checkbox_wrap mt-4" style="margin-top: 1.5rem!important;">
	                    	<?php
	                    		$result_num_comment = get_number_of_comments($review_id);
	                    		$cnt = $result_num_comment[0];
	                    	?>
	                        <h5 name="no_comments"><?php echo $cnt["cnt"]." nhận xét";?></h5>
	                        <hr>
	                        <!-- Actual Comments -->
	                        <?php
	                        $result_comment_user = get_comment_user(17);
	                        $num = count($result_num_comment);
	                        $count = 0;
							foreach ($result_comment_user as $user_comment) {
	                        echo '<div class="customer-review_wrap">';
	                            echo '<div class="customer-img">';
									$result_user_commented = getUserById($user_comment["user_id"]);
									$user_commented = $result_user_commented[0];
		                    	
	                                echo '<img src="'.get_profile_pic($user_commented["profile_picture"]).'"class="img-fluid" alt="#" name="user_avatar">';
	                                echo '<p name="user_comment">'.$user_commented["username"].'</p>';
	                            echo '</div>';
	                            echo '<div class="customer-content-wrap">';
	                                echo '<div class="customer-content">';
	                                    echo '<div class="customer-review">';
	                                        echo '<h6 name="comment_title">'.$user_comment["summary"].'</h6>';
	                                    echo '</div>';
	                                echo '</div>';
	                                echo '<p class="customer-text" name="comment_detail">'.$user_comment["comment"].'</p>';
	                            echo '</div>';
	                        echo '</div>';
	                        if($count < $num) {
	                        echo '<hr>';
	                    	}
	                    	$count++;
	                    	}
	                        ?>
	                        <hr>
	                        <!--<div class="customer-review_wrap">
	                            <div class="customer-img">
	                                <img src="temp/customer-img2.jpg" class="img-fluid" alt="#" name="user_avatar">
	                                <p name="user_comment">Kevin W</p>
	                            </div>
	                            <div class="customer-content-wrap">
	                                <div class="customer-content">
	                                    <div class="customer-review">
	                                        <h6 name="comment_title">A hole-in-the-wall old school shop.</h6>
	                                    </div>
	                                </div>
	                                <p class="customer-text" name="comment_detail">The beef noodle soup was okay.</p>
	                            </div>
	                        </div>-->
	                    </div>
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
		                            		echo $low."-".$high;
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
	                            <p style="margin-bottom: 16px" name="store_opening"><?php echo $time_low."-".$time_high?><br>
	                                <span class="open-now" style="margin-top: 10px">OPEN NOW</span></p> <!-- Based on opening time -->
	                        </div>
	                    </div>
	                    <div class="follow">
	                        <div class="follow-img">
	                        	<?php
	                        		$result_profile = get_user($review_id);
									$user = $result_profile[0];
	                        	?>
	                            <img src="<?php echo get_profile_pic($user["profile_picture"]);?>" class="img-fluid" alt="#" name="writer-avatar">
	                            <h6 name="writer-name"><?php echo $user["username"];?></h6>
	                        </div>
	                        <ul class="social-counts">
	                            <li>
	                                <h6 name="writer_no_reviews"><?php echo $user["num_of_post"];?></h6>
	                                <span>Reviews</span>
	                            </li>
	                            <li>
	                                <h6 name="writer_no_upvotes"><?php echo $user["num_of_likes"];?></h6>
	                                <span>Upvotes</span>
	                            </li>
	                            <li>
	                                <h6 name="writer_no_downvotes"><?php echo $user["num_of_dislikes"];?></h6>
	                                <span>Downvotes</span>
	                            </li>
	                        </ul>
	                    </div>
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
							<img class="logo" src="temp/map.png" alt="Construction" />
							<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem</p>

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
							<h4>Explore link</h4>
							<ul class="list-unstyled footer_menu">
								<li><a href=""><span class="fa fa-play"></span> Our services</a>
								<li><a href=""><span class="fa fa-play"></span> Meet our team</a>
								<li><a href=""><span class="fa fa-play"></span> Forum</a>
								<li><a href=""><span class="fa fa-play"></span> Help center</a>
								<li><a href=""><span class="fa fa-play"></span> Contact Cekas</a>
								<li><a href=""><span class="fa fa-play"></span> Privacy Policy</a>
								<li><a href=""><span class="fa fa-play"></span> Cekas terms</a>
								<li><a href=""><span class="fa fa-play"></span> Site map</a>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-sm-7">
						<div class="footer_item">
							<h4>Latest post</h4>
							<ul class="list-unstyled post">
								<li><a href=""><span class="date">20 <small>AUG</small></span>  Luptatum omittantur duo ne mpetus indoctum</a></li>
								<li><a href=""><span class="date">20 <small>AUG</small></span>  Luptatum omittantur duo ne mpetus indoctum</a></li>
								<li><a href=""><span class="date">20 <small>AUG</small></span>  Luptatum omittantur duo ne mpetus indoctum</a></li>
								<li><a href=""><span class="date">20 <small>AUG</small></span>  Luptatum omittantur duo ne mpetus indoctum</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-sm-5">
						<div class="footer_item">
							<h4>Contact us</h4>
							<ul class="list-unstyled footer_contact">
								<li><a href=""><span class="fa fa-map-marker"></span> 124 New Line, London UK</a></li>
								<li><a href=""><span class="fa fa-envelope"></span> hello@psdfreebies.com</a></li>
								<li><a href=""><span class="fa fa-mobile"></span><p>+44 00 00 1234 <br />+44 00 00 1234</p></a></li>
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