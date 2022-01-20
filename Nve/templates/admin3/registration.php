<?php
include 'conn.php';
if(isset($_REQUEST['submit']))
{		
	$sql = "INSERT INTO `users`(`fname`, `lname`, `password`,`role`,`school`,`username`) VALUES(?,?,?,?,?,?)"; 
	if($stmt = mysqli_prepare($conn, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "ssssss", $fname, $lname, $password,$role,$school,$username);
		$fname = $_REQUEST['fname'];
		$lname = $_REQUEST['lname'];
		$password = $_REQUEST['password'];
		$role = $_REQUEST['role'];
		$school = $_REQUEST['school'];
		$username = $_REQUEST['username'];
		if(mysqli_stmt_execute($stmt)){
        $msg ="New Record Created Successfully";
		header("location:dashboard.php?msg=".$msg);
	} else{
        $msg="Error:".$sql."<br>".$conn->error;
		$redirectUrl=ADMIN_URL.'registration.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
    }
} else{
	$msg="Error:".$sql."<br>".$conn->error;
	   $redirectUrl=ADMIN_URL.'registration.php?msg='.$msg.'&flg='.$flg;
	   echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
}
// Close statement
mysqli_stmt_close($stmt);
 
// Close connection
mysqli_close($conn);
		



// Inserting the user details in users table in database//
/*if(isset($_REQUEST['submit']))
{
		
		$fname=mysqli_real_escape_string($conn,$_REQUEST['fname']);
		$lname=mysqli_real_escape_string($conn,$_REQUEST['lname']);
		$password=(mysqli_real_escape_string($conn,$_REQUEST['password']));
		$role=mysqli_real_escape_string($conn,$_REQUEST['role']);
		$school=mysqli_real_escape_string($conn,$_REQUEST['school']);
		$username=mysqli_real_escape_string($conn,$_REQUEST['username']);
		$sql = "INSERT INTO `users`(`fname`, `lname`, `password`,`role`,`school`,`username`) VALUES('".$fname."','".$lname."','".$password."','".$role."','".$school."','".$username."')";
		
		if($conn->query($sql)===TRUE)
		{
			$msg ="New Record Created Successfully";
			header("location:dashboard.php?msg=".$msg);
		}
		else{
			$msg="Error:".$sql."<br>".$conn->error;
		}
}*/
}
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
<meta content="NVE  is a content management system designed for teachers to retrieve resources for their students." name="description"/>
<meta content="NVE" name="author"/>
<meta name="keywords" content="NVE, CMS, NVEcms, Teachers, Editors, Publishers ">
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
<br>
	<!-- BEGIN Registration FORM -->
	<form class="login-form" action="" method="post">

    <div class="alert alert-reception display-hide">
      <button class="close" data-close="alert"></button>
      <span> Enter any username and password. </span> </div>
    <div class="form-group"> 
      <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
      <label class="control-label visible-ie8 visible-ie9">First Name</label>
      <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="First Name" name="fname" id="fname"/>
    </div>
    <div class="form-group"> 
      <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
      <label class="control-label visible-ie8 visible-ie9">Last Name</label>
      <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Last Name" name="lname" id="lname"/>
    </div>
    <div class="form-group"> 
      <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
      
      <select class="form-control form-control-solid placeholder-no-fix" name="role" id="role">
      <option value="0">Select Role</option>
      <option value="2">Teacher</option>
     </select>
    </div>
    <div class="form-group"> 
      <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
      <label class="control-label visible-ie8 visible-ie9">School</label>
      <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="School" name="school" id="school"/>
    </div>
    <div class="form-group"> 
      <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
      <label class="control-label visible-ie8 visible-ie9">Email Address</label>
      <input class="form-control form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="Email Address" name="username" id="username"/>
    </div>
    <div class="form-group">
      <label class="control-label visible-ie8 visible-ie9">Password</label>
      <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" id="password"/>
    </div>
    <div class="form-actions">
      <button type="submit" name="submit" class="btn btn-info uppercase">Register</button>
    </div>
  </form>
	<!-- END LOGIN FORM -->
	<!-- BEGIN FORGOT PASSWORD FORM -->
<!--	<form class="forget-form" action="<?php echo ADMIN_URL; ?>" method="post">
		<h3>Forget Password ?</h3>
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
	</form>-->
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