<?php //error_reporting(0); // Error Reporting Off
error_reporting(2); // Error Reporting On
session_start();
$servername = "localhost";
$username = "root";
$password = "root";
$db = "nve_management_system";  //NVE
$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
define("ADMIN_URL", "http://localhost:8888/NVECMS/Nve/templates/admin3/");
define("ADMIN_URL2", "http://localhost:8888/NVECMS/Nve");
define("PAGI_LIMIT", 30);
date_default_timezone_set("Europe/London");
date_default_timezone_get();
?>

<?php
//Inserting Data to Database
if (isset($_REQUEST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_REQUEST['name']);
    $email = mysqli_real_escape_string($conn, $_REQUEST['email']);
    $browser_type = mysqli_real_escape_string($conn, $_REQUEST['browser_type']);
    $browser_version = mysqli_real_escape_string($conn, $_REQUEST['browser_version']);
    $operating_system = mysqli_real_escape_string($conn, $_REQUEST['operating_system']);
    $user_resolution = mysqli_real_escape_string($conn, $_REQUEST['user_resolution']);
    $compatibility_mode = mysqli_real_escape_string($conn, $_REQUEST['compatibility_mode']);
    $cookies = mysqli_real_escape_string($conn, $_REQUEST['cookies']);
    $formPopups = mysqli_real_escape_string($conn, $_REQUEST['formPopups']);
    $js = mysqli_real_escape_string($conn, $_REQUEST['js']);
    $sql = "INSERT INTO `system_checker`(`name`,`email`,`browser_type`,`browser_version`,`operating_system`,`user_resolution`,`compatibility_mode`,`cookies`,`formPopUps`,`js`) VALUES ('" . $name . "','" . $email . "','" . $browser_type . "','" . $browser_version . "','" . $operating_system . "','" . $user_resolution . "','" . $compatibility_mode . "','". $cookies ."','" . $formPopups . "','" . $js . "')";
    if ($conn->query($sql) === true) {
        echo '<script language="javascript">';
        echo 'alert("Submit Successfull")';
        'location.href="system_checker.php"';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo 'alert("Opps!! Not Successfull"); location.href="system_checker.php"';
        echo '</script>';
    }
}
//Ends
?>
<!--Code implemented from: https://www.generacodice.com/en/articolo/352292/how-can-i-detect-the-browser-with-php-or-javascript-->
<?php
error_reporting(0);
function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version = "";

    //First get the platform
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'Windows';
    }

    // Next get the name of the useragent.
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/OPR/i', $u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Chrome/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent) && !preg_match('/Edge/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    } elseif (preg_match('/Edge/i', $u_agent)) {
        $bname = 'Edge';
        $ub = "Edge";
    } elseif (preg_match('/Trident/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }

    // check if we have a number
    if ($version == null || $version == "") {
        $version = "?";
    }

    return array(
'userAgent' => $u_agent,
'name'      => $bname,
'version'   => $version,
'platform'  => $platform,
'pattern'    => $pattern
);
}
/*Code implemented from:
https://www.php.net/manual/en/function.get-browser.php
https://roytuts.com/detect-operating-system-using-php/ */

$ua = getBrowser();
function get_operating_system()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $operating_system = 'Unknown Operating System';

    //Get the operating_system name
    if (preg_match('/linux/i', $u_agent)) {
        $operating_system = 'Linux';
    } elseif (preg_match('/macintosh|mac os x|mac_powerpc/i', $u_agent)) {
        $operating_system = 'Mac';
    } elseif (preg_match('/windows|win32|win98|win95|win16/i', $u_agent)) {
        $operating_system = 'Windows';
    } elseif (preg_match('/ubuntu/i', $u_agent)) {
        $operating_system = 'Ubuntu';
    } elseif (preg_match('/iphone/i', $u_agent)) {
        $operating_system = 'IPhone';
    } elseif (preg_match('/ipod/i', $u_agent)) {
        $operating_system = 'IPod';
    } elseif (preg_match('/ipad/i', $u_agent)) {
        $operating_system = 'IPad';
    } elseif (preg_match('/android/i', $u_agent)) {
        $operating_system = 'Android';
    } elseif (preg_match('/blackberry/i', $u_agent)) {
        $operating_system = 'Blackberry';
    } elseif (preg_match('/webos/i', $u_agent)) {
        $operating_system = 'Mobile';
    }

    return $operating_system;
}

