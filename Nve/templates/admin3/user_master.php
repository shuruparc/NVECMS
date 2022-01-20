<?php include 'conn.php'; ?>
<?php 
//Add Code
if(isset($_REQUEST['submit']))
{
	// New Data Add
	if($_REQUEST['id']!=''){
		$id=mysqli_real_escape_string($conn,$_REQUEST['id']);	
		$fname=mysqli_real_escape_string($conn,$_REQUEST['fname']);
		$lname=mysqli_real_escape_string($conn,$_REQUEST['lname']);
		$role=mysqli_real_escape_string($conn,$_REQUEST['role']);
		$school=mysqli_real_escape_string($conn,$_REQUEST['school']);
		$username=mysqli_real_escape_string($conn,$_REQUEST['username']);
		$password=mysqli_real_escape_string($conn,$_REQUEST['password']);
		$sql = "UPDATE `users` SET `fname`='".$fname."',`password`='".$password."',`lname`='".$lname."',`role`='".$role."',`school`='".$school."',`username`='".$username."' WHERE `id`='".$_REQUEST['id']."'";
		if($conn->query($sql)===TRUE)
		{
		$msg="Record updated successfully";
		$flg=0;
		$redirectUrl=ADMIN_URL.'user_master.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
		$redirectUrl=ADMIN_URL.'user_master.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
	}
	//Edit Data
	else{
		$id=mysqli_real_escape_string($conn,$_REQUEST['id']);	
		$fname=mysqli_real_escape_string($conn,$_REQUEST['fname']);
		$lname=mysqli_real_escape_string($conn,$_REQUEST['lname']);
		$role=mysqli_real_escape_string($conn,$_REQUEST['role']);
		$school=mysqli_real_escape_string($conn,$_REQUEST['school']);
		$username=mysqli_real_escape_string($conn,$_REQUEST['username']);
		$password=mysqli_real_escape_string($conn,$_REQUEST['password']);
		$sql = "INSERT INTO `users`(`fname`,`password`,`lname`,`role`,`school`,`username`) VALUES ('".$fname."','".$password."','".$lname."','".$role."','".$school."','".$username."')";
		if($conn->query($sql)===TRUE)
		{
		$flg=0;
		$msg="New record created successfully";
		$redirectUrl=ADMIN_URL.'user_master.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
		$redirectUrl=ADMIN_URL.'user_master.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
	}
} 
//Delete Data
if(isset($_REQUEST['delete']))
{
	$sql = "DELETE FROM `users` WHERE `id`='".$_REQUEST['delete']."'";
	$result=$conn->query($sql);
	if ($conn->query($sql) === TRUE)
	{
	$flg=0;
	$msg= "Record deleted successfully";
	$redirectUrl=ADMIN_URL.'user_master.php?msg='.$msg.'&flg='.$flg;
	echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
	}
	else 
	{
	$flg=1;
	$msg= "Error deleting record: " . $conn->error;
	$redirectUrl=ADMIN_URL.'user_master.php?msg='.$msg.'&flg='.$flg;
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
          <li class="active"> Users </li>
        </ul>
      </div>
      <!-- END PAGE TITLE --> 
    </div>
  </div>
  <!-- END PAGE HEAD --> 
<?php 
				 $today='2020-02-18';
				 //$today=date('Y-m-d');
				 $total_count=0;
				$sql="SELECT COUNT(DISTINCT `id`) AS `total_count` FROM `users`";
				$result=$conn->query($sql) ;				
				$row = $result->fetch_assoc();
				$total_count=$row['total_count'];					 
			 ?>
  <!-- BEGIN PAGE CONTENT -->
  <div class="page-content">
    <div class="container-fluid"> 
      <!-- BEGIN PAGE CONTENT INNER -->
      <div class="row margin-top-10">
        <div class="col-md-12"> 
          <!-- BEGIN EXAMPLE TABLE PORTLET-->
          <div class="portlet light">
            <div class="portlet-title">
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">User Details </span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div class="portlet-body">
              <div class="row number-stats">
                <div class="col-md-11 col-sm-11 col-xs-11" style="border:none !important"><a href="#draggable" id="add_new" class="btn btn-sm blue" data-toggle="modal" title="ADD NEW">+ Add New</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Total Records:</strong> <?php echo $total_count;?></div>
                <div class="col-md-1 col-sm-1 col-xs-1 table-toolbar">
                  <div class="btn-group pull-right">
                  </div>
                </div>
              </div>
              <div class="row number-stats" >
                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
                	<?php if(isset($_REQUEST['msg'])){ if($_REQUEST['flg']!='1'){ echo '<div class="alert alert-success" id="alert_msg">'; }else{ echo '<div class="alert alert-reception" id="alert_msg">';}}?>                    
                        <span><?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg'];}?> </span>
					</div>
                 </div>                
              </div>
              
              <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Username</th>     
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                         <?php 
				  $sql3="SELECT `id`,`fname`,`lname`,`role`,`password`,`school`,`username` FROM `users` ORDER BY `id` DESC";
				  $result3=$conn->query($sql3) ;
				  $id=1;
				 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
				 {
					 ?>            
                   <tr >
                    <td> <?php echo $id; ?></td>
                    <td> <?php echo $row3['username']; ?></td>
                    <td> <a onClick="check('<?php echo $row3['id']; ?>')"  href="javascript:void(0);" ><i class="fa fa-edit" title="Edit"></i> </a> | <a class="delete_user" data-emp-id="<?php echo $row3["id"]; ?>" href="javascript:void(0)"><i class="fa fa-trash" title="Delete" style="color:#F00 !important"></i> </a></td>                   
                  </tr>
                 <?php 
				  $id++; }?>
                </tbody>
              </table>
              
              <!--Modal-->
              <div class="modal fade draggable-modal" id="draggable" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog" id="model_header">
                      <div class="modal-content"> 
                        
                        <div class="modal-body">
                          <div class="portlet box blue-hoki">
                            <div class="portlet-title" >
                              <div class="caption"> <i class="fa fa-gift"></i>Add New Editor</div>
                            </div>
                            <div class="portlet-body form"> 
                              <!-- BEGIN FORM-->
                              <form action="" method="post" class="form-horizontal">
                                <div class="form-body">
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">First Name</label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <input type="text" name="fname" id="fname" class="form-control" placeholder="Enter text" required/>
                                        <input type="hidden" name="id" id="id" class="form-control" placeholder="Enter id" />
                                      </div>
                                      <!--<span class="help-block"> A block of help text. </span>--> </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Last Name</label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <input type="text" name="lname" id="lname" class="form-control" placeholder="Enter text" required/>
                                        
                                      </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Password</label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <input type="text" name="password" id="password" class="form-control" placeholder="Enter text" required/>
                                        
                                      </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Designation</label>
                                    <div class="col-md-7">
                                      <select class="form-control" name="role" id="role">
                                          <option value="0">Select Designation</option>
                                          <option value="2">Teachers</option>
                                          <option value="3">Editor</option>
                                     </select>
                                     </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">School</label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <input type="text" name="school" id="school" class="form-control" placeholder="Enter text" required/>
                                        
                                      </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Email</label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <input type="email" name="username" id="username" class="form-control" placeholder="Enter text" />
                                        
                                      </div>
                                      </div>
                                  </div>
                                </div>
                                <div class="form-actions top">
                                  <div class="row">
                                    <div class="col-md-offset-4 col-md-7">
                                      <button type="submit" name="submit" id="submit" class="btn green">Submit</button>
                                      
                                      <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </form>
                              <!-- END FORM--> 
                            </div>
                          </div>
                        </div>
                       
                      </div>
                      <!-- /.modal-content --> 
                    </div>
                    <!-- /.modal-dialog --> 
                  </div>
              
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
<?php include "script/user_masterJS.php"?>

<?php include "footer.php" ?>

