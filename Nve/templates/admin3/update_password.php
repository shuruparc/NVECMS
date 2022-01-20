<?php include 'conn.php'; ?>
<?php
//Add Code
if (isset($_REQUEST['submit'])) {
    // New Data Add
    if ($_REQUEST['password']!='') {
        $password=mysqli_real_escape_string($conn, $_REQUEST['password']);
        $username=mysqli_real_escape_string($conn, $_REQUEST['username']);
        $sql = "UPDATE `users` SET `password`='".$password."' WHERE `username`='".$username."'";
        if ($conn->query($sql)===true) {
            $_SESSION['password']=$_REQUEST['password'];
            $msg="Thank You..Password updated successfully..";
            $flg=0;
            $redirectUrl=ADMIN_URL.'update_password.php?msg='.$msg.'&flg='.$flg;
            echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
        } else {
            $flg=1;
            $msg="Error:".$sql."<br>".$conn->error;
            $redirectUrl=ADMIN_URL.'update_password.php?msg='.$msg.'&flg='.$flg;
            echo "<script type=\"text/javascript\"> window.location.href='$redirectUrl'; </script>";
        }
    }
}

?>
<?php include "header.php"; ?>

<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
    <!-- BEGIN PAGE HEAD -->
    <div class="page-head">
        <div class="container-fluid">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1><small>Welcome to NVE</small></h1>
                <ul class="page-breadcrumb breadcrumb">
                    <li> <a href="<?php echo ADMIN_URL; ?>dashboard.php">Home</a><i class="fa fa-circle"></i> </li>
                    <li class="active"> Settings </li>
                </ul>
            </div>
            <!-- END PAGE TITLE -->
        </div>
    </div>
    <!-- END PAGE HEAD -->

    <!-- BEGIN PAGE CONTENT -->
    <div class="page-content">
        <div class="container-fluid">
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="row margin-top-10">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span
                                    class="caption-subject font-green-sharp bold uppercase">Change Password</span></div>
                            <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;"
                                    class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                        </div>
                        <div class="portlet-body">

                            <div class="row number-stats">
                                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
                                    <?php if (isset($_REQUEST['msg'])) {
                                            if ($_REQUEST['flg']!='1') 
                                            {
                                                echo '<div class="alert alert-success" id="alert_msg">';
                                                echo '<button class="close" data-close="alert"></button>';
                                            } else {
                                                echo '<div class="alert alert-reception" id="alert_msg">';
                                                echo '<button class="close" data-close="alert"></button>';
                                            }
                                        }?>

                                    <span>
                                        <?php if (isset($_REQUEST['msg'])) 
                                                {
                                                    echo $_REQUEST['msg'];
                                                }?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <form action="" method="post" class="form-horizontal">
                                <div class="form-body">

                                    <div class="form-group">
                                        <label class="col-md-4 control-label font-blue-sharp"
                                            style="font-weight:bold;">Old Password:</label>
                                        <div class="col-md-3">
                                            <div class="input-group"><span class="input-group-addon"> <i
                                                        class="fa fa-key"></i> </span>
                                                <input type="hidden" id="username" name="username" class="form-control"
                                                    value="<?php echo $_SESSION['username'];?>" />
                                                <input type="hidden" id="opass" name="opass" class="form-control"
                                                    value="<?php echo $_SESSION['password'];?>" />
                                                <input type="password" id="npass" name="npass" class="form-control"
                                                    onblur="chk_oldPass()" placeholder="Enter Old Password" required />
                                            </div>
                                            <span class="help-block " id="err_old_ps_chck"> Enter Old Password </span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-4 control-label font-blue-sharp"
                                            style="font-weight:bold;">New Password:</label>
                                        <div class="col-md-3">
                                            <div class="input-group"><span class="input-group-addon"> <i
                                                        class="fa fa-key"></i> </span>
                                                <input type="password" id="password" name="password"
                                                    class="form-control" onblur="enbale_confirm()"
                                                    placeholder="Enter New Password" required disabled />
                                            </div>
                                            <span class="help-block " id="err_old_ps_chck2"> Enter New Password </span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-4 control-label font-blue-sharp"
                                            style="font-weight:bold;">Confirm Password:</label>
                                        <div class="col-md-3">
                                            <div class="input-group"><span class="input-group-addon"> <i
                                                        class="fa fa-key"></i> </span>
                                                <input type="password" id="confirm_password" name="confirm_password"
                                                    class="form-control" onblur="confirm_pass()"
                                                    placeholder="Enter Confirm Password" disabled required />
                                            </div>
                                            <span class="help-block " id="err_old_ps_chck3"> Enter Confirm Password
                                            </span>
                                        </div>
                                    </div>


                                    <div class="form-actions top">
                                        <div class="row">
                                            <div class="col-md-offset-4 col-md-7">
                                                <button type="submit" name="submit" id="submit" class="btn blue"
                                                    title="Submit" disabled>Submit</button>
                                                <a href="<?php echo ADMIN_URL; ?>update_password.php"> <button
                                                        type="button" name="reload" id="reload" class="btn red"
                                                        title="Reload">Reload</button></a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <!-- END FORM-->



                            <!--Modal-->


                            <!--Modal End-->

                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->
    </div>