?>
<!--Code implemented from: https://stackoverflow.com/questions/6663859/check-if-cookies-are-enabled-->
<?php
if (isset($_COOKIE['cookieCheck'])) {
    $cooki = "Enabled";
} else {
    if (isset($_GET['reload'])) {
        $cooki = "Disabled";
    } else {
        setcookie('cookieCheck', '1', time() + 60);
        header('Location: ' . $_SERVER['PHP_SELF'] . '?reload');
        exit();
    }
}
?>

<title>Nve CMS</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/responsive.css" type="text/css" />
<link rel="stylesheet" href="css/entypo.css" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<link rel="stylesheet" href="css/pro-responsive.css" type="text/css" />
<link rel="stylesheet" href="css/landing-pg.css" type="text/css" />
<link rel="stylesheet" href="css/style-nav.css" type="text/css" />
<link rel="stylesheet" href="css/mission-css.css" type="text/css" />
<?php include "NVECMS/Nve/templates/admin3/header.php"; ?>

<style>
  /*to hide one td when javascript disabled*/
  #site {
    display: none;
  }

  th {
    font-weight: bold;
    text-align: center;
  }

  td {
    text-align: center;
  }
</style>
<!--if javaScript exists link tests for javaScript-->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
  $(document).ready(function () {
    $("#noJS").hide();
    $("#site").show();
    if ($("#site").show()) {
      document.getElementById("js").value = " Enabled";
    }
    if (isset($("#noJS").hide())) {
      document.getElementById("js").value = " Disabled";
    }

  });
</script>
<script>
  $(window).on("load", function () {
    var windowName = "userConsole";
    var popUp = window.open("#", windowName, "width=10, height=10, left=24, top=24, scrollbars, resizable");

    if (popUp == null || typeof (popUp) == "undefined") {
      document.getElementById("Popups").innerHTML = "Disabled";
      document.getElementById("Popups").className = "alert-danger";
      document.getElementById("formPopups").value = " Disabled";
      document.getElementById("formPopups").className = "alert-danger";
    } else {
      document.getElementById("Popups").innerHTML = "Enabled";
      document.getElementById("Popups").className = "alert-success";
      document.getElementById("formPopups").value = " Enabled";
      document.getElementById("formPopups").className = "alert-success";
    }
  });
</script>

