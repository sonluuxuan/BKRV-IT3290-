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
<html lang="en" >

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,700,300'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>

			<link rel="stylesheet" href="css/login-register.css">

	
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
	<div class="signup__container">
	<div class="container__child signup__thumbnail">
	</div>
	<div class="container__child signup__form">
		<form action="http://localhost/webservice/project_csdl/signup.php" method="post">
			<div class="form-group">
				<label for="username">Tên đăng nhập</label>
				<input class="form-control" type="text" name="username" id="username" placeholder="username" required />
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input class="form-control" type="text" name="email" id="email" placeholder="user.name@gmail.com" required />
			</div>
			<div class="form-group">
				<label for="password">Mật khẩu</label>
				<input class="form-control" type="password" name="password" id="password" placeholder="********" required />
			</div>
			<div class="form-group">
				<label for="passwordRepeat">Xác nhận mật khẩu</label>
				<input class="form-control" type="password" name="passwordRepeat" id="passwordRepeat" placeholder="********" required />
			</div>
			<div class="m-t-lg">
				<ul class="list-inline">
					<li>
						<input class="btn btn--form" type="submit" name="submit" value="Đăng ký" />
					</li>
					<li>
						<a class="signup__link" href="login.php">Đã là thành viên?</a>
					</li>
				</ul>
			</div>
		</form>  
	</div>
</div>

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
