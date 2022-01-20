<?php include 'conn.php'; ?>
<?php 

if(isset($_REQUEST['submit']))
{
	// Update Data 
	if($_REQUEST['id']!=''){
		$id=mysqli_real_escape_string($conn,$_REQUEST['id']);	
		$l_title=mysqli_real_escape_string($conn,$_REQUEST['l_title']);
		$l_stage=mysqli_real_escape_string($conn,$_REQUEST['l_stage']);
		$l_subject=mysqli_real_escape_string($conn,$_REQUEST['l_subject']);
		$l_resources=mysqli_real_escape_string($conn,$_REQUEST['l_resources']);
		$l_url=mysqli_real_escape_string($conn,$_REQUEST['l_url']);
		//$role=mysqli_real_escape_string($conn,$_REQUEST['role']);
		$sql = "UPDATE `lessons` SET `l_title`='".$l_title."',`l_stage`='".$l_stage."',`l_subject`='".$l_subject."',`l_resources`='".$l_resources."',`l_url`='".$l_url."' WHERE `id`='".$_REQUEST['id']."'";
		if($conn->query($sql)===TRUE)
		{
		$msg="Record updated successfully";
		$flg=0;
		$redirectUrl=ADMIN_URL.'my_lesson.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
		$redirectUrl=ADMIN_URL.'my_lesson.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
	}
	//Add Data
	else{
		$id=mysqli_real_escape_string($conn,$_REQUEST['id']);	
		$l_title=mysqli_real_escape_string($conn,$_REQUEST['l_title']);
		$l_stage=mysqli_real_escape_string($conn,$_REQUEST['l_stage']);
		$l_subject=mysqli_real_escape_string($conn,$_REQUEST['l_subject']);
		$l_resources=mysqli_real_escape_string($conn,$_REQUEST['l_resources']);
		$l_url=mysqli_real_escape_string($conn,$_REQUEST['l_url']);
		$userID=mysqli_real_escape_string($conn,$_SESSION['id']);
		$sql = "INSERT INTO `lessons`(`l_title`,`l_stage`,`l_subject`,`l_resources`,`l_url`,`userID`) VALUES ('".$l_title."','".$l_stage."','".$l_subject."','".$l_resources."','".$l_url."','".$userID."')"; 
		if($conn->query($sql)===TRUE)
		{
		$flg=0;
		$msg="New record created successfully";
		$redirectUrl=ADMIN_URL.'my_lesson.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
		$redirectUrl=ADMIN_URL.'my_lesson.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
	}
} 
//Delete Data
if(isset($_REQUEST['delete']))
{
	$sql = "DELETE FROM `lessons` WHERE `id`='".$_REQUEST['delete']."'";
	$result=$conn->query($sql);
	if ($conn->query($sql) === TRUE)
	{
	$flg=0;
	$msg= "Record deleted successfully";
	$redirectUrl=ADMIN_URL.'my_lesson.php?msg='.$msg.'&flg='.$flg;
	echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
	}
	else 
	{
	$flg=1;
	$msg= "Error deleting record: " . $conn->error;
	$redirectUrl=ADMIN_URL.'my_lesson.php?msg='.$msg.'&flg='.$flg;
	echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
	}
} 
?> 
<?php include "header.php"; ?>
<script>
function get_subject(val)
{
	var cls=$("#l_stage").val();
	$.ajax({
		type:"POST",
		url:"get_resource.php?cls="+cls,
		data: 'l_stage='+val,
		success: function(data){
			$("#l_subject").html(data);
		}
	});
}
function get_resource(val)
{
	var sub=$("#l_subject").val();
  var st=$("#l_stage").val();
	$.ajax({
		type:"POST",
		url:"get_resource_files.php?sub="+sub+"&st="+st,
		data: 'l_subject='+val,
		success: function(data){
			$("#l_resources").html(data);
		}
	});
}
function get_allDetails(val)
{

	var res=$("#l_resources").val();
  var sub=$("#l_subject").val();
  var st=$("#l_stage").val();
	$.ajax({
		type:"POST",
		url:"get_all_details.php?res="+res+"&sub="+sub+"&st="+st,
		data: 'l_resources='+val,
		success: function(data){
			$("#l_url").html(data);
		}
	});
}
</script>
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container"> 
  <!-- BEGIN PAGE HEAD -->
  <div class="page-head">
    <div class="container-fluid"> 
      <!-- BEGIN PAGE TITLE -->
      <div class="page-title">
        <h1><small>Welcome to NVE</small></h1>
        <ul class="page-breadcrumb breadcrumb">
          <li> <a href="<?php echo ADMIN_URL; ?>my_lesson.php">Home</a><i class="fa fa-circle"></i> </li>
          <li class="active"> Lessons </li>
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
				$sql="SELECT COUNT(DISTINCT `id`) AS `total_count` FROM `lessons` WHERE `userID`='".$_SESSION['id']."'";
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
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">My Lessons</span></div>
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
                	<?php if(isset($_REQUEST['msg'])){ if($_REQUEST['flg']!='1')
                  { 
                    echo '<div class="alert alert-success" id="alert_msg">';
                    echo '<button class="close" data-close="alert"></button>'; 
                  }
                  else
                  {
                     echo '<div class="alert alert-reception" id="alert_msg">';
                     echo '<button class="close" data-close="alert"></button>';
                  }}?>                    
                        <!--<button class="close" data-close="alert"></button>-->
                        <span><?php if(isset($_REQUEST['msg'])){ echo $_REQUEST['msg'];}?> </span>
					</div>
                 </div>                
              </div>
              
              <table class="table table-striped table-hover table-bordered" id="sample_editable_1" style="line-break: anywhere;">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Subject Name</th>
                    <th>Lessons Name</th>
                    <th>Stage</th>
                    <th>Lessons Material</th>
                    <th>Lessons Material Link</th>     
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                         <?php 
				  $sql3="SELECT * FROM `lessons` WHERE `userID`='".$_SESSION['id']."' ORDER BY `id` DESC";
				  $result3=$conn->query($sql3) ;
				  $id=1;
				 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
				 {
					 ?>            
                   <tr >
                    <td> <?php echo $id; ?></td>
                    <td> <?php echo $row3['l_subject']; ?></td>
                    <td> <?php echo $row3['l_title']; ?></td>
                    <td> <?php echo $row3['l_stage']; ?></td>
                    <td> <?php echo $row3['l_resources']; ?></td>
                    <td><a href="https://<?php echo $row3['l_url']; ?>" target="blank">
                            <?php echo $row3['l_url']; ?>
                          </a></td>
                    <td> <a onClick="check('<?php echo $row3['id']; ?>'),check2('<?php echo $row3['id']; ?>')"  href="javascript:void(0);" ><i class="fa fa-edit" title="Edit"></i> </a> |  <a class="delete_lesson" data-emp-id="<?php echo $row3["id"]; ?>" href="javascript:void(0)"><i class="fa fa-trash" title="Delete" style="color:#F00 !important"></i> </a> </td>                   
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
                              <div class="caption"> <i class="fa fa-gift"></i>Manage Lesson</div>
                            </div>
                            <div class="portlet-body form"> 
                              <!-- BEGIN FORM-->
                              <form action="" method="post" class="form-horizontal">
                            
                                <div class="form-body">
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Title<span style="color: red">&#42;</span></label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <input type="text" name="l_title" id="l_title"  class="form-control" placeholder="Enter Title" required/>
                                        <input type="hidden" name="id" id="id" class="form-control"  placeholder="Enter id" />
                                         <input type="hidden" name="userID" id="userID" value="<?php echo $_SESSION['role']; ?>" class="form-control"  placeholder="Enter id" />
                                        
                                      </div>
                                      <!--<span class="help-block"> A block of help text. </span>--> </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Key Stage<span style="color: red">&#42;</span></label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                       <select class="form-control" name="l_stage" id="l_stage" onChange="get_subject()" required>
                                          <option value="0">Select Key Stage</option>
                                           <?php 
												 $sql3="SELECT DISTINCT  `rstage` FROM `resource_hub`";
                      
												  $result3=$conn->query($sql3) ;
												  $id=1;
												 while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC))
												 {
										   ?> 
                                          <option value="<?php echo $row3['rstage']; ?>"><?php echo $row3['rstage']; ?></option>
                                          <?php $id++; }?>
                                     </select>
                                        
                                      </div>
                                      <!--<span class="help-block"> A block of help text. </span> --></div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Subject<span style="color: red">&#42;</span></label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                      
                                       <select class="form-control" name="l_subject" id="l_subject" onChange="get_resource()" required>
                                          
                                     </select>
                                        
                                      </div>
                                      <!--<span class="help-block"> A block of help text. </span> --></div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Resources<span style="color: red">&#42;</span></label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                       <select class="form-control" name="l_resources" id="l_resources" onChange="get_allDetails()" required>
                                          <option value="0">Select Resource</option>
                                          <option value=""></option>
                                     </select>
                                        
                                      </div>
                                      <!--<span class="help-block"> A block of help text. </span> --></div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Url</label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                   
                                      <select class="form-control" name="l_url" id="l_url" >
                                          <option value="0">Select Url</option>
                                           
                                          <option value=""></option>
                                          
                                     </select>
                                       
                                      </div>
                                      <!--<span class="help-block"> A block of help text. </span> --></div>
                                  </div>
                                  
                                  
                                  
                                </div>
                                <div class="form-actions top">
                                  <div class="row">
                                    <div class="col-md-offset-4 col-md-7">
                                      <button type="submit" name="submit" id="submit" class="btn green">Submit</button>
                                      <!--<button type="button" class="btn default">Cancel</button>-->
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
<script type="text/javascript"> 
      $(document).ready( function() {      
		setTimeout('$("#alert_msg").hide()',3000);
				
			$("#add_new").click(function(){
				var empty='';
				$("#id").val(empty);
				$("#l_title").val(empty);
				$("#l_stage").val(empty);
				$("#l_subject").val(empty);
				$("#l_resources").val(empty);
				$("#l_url").val(empty);	
				});
      });
function check(id){
	
try{
		$.ajax({
						type : "POST",
						url : "<?php echo ADMIN_URL; ?>ajax/lesson_ajax.php",
						dataType : "json", 
						data : "id="+id,
						success : function(data) {						
							/*alert(data.flag);*/
							try{
								 $('#draggable').modal('show');
								 $("#id").val(data.id);	
								 $("#l_title").val(data.l_title);	
								 $("#l_stage").val(data.l_stage);	
								 $("#l_subject").val(data.l_subject);	
								 $("#l_resources").val(data.l_resources);	
								 $("#l_url").val(data.l_url);
								 $('#l_subject').append($('<option/>', { 
										value: data.l_subject,
										text : data.l_subject 
									}));
								 $('#l_resources').append($('<option/>', { 
										value: data.l_resources,
										text : data.l_resources 
									}));
								 $('#l_url').append($('<option/>', { 
										value: data.l_url,
										text : data.l_url 
									}));
							}
							catch(err){
								alert(err.message);
							}
						
						}
					});
				}catch(err){
					alert(err.message);
				}
setInterval(function(){
   $('#error_msg').html('');
  }, 3000);
 
}	 


</script>
<?php include "footer.php" ?>

