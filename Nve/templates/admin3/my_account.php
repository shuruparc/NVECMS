<?php include 'conn.php'; ?>
<?php 
//Add Code
if(isset($_REQUEST['submit']))
{
	// Edit Details

		$id=mysqli_real_escape_string($conn,$_REQUEST['id']);	
		$fname=mysqli_real_escape_string($conn,$_REQUEST['fname']);
		$lname=mysqli_real_escape_string($conn,$_REQUEST['lname']);
		$role=mysqli_real_escape_string($conn,$_REQUEST['role']);
		$school=mysqli_real_escape_string($conn,$_REQUEST['school']);
		$username=mysqli_real_escape_string($conn,$_REQUEST['username']);
		$password=mysqli_real_escape_string($conn,$_REQUEST['password']);
		$sql = "UPDATE `users` SET `fname`='".$fname."',`password`='".$password."',`lname`='".$lname."',`role`='".$role."',`school`='".$school."',`username`='".$username."' WHERE `id`='".$_SESSION['id']."'";
		if($conn->query($sql)===TRUE)
		{
		$msg="Record updated successfully";
		$flg=0;
		$redirectUrl=ADMIN_URL.'my_account.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
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
          <li class="active"> My Account </li>
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
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Account Details </span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div class="row number-stats">
               <!-- <div class="col-md-11 col-sm-11 col-xs-11" style="border:none !important"><a href="#draggable" id="add_new" class="btn btn-sm blue" data-toggle="modal" title="ADD NEW">+ Add New</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Total Records:</strong> <?php echo $total_count;?></div>-->
                <div class="col-md-1 col-sm-1 col-xs-1 table-toolbar">
                  <div class="btn-group pull-right">
                  </div>
                </div>
              </div>
              <div class="row number-stats" >
                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
                	<?php if(isset($_REQUEST['msg'])){
                           if($_REQUEST['flg']!='1')
                           { 
                             echo '<div class="alert alert-success" id="alert_msg">';
                             echo '<button class="close" data-close="alert"></button>'; 
                           }
                           else
                           { 
                             echo '<div class="alert alert-reception" id="alert_msg">'; 
                             echo '<button class="close" data-close="alert"></button>'; 
                           }}?>                    
                        
                        <span><?php if(isset($_REQUEST['msg']))
                        { echo $_REQUEST['msg'];}?> </span>
					</div>
                 </div>                
              </div>
              
             <form action="" method="post" class="form-horizontal"><?php 
				  $sql3="SELECT * FROM `users` WHERE `id`='".$_SESSION['id']."'";
				  $result3=$conn->query($sql3) ;
				 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
				 {
					 ?>   
                                <div class="form-body">
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">First Name</label>
                                    <div class="col-md-5">
                                        <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter text" value="<?php echo $row3['fname']; ?>"/>
                                        <input type="hidden" name="id" id="id" class="form-control" placeholder="Enter id" />
                                      
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Last Name</label>
                                    <div class="col-md-5">
                                        <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter text" value="<?php echo $row3['lname']; ?>"/>
                                       
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Password</label>
                                    <div class="col-md-5">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter text" value="<?php echo $row3['password'] ?>"/>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Role</label>
                                    <div class="col-md-5">
                                      <select class="form-control" name="role" id="role">
                                          <option value="<?php echo $row3['role']; ?>"><?php if($row3['role']==1){?>Admin <?php } ?><?php if($row3['role']==2){?>Teachers <?php } ?><?php if($row3['role']==3){?>Editor <?php } ?></option>
                                          <option value="0">Select Role</option>
                                          <option value="1">Admin</option>
                                          <option value="2">Teachers</option>
                                          <option value="3">Editor</option>
                                     </select>
                                     </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">School</label>
                                    <div class="col-md-5">
                                        <input type="text" name="school" id="school" class="form-control" placeholder="Enter text" value="<?php echo $row3['school']; ?>"/>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Email/Username</label>
                                    <div class="col-md-5">
                                        <input type="email" name="username" id="username" class="form-control" placeholder="Enter text" value="<?php echo $row3['username']; ?>"/>
                                      </div>
                                  </div>
                                </div>
                                <div class="form-actions top">
                                  <div class="row">
                                    <div class="col-md-offset-4 col-md-7">
                                      <button type="submit" name="submit" id="submit" class="btn green">Submit</button>
                                    </div>
                                  </div>
                                </div>
                                <?php } ?>
                              </form>
              
              <!--Modal-->
              
              
              <!--Modal End-->
              
            </div>
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
<script src="newjs/jquery.min.js" type="text/javascript"></script>

<?php include "footer.php" ?>