</div>
<!-- END PAGE CONTENT -->

<!-- END PAGE CONTAINER -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setTimeout('$("#alert_msg").hide()', 3000);
        $(' #npass, #password, #confirm_password ').click(function (e) {
            $(this).focus();
        });
    });


    function chk_oldPass() {
        var oldp = $("#opass").val();
        var newp = $("#npass").val();
        if (newp == oldp) {
            $("#password").prop('disabled', false);
            $("#password").focus();
            $("#err_old_ps_chck").html("OLD PASSWORD MATCHED..");
            $("#err_old_ps_chck").removeClass("alert-reception");
            $("#err_old_ps_chck").removeClass("alert-success");
            $("#err_old_ps_chck").addClass("alert-success");
        }
        else {
            $("#npass").focus();
            $("#err_old_ps_chck").html("OLD PASSWORD DID NOT MATCH!!!");
            $("#err_old_ps_chck").removeClass("alert-success");
            $("#err_old_ps_chck").removeClass("alert-reception");
            $("#err_old_ps_chck").addClass("alert-reception");
        }
        //alert(oldp);
    }

    function enbale_confirm() {
        var oldp = $("#password").val();
        if (oldp != '') {
            $("#confirm_password").prop('disabled', false);
            $("#confirm_password").focus();
        }
        else {
            $("#err_old_ps_chck2").html("PLEASE ENTER PASSWORD..");
            $("#err_old_ps_chck2").removeClass("alert-reception");
            $("#err_old_ps_chck2").removeClass("alert-success");
            $("#err_old_ps_chck2").addClass("alert-reception");
        }
    }

    function confirm_pass() {
        var oldp = $("#password").val();
        var newp = $("#confirm_password").val();
        if (newp == oldp) {
            $("#submit").prop('disabled', false);
            $("#submit").focus();
            $("#err_old_ps_chck3").html("PASSWORD MATCHED..");
            $("#err_old_ps_chck3").removeClass("alert-reception");
            $("#err_old_ps_chck3").removeClass("alert-success");
            $("#err_old_ps_chck3").addClass("alert-success");
        }
        else {
            $("#confirm_password").focus();
            $("#err_old_ps_chck3").html("PASSWORD DID NOT MATCH!!!");
            $("#err_old_ps_chck3").removeClass("alert-success");
            $("#err_old_ps_chck3").removeClass("alert-reception");
            $("#err_old_ps_chck3").addClass("alert-reception");
        }
        //alert(oldp);
    }
    $(function () {
        $('#password').on('click', function () {
            //alert("ani");
            $("#confirm_password").val('');
            $("#confirm_password").prop('disabled', true);
            $(this).focus();
        });


    });

</script>
<?php include "footer.php" ?>