<body onload="myFunction()">
  <div id="loader"></div>

  <!-- BEGIN PAGE CONTAINER -->
  <div class="page-container">
    <!-- BEGIN PAGE HEAD -->
    <section>
      <div class="col-md-12" style="z-index:999999; background:#ffffff; padding-bottom:19px; padding-top:19px;">
        <nav class="navbar navbar-default navbar-static-top">
          <div class="col-md-12" style="padding-left:0">
            <div class="col-md-12 header-nve">NVE is a content management system that allows teachers to be in control
              of what resources they will use to teach their students.</div>
            <div class="col-md-2">
              <a href="http://localhost:8888/NVECMS/index.html" style="cursor:pointer !important"
                title="NVE - Content Management System">
                <img src="images/logo.png" class="img-responsive center-block" />
              </a>
            </div>
            <div class="col-md-10" style="padding-top:9px; padding-right:0">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td style="text-align:right; vertical-align:middle !important; padding-right:19px; font-weight:bold;">
                    Helpline: 0800 723 5829</td>
                  <td style="width:5%; text-align:right; padding-right:0px;"><img src="images/fb.jpg"
                      class="img-responsive" /></td>
                  <td style="width:5%; text-align:right; padding-right:0px;"><img src="images/tw.jpg"
                      class="img-responsive" /></td>
                  <td style="width:5%; text-align:right; padding-right:0px;"><img src="images/link.jpg"
                      class="img-responsive" /></td>
                </tr>
              </table>
            </div>
          </div>

          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
              data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle
                navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span
                class="icon-bar"></span> </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="float:right !important">
            <ul class="nav navbar-nav">
              <li><a href="http://localhost:8888/NVECMS/index.html" title="Home">Home</a></li>
              <li><a href="http://localhost:8888/NVECMS/system_checker.php" title="Home">System Checker</a></li>
              <li><a href="http://localhost:8888/NVECMS/Nve/templates/admin3/registration.php"
                  title="Registration">Registration</a></li>
              <li><a href="http://localhost:8888/NVECMS/Nve/templates/admin3/index.php" title="Sign In">Sign In</a></li>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
        </nav>
      </div>
    </section>
    <section style="background-color: #197de0 !important">
      <center>
        <h3><strong style="font-size: 50px; color: white; font-weight:bold">Systems Checker</strong>
        </h3>
      </center>
      <br>
    </section>

    <!-- END PAGE HEAD -->

    <!-- BEGIN PAGE CONTENT -->
    <div class="page-content">
      <div class="container-fluid">
        <!-- BEGIN PAGE CONTENT INNER -->
        <div class="row margin-top-10">
          <div class="col-md-12" style="padding-left:40px; padding-right:40px">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light">


              <br><br><br><br><br>
              <!-- Test screen dimensions -->
              <?php session_start();
                    if (isset($_SESSION['screen_width']) and isset($_SESSION['screen_height'])) {
                        'User resolution: ' . $_SESSION['screen_width'] . 'x' . $_SESSION['screen_height'];
                    } elseif (isset($_REQUEST['width']) and isset($_REQUEST['height'])) {
                        $_SESSION['screen_width'] = $_REQUEST['width'];
                        $_SESSION['screen_height'] = $_REQUEST['height'];
                        header('Location: ' . $_SERVER['PHP_SELF']);
                    } else {
                        echo '<script type="text/javascript">window.location = "' . $_SERVER['PHP_SELF'] . '?width="+screen.width+"&height="+screen.height;</script>';
                    }
                ?>
              <form method="post" class="form-horizontal">
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-2">
                      <label class="control-label">Name: </label>
                    </div>
                    <div class="col-md-3">
                      <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" />
                    </div>
                    <div class="col-md-2">
                      <label class="control-label">Email: </label>
                    </div>
                    <div class="col-md-3">
                      <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" />
                    </div>
                    <input type="hidden" name="browser_type" id="browser_type" value="<?php echo $ua['name']; ?>"
                      class="form-control" />
                    <input type="hidden" name="browser_version" id="browser_version"
                      value="<?php echo $ua['version']; ?>" class="form-control" />
                    <input type="hidden" name="operating_system" id="operating_system"
                      value="<?php echo get_operating_system() ?>" class="form-control" />
                    <input type="hidden" name="user_resolution" id="user_resolution" value="<?php echo 'System resolution: ' . $_SESSION['screen_width'] . ' x ' . $_SESSION['screen_height'];
                        if ($_SESSION['screen_width'] < 1024) { ?>Fail <?php }
                        if ($_SESSION['screen_width'] > 1024) { ?> Your System Passes The Minimum Requirement <?php } ?>" class="form-control" />
                    <input type="hidden" name="compatibility_mode" id="compatibility_mode"
                      value="<?php if ($ua['version'] != " ?") { ?>Enabled
                    <?php } ?>
                    <?php if ($ua['version'] == "?") { ?>Disabled
                    <?php } ?>" class="form-control" />
                    <input type="hidden" name="cookies" id="cookies" value="<?php echo $cooki; ?>"
                      class="form-control" />
                    <input type="hidden" id="js" name="js" placeholder="javaScript" readonly>
                    <input type="hidden" id="formPopups" name="formPopups" placeholder="Popups" readonly>

                    <div class="col-md-2">
                      <button type="submit" name="submit" id="submit" class="btn green"
                        style="float:right">Submit</button>
                    </div>
                  </div>
                </div>
                <br>
                <br>
              </form>
              <br>
              <h1><strong style="font-size: 20px; font-weight:bold">Browser Version</strong></h1>
              <br>
              <br>
              <table class="table table-striped table-hover table-bordered" style="line-break: anywhere;">
                <thead>
                  <tr>
                    <th>Browser Type</th>
                    <th>Browser Version</th>
                    <th>Operating System</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="alert-success">
                      <?php echo $ua['name']; ?>
                    </td>
                    <td class="alert-success">
                      <?php echo $ua['version']; ?>
                    </td>
                    <td class="alert-success">
                      <?php echo get_operating_system() ?>
                    </td>
                  </tr>
                </tbody>
              </table>
              <br>
              <br>
              <h1><strong style="font-size: 20px; font-weight:bold">Browser Features</strong></h1>
              <br>
              <br>
              <table class="table table-striped table-hover table-bordered" style="line-break: anywhere;">
                <thead>
                  <th class="col-md-3">Resolution</th>
                  <th class="col-md-3">Compatibility Mode </th>
                  <th>Cookies</th>
                  <th class="col-md-3">JavaScript</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td <?php if ($_SESSION['screen_width'] < 1024) { ?>class="alert-danger col-md-3"
                      <?php } ?>
                      <?php if ($_SESSION['screen_width'] > 1024) { ?>class="alert-success"
                      <?php } ?> >
                      <?php echo 'System resolution: ' . $_SESSION['screen_width'] . ' x ' . $_SESSION['screen_height'];
                            if ($_SESSION['screen_width'] < 1024) { ?>Fail
                                                  <?php }
                            if ($_SESSION['screen_width'] > 1024) { ?> <br />Your System Passes The Minimum Requirement
                                                  <?php } ?>
                    </td>
                    <td <?php if ($ua['version'] !="?") { ?>class="alert-success"
                        <?php } ?>
                        <?php if ($ua['version'] == "?") { ?>class="alert-danger"
                        <?php } ?>>
                        <?php if ($ua['version'] != "?") { ?>Enabled
                        <?php } ?>
                        <?php if ($ua['version'] == "?") { ?>Disabled
                        <?php } ?>
                    </td>
                    <td <?php if ($cooki !="Enabled") { ?>class="alert-danger"
                        <?php } ?>
                        <?php if ($cooki == "Enabled") { ?>class="alert-success"
                        <?php } ?>>
                        <?php echo $cooki; ?>
                    </td>
                    <td id="noJS" class="alert-danger">JavaScript Disabled</td>
                    <td id="site" class="alert-success">JavaScript Enabled</td>
                    <input type="hidden" id="js" name="js" placeholder="javaScript" readonly>
                  </tr>
                  <thead>
                    <th colspan="4">Pop Ups</th>
                  </thead>
                  <tr>
                    <input type="hidden" id="formPopups" name="formPopups" placeholder="Popups" readonly>
                    <td class="alert-danger" id="Popups" colspan="10">
                      <strong>JavaScript Disabled</strong>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <br>
            <br>
          </div>
          <!-- END EXAMPLE TABLE PORTLET-->
        </div>
      </div>
      <!-- END PAGE CONTENT INNER -->
    </div>
  </div>
  <!-- END PAGE CONTENT -->
  </div>
  <!-- END PAGE CONTAINER -->
  </section>

  <div class="col-md-12"
    style="text-align:left; color:#ffffff; font-size:9pt; padding:9px 29px; background:url(images/crbg.png) #005c97">
    Copyright © 2021 NVE CMS. All Rights Reserved</div>
  </div>
  </section>
  <script src="newjs/jquery.min.js" type="text/javascript"></script>