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
			}
	}
	if($flags == 0){
		header('Location: index.php');
	}
?>
<?php
if(isset($_GET['error'])){
	$error = $_GET['error'];
}
?>
<script type="text/javascript">
	var error = "";
	error = "<?php echo "$error";?>";
	if(error != ""){
		if(error == "passwordnotmatched")
			alert("Mật khẩu và xác nhận mật khẩu không khớp!");
		else if(error == "userexisted")
			alert("Tên đăng nhập đã tồn tại!\nVui lòng chọn tên đăng nhập khác!");
		else if(error == "EmailExisted")
			alert("Địa chỉ email đã tồn tại!\nVui lòng chọn địa chỉ khác!");
	}
</script>
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
		<link rel="stylesheet" href="css/post.css"/>
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
									echo "<li><a href='logout.php'>Logout</a></li>";
									echo "<a href='profile2.php'><img href='profile2.php' src=".$userProfilePic." style='height: 50px; width:auto; margin-top:15px; border-radius:50%'></a>";
								}
							?>
						</ul>
					</div>
				</div>   
			</nav><!-- Navbar end -->
		</header><!-- Header end -->

		<!--============================= DESCRIPTION =============================-->
		
		<!--============================= REVIEW DETAILS =============================-->
		<script type="text/javascript">
			function submitForm (){
				// alert(total_file);
				// match anything not a [ or ]
				regexp = /^[^[\]]+/;
				var fileInput = $('.putImages input[type="file"]');
				var fileInputName = regexp.exec( fileInput.attr('name') );
				alert(fileInputName);
				// make files available
				var data = new FormData();
				jQuery.each($(fileInput)[0].files, function(i, file) {
				    data.append(fileInputName+'['+i+']', file);
				});
				var userid = "<?php echo $useridPhp;?>";
				// data.append(userid);
				// alert(fileInputName[1]);
				// HERE
			    $.ajax({
			        url:'upload_profile_pic.php',
			        type:'post',
			        method: 'POST',
			        contentType: false,
    				processData: false,
    				cache:false,
    				enctype: 'multipart/form-data',
			        data: data,
			        success:function(response){
			        	console.log(response);
			            alert("Upload thành công! ajax");
			            var parsed = JSON.parse(response);
			            alert(parsed["message"]);
			            //window.location.href="index.php"; // TODO: swap index.php with index file 
			            // window.location.href="index.php";
			        }
			    });
			}
		</script>
		<section class="light-bg review-details_wrap">
			<div class="container">
				<div class="review-checkbox_wrap" style="height: auto;">
					<div ng-app="mealApp" ng-controller="mealController">
						<div class="review-checkbox" name="detailed_info" style="margin-top: 50px">
							<span class="ti-check-box"></span>
							<h6 style="display: inline-block;">Personal Informations</h6>
							<hr>
						</div>
						
						<div class="info-content">
								<div class="info-input">
									<div class="item-label">Username:</div>
									<div class="item-detail">
										<input type="text" style="opacity: 0.7" id="Username" value="<?php echo $usernamePhp;?>">
									</div>
								</div>
								<div class="info-input">
									<div class="item-label">Email:</div>
									<div class="item-detail">
										<input type="text" style="opacity: 0.7" id="Email" value="<?php echo $userEmail?>">
									</div>
								</div>
						</div>
						<div class="info-content">
							<div class="info-input">
								<div class="item-label" style="width: 100%">Description:</div>
								<textarea id="Description" style="opacity: 0.7; width: 70%; height: 200px; padding: 16px"><?php echo $userDescription;?></textarea>
							</div>
						</div>
						<div class="review-checkbox" name="basic_info" >
							<!-- <span class="ti-check-box"></span>
							<h6 style="display: inline-block;" onclick="changePass();">Change password:</h6>
							<hr> -->
							<button onclick="changePass();">Change password:</button>
							<hr>
						</div>
						<div class="info-content" style="display: none" id="changePass">
							<div class="info-input">
									<div class="item-label">New password:</div>
									<div class="item-detail">
										<input type="text" name="store_name" id="NewPassword" required/>
									</div>
							</div>
							<div class="info-input">
								<div class="item-label">Confirm password:</div>
								<div class="item-detail">
										<input type="text" name="store_location" id="ConfirmPassword" required/>
								</div>
							</div>								
						</div>
						<script type="text/javascript">
							function changePass() {
							  var x = document.getElementById("changePass");
							  if (x.style.display === "none") {
							    x.style.display = "block";
							  } else {
							    x.style.display = "none";
							  }
							}
						</script>
						<script>
							var Mapp = angular.module('mealApp', []);
							Mapp.controller('mealController', function($scope, $http){
								$scope._submit = function() {
									$scope.sel = {};
								 	$scope.Username = document.getElementById("Username").value;
								 	$scope.Email = document.getElementById("Email").value;
								 	$scope.NewPassword = document.getElementById("NewPassword").value;
								 	$scope.ConfirmPassword = document.getElementById("ConfirmPassword").value;
								 	$scope.Description = document.getElementById("Description").value;
								 	// $scope.storeOpnMin = document.getElementById("opening_time-minute").value;
								 	// $scope.storeClsHour = document.getElementById("closing_time-hour").value;
								 	// $scope.storeClsMin = document.getElementById("closing_time-minute").value;
								 	// $scope.storeRating = document.getElementById("ratingId").value;
								 	// $scope.storeReview = document.getElementById("reviewId").value;

								 	$scope.sel['Username'] = $scope.Username;
									$scope.sel['Email'] = $scope.Email;
									$scope.sel['NewPassword'] = $scope.NewPassword;
									$scope.sel['ConfirmPassword'] = $scope.ConfirmPassword;
									$scope.sel['Description'] = $scope.Description;
									$scope.sel['OldDescription'] = "<?php echo $userDescription;?>";
									$scope.sel['OldUsername'] = "<?php echo $usernamePhp;?>";
									$scope.sel['OldEmail'] = "<?php echo $userEmail;?>";
									$scope.sel['UserId'] = "<?php echo $useridPhp;?>";
									console.log("message=" + $.param($scope.sel));
									// working //
									$http({
									    method: 'POST',
									    url: 'post_profile.php', // TODO: path to php file // test file works fine 
									    data: $.param($scope.sel),
									    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
									})
									.then(function(response) {
								        console.log(response);
								        if(response["data"].error == 1){
									        alert(response["data"].message);
									        // alert(response["data"].userid);
									    }
									    else{
									        if(document.getElementById("upload_profile_pic").files.length > 0){
										        submitForm();
										    }
										    else{
										    	alert("Upload thành công!");
										    	alert(response["data"].results);
										    	alert($scope.Username);
										    	// $_SESSION['username'] = response["data"].newusername;
									            // window.location.href="index.php";
										    }
										}
								    });
								};
							});
						</script>
						<div class="info-content">
							<div class="info-input">
								<div class="item-label" style="width: 100%">Upload Profile Picture:</div>
								<div id="wrapper" style="margin-top: 30px">
								<!-- <form id="uploadForm" action="upload_file.php" method="post" enctype="multipart/form-data" class="putImages"> -->
									<form id="uploadForm" action="upload_profile_pic.php" method="post" class="putImages">
									<input type="file" id="upload_profile_pic" name="upload_profile_pic[]" onchange="preview_image();" style="display: inline-block; font-size: 12px" />
									<div id="image_preview"></div>
								</form>
								</div>
							</div>
						</div>
						<button type="button" class="btn submit_btn" ng-click="_submit()">Submit</button>
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
		 var total_file=document.getElementById("upload_profile_pic").files.length;
		 // alert(total_file);
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