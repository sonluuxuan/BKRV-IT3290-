<?php
if(isset($_GET['error'])){
	$error = $_GET['error'];
}
?>
<!DOCTYPE html>
<script type="text/javascript">
	$(document).ready(function(){
	var error = "";
	error = "<?php echo "$error";?>";
	if(error != ""){
		alert(error);
	}
});
</script>
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
	<div class="register__container">
	<div class="container__child register__form">
		<form action="login2.php" method="post">
			<?php
				echo '<input type="hidden" name="location" value="';
				if(isset($_GET['location'])) {
				    echo htmlspecialchars($_GET['location']);
				}
				echo '" />';
			?>
			<div class="form-group" style="margin-top: 73px">
				<label for="username">Tên đăng nhập</label>
				<input class="form-control" type="text" name="username" id="username" placeholder="username" required />
			</div>
			<div class="form-group">
				<label for="password">Mật khẩu</label>
				<input class="form-control" type="password" name="password" id="password" placeholder="********" required />
			</div>
			<div class="m-t-lg">
				<ul class="list-inline">
					<li>
						<input class="btn btn--form" type="submit" name="submit" value="Đăng nhập" />
					</li>
					<li>
						<a class="register__link" href="register.php">Đăng ký</a>
					</li>
				</ul>
			</div>
		</form>  
	</div>
	<div class="container__child register__thumbnail">
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