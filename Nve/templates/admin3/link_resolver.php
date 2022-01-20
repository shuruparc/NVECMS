<?php 
include 'function.php';
include 'conn.php'; 

if(isset($_REQUEST['submit']))
{
	// New Data Add
	if($_REQUEST['id']!=''){
		$id=mysqli_real_escape_string($conn,$_REQUEST['id']);	
		$rtitle=mysqli_real_escape_string($conn,$_REQUEST['rtitle']);
		$rsubject=mysqli_real_escape_string($conn,$_REQUEST['rsubject']);
		$rdescription=mysqli_real_escape_string($conn,$_REQUEST['rdescription']);
		$rstage=mysqli_real_escape_string($conn,$_REQUEST['rstage']);
		$rurl=mysqli_real_escape_string($conn,$_REQUEST['rurl']);
		$role=mysqli_real_escape_string($conn,$_REQUEST['role']);
		$nve=mysqli_real_escape_string($conn,$_REQUEST['nve']);
		$create_date=mysqli_real_escape_string($conn,$_REQUEST['create_date']);
		if(!empty($_FILES["rfile"]["name"]))
		{
		$rand=rand(1,999999);
		$target_dir = "resource/";
		$target_file = $rand.basename($_FILES["rfile"]["name"]);
		if(move_uploaded_file($_FILES["rfile"]["tmp_name"], $target_dir.$target_file)) 
		{
		$msg="The file ". basename( $_FILES["rfile"]["name"]). " has been uploaded.";
		} 
		else
		{
		$msg="Sorry, there was an error uploading your file.";
		}
		}
		else
		{
		$target_file=$_REQUEST['rfile'];
		}
		$sql = "UPDATE `resource_hub` SET `rtitle`='".$rtitle."',`rsubject`='".$rsubject."',`rdescription`='".$rdescription."',`rfile`='".$target_file."',`rstage`='".$rstage."',`rurl`='".$rurl."',`role`='".$role."',`nve`='".$nve."',`create_date`='".$create_date."' WHERE `id`='".$_REQUEST['id']."'";
		if($conn->query($sql)===TRUE)
		{
		$msg="Record updated successfully";
		$flg=0;
		$redirectUrl=ADMIN_URL.'resource_hub.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
		$redirectUrl=ADMIN_URL.'resource_hub.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
	}
	//Edit Data
	else{
		$id=mysqli_real_escape_string($conn,$_REQUEST['id']);	
		$rtitle=mysqli_real_escape_string($conn,$_REQUEST['rtitle']);
		$rsubject=mysqli_real_escape_string($conn,$_REQUEST['rsubject']);
		$rdescription=mysqli_real_escape_string($conn,$_REQUEST['rdescription']);
		$rstage=mysqli_real_escape_string($conn,$_REQUEST['rstage']);
		$rurl=mysqli_real_escape_string($conn,$_REQUEST['rurl']);
		$role=mysqli_real_escape_string($conn,$_REQUEST['role']);
		$nve=mysqli_real_escape_string($conn,$_REQUEST['nve']);
		$create_date=mysqli_real_escape_string($conn,$_REQUEST['create_date']);
				if($_FILES['rfile']!="")
				{
				$rand=rand(1,9999);
				$target_dir = "resource/";
				$target_file = $rand.basename($_FILES["rfile"]["name"]);
				if(move_uploaded_file($_FILES["rfile"]["tmp_name"], $target_dir.$target_file)) 
				{
				$msg="The file ". basename( $_FILES["rfile"]["name"]). " has been uploaded.";
				} 
				else 
				{
				$msg="Sorry, there was an error uploading your file.";
				}
				}
		 $sql = "INSERT INTO `resource_hub`(`rtitle`,`rsubject`,`rdescription`,`rfile`,`rstage`,`rurl`,`role`,`nve`,`create_date`) VALUES ('".$rtitle."','".$rsubject."','".$rdescription."','".$target_file."','".$rstage."','".$rurl."','".$role."','".$nve."','".$create_date."')";
		if($conn->query($sql)===TRUE)
		{
		$flg=0;
		$msg="New record created successfully";
		$redirectUrl=ADMIN_URL.'resource_hub.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
		else
		{
		$flg=1;
		$msg="Error:".$sql."<br>".$conn->error;
		$redirectUrl=ADMIN_URL.'resource_hub.php?msg='.$msg.'&flg='.$flg;
		echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
		}
	}
} 
//Delete Data
if(isset($_REQUEST['delete']))
{
	$sql = "DELETE FROM `resource_hub` WHERE `id`='".$_REQUEST['delete']."'";
	$result=$conn->query($sql);
	if ($conn->query($sql) === TRUE)
	{
	$flg=0;
	$msg= "Record deleted successfully";
	$redirectUrl=ADMIN_URL.'resource_hub.php?msg='.$msg.'&flg='.$flg;
	echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
	}
	else 
	{
	$flg=1;
	$msg= "Error deleting record: " . $conn->error;
	$redirectUrl=ADMIN_URL.'resource_hubs.php?msg='.$msg.'&flg='.$flg;
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
        <h1><small>Welcome to NVE CMS</small></h1>
        <ul class="page-breadcrumb breadcrumb">
          <li> <a href="<?php echo ADMIN_URL; ?>dashboard.php">Home</a><i class="fa fa-circle"></i> </li>
          <li class="active"> Dashboard </li>
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
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">Resource Hub</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
           
            <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-body">
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Resource Title</label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <input type="text" name="rtitle" id="rtitle" class="form-control" placeholder="Enter text" >
                                        <input type="hidden" name="id" id="id" class="form-control" placeholder="Enter id" />
                                      </div>
                                     </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Resource Subject</label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <input type="text" name="rsubject" id="rsubject" class="form-control" placeholder="Enter text" >
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Resource Description</label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                      <textarea  name="rdescription" id="rdescription" class="form-control" placeholder="Enter text" ></textarea>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Key Stage</label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <input type="text" name="rstage" id="rstage" class="form-control" placeholder="Enter text" >
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Resource Url</label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <input type="text" name="rurl" id="rurl" class="form-control" placeholder="Enter text" >
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Resource File</label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <input type="file" name="rfile" id="rfile" class="form-control" placeholder="Enter text" >
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Registration</label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <select class="form-control" name="role" id="role">
                                          <option value="">Select Registration</option>
                                          <option value="Yes">Yes</option>
                                          <option value="No">No</option>
                                     </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">NVE</label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <input type="text" name="nve" id="nve" class="form-control" placeholder="Enter TinyURL" >
                                        
                                      </div><br>
                                      <button type="button" id="gurl"  class="btn green">Generate TinyURL </button>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Date Added</label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <input type="date" name="create_date" id="create_date" class="form-control" placeholder="Enter text" >
                                      </div>
                                    </div>
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
          </div>
          <!-- END EXAMPLE TABLE PORTLET--> 
        </div>
      </div>
      <!-- END PAGE CONTENT INNER --> 
    </div>
  </div>
  <!-- END PAGE CONTENT --> 
</div>
<script src="newjs/jquery.min.js" type="text/javascript"></script> 
<script type="text/javascript"> 
      $(document).ready( function() {       
		setTimeout('$("#alert_msg").hide()',3000);
				
			$("#add_new").click(function(){
				var empty='';
				$("#id").val(empty);
				$("#rtitle").val(empty);
				$("#rsubject").val(empty);
				$("#rdescription").val(empty);
				$("#rstage").val(empty);
				$("#rfile").val(empty);
				$("#rurl").val(empty);
				$("#role").val(empty);
				$("#nve").val(empty);
				$("#create_date").val(empty);				
				});
      });
function check(id){

try{
		//alert(id);
		$.ajax({
						type : "POST",
						url : "<?php echo ADMIN_URL; ?>ajax/resourse_hub_ajax.php",
						dataType : "json", 
						data : "id="+id,
						success : function(data) {						
							//alert(data.flag);
							try{
								
								 $('#draggable').modal('show');
								 $("#id").val(data.id);		
								 $("#rtitle").val(data.rtitle);
								 $("#rsubject").val(data.rsubject);	
								 $("#rdescription").val(data.rdescription);	
								 $("#rstage").val(data.rstage);	
								 $("#rfile").val(data.rfile);
								 $("#rurl").val(data.rurl);	
								 $("#role").val(data.role);	
								 $("#nve").val(data.nve);	
								 $("#create_date").val(data.create_date);						
								
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
  }, 5000);
 
}


$(document).ready( function() {       
			
			$("#gurl").click(function(){
				var url=$("#rurl").val();
			let linkRequest = {
			  destination: url,
			  domain: { fullName: "rebrand.ly" }
			  //, slashtag: "A_NEW_SLASHTAG"
			  //, title: "Rebrandly YouTube channel"
			}
			
			let requestHeaders = {
			  "Content-Type": "application/json",
			  "apikey": "ca690d9f28a74430abdd45c8a52e91e1"
			  //"workspace": "YOUR_WORKSPACE_ID"
			}
			
			$.ajax({
			  url: "https://api.rebrandly.com/v1/links",
			  type: "post",
			  data: JSON.stringify(linkRequest),
			  headers: requestHeaders,
			  dataType: "json",
			  success: (link) => {
				//console.log(`Long URL was ${link.destination}, short URL is ${link.shortUrl}`);
				$("#nve").val(link.shortUrl);
			  }
			});
			});
			
 });


	  
</script>
<!-- END PAGE CONTAINER -->
<?php include "footer.php" ?>
