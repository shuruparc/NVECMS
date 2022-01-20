<?php
include 'conn.php';
session_start(); //Starting of session on loging
if(isset($_REQUEST['username'])){
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $stmt = $conn->prepare('SELECT id, username, password, role FROM users WHERE username=? AND password=?');
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $stmt->bind_result($id, $username, $password, $role);
    $stmt->store_result();
if($stmt->num_rows == 1)  //To check if the row exists
        {
			if($stmt->fetch()) //fetching the contents of the row
            {
               if ($role == 0) {
                   echo "YOUR account has been DEACTIVATED.";
                   exit();
				} else {
					$_SESSION['Logged'] = 1;
					$_SESSION['id'] = $id;
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
					$_SESSION['role'] = $role;
					if($_SESSION['role']==1 || $_SESSION['role']==3)
					{
					$redirectUrl=ADMIN_URL.'dashboard.php';
					echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
					}
					if($_SESSION['role']==2)
					{
					$redirectUrl=ADMIN_URL.'my_lesson.php';
					echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
					}
					exit();
				}
			}
	 }
	 else {
        echo $err= "INVALID USERNAME/PASSWORD Combination!";
    }
    $stmt->close();
}

$conn->close();


/*if(isset($_REQUEST['username']))
{
$sql='SELECT * FROM `users` WHERE `username`="'.$_REQUEST['username'].'" and `password`="'.$_REQUEST['password'].'"'; //Checking user with database
$result=$conn->query($sql) ;
$count=$result->num_rows;
$row = $result->fetch_assoc();
if($count>0)
{
// Storing User Data From Loging Form, session information
$_SESSION['username']=$_REQUEST['username'];
$_SESSION['password']=$_REQUEST['password'];
$_SESSION['role']=$row['role'];
$_SESSION['id']=$row['id'];
//header("location:".ADMIN_URL."dashboard.php");
//Redirecting User To DashBoard Or Other Page As per Login 
if($_SESSION['role']==1 || $_SESSION['role']==3)
{
$redirectUrl=ADMIN_URL.'dashboard.php';
echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
}
if($_SESSION['role']==2)
{
$redirectUrl=ADMIN_URL.'my_lesson.php';
echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
}
}
else {
$err="Incorrect User Name / Password";	
}
}*/
?> 

<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>NVE | Login Form</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="NVE" name="description"/>
<meta name="keywords" content="NVE, Teaching, Resources">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="../../assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="../../assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="../../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<meta name="theme-color" content="#ffffff">
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class="logo">
	
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
<br>
<center>
	<a href="http://localhost:8888/NVECMS/">
	<img src="../../assets/admin/layout3/img/nve-logo-sm.png" alt="NVE logo"/>
	</a>
</center>
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="" method="post">
		<h3 class="form-title">Log In</h3>
		<div class="alert alert-reception display-hide" id="alert_msg">
			<button class="close" data-close="alert"></button>
			<span>
			Incorrect Username / Password </span>
		</div>
		<div class="form-group">
			
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
            <input class="form-control form-control-solid placeholder-no-fix" type="hidden" autocomplete="off" placeholder="error" name="err" id="err" value="<?php if(isset($err)){ echo $err;} ?>"/>
		</div>
		<div class="form-actions">
			<center> <button type="submit" class="btn btn-success uppercase">Login</button></center>
			
		</div>
		
		
	</form>
	<!-- END LOGIN FORM -->
	<!-- BEGIN FORGOT PASSWORD FORM -->
	<form class="forget-form" action="<?php echo ADMIN_URL; ?>" method="post">
		<h3>Forgotten Password?</h3>
		<p>
			 Enter your e-mail address below to reset your password.
		</p>
		<div class="form-group">
			<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email"/>
		</div>
		<div class="form-actions">
			<button type="button" id="back-btn" class="btn btn-default">Back</button>
			<button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
		</div>
	</form>
	<!-- END FORGOT PASSWORD FORM -->
	
</div>
<div class="copyright">
	 © All content Copy Right reserved 2021 to <a href="http://localhost:8888/NVECMS/" title="NVE" target="_blank">NVECMS</a> 
</div>
<!-- END LOGIN -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->

<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="../../assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/login.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	Login.init();
	Demo.init();
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){    
	var err = $("#err").val();
	if(err!='')
	{
		$("#alert_msg").removeClass("display-hide");
	}
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

