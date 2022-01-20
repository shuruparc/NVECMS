<?php include 'conn.php'; ?>
<?php include "header.php"; ?>
<script type="text/javascript">
   setTimeout(function(){
       location.reload();
   },300000); //page refreshes every 5 minutes to allow for new entries to update the page.
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
          <li> <a href="<?php echo ADMIN_URL; ?>dashboard.php">Home</a><i class="fa fa-circle"></i> </li>
          <li class="active"> Users </li>
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
              <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">System Details </span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            
           <br>
          <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
               
                <thead>
                  <tr>
                    <th style="width:10%">ID</th>
                  	<th style="width:10%">Name</th>
                    <th style="width:10%">Email</th>
                    <th style="width:10%">Browser Type</th>
                    <th style="width:10%">Browser Version</th>
                    <th style="width:10%">Operating System</th>
                    <th style="width:20%">User Resolution</th>
                    <th style="width:10%">Compatibility Mode </th>
                    <th style="width:10%">Cookies</th> 
                    <th style="width:10%">JavaScript</th>
                    <th style="width:10%">Pop Up</th>
                  </tr>
                </thead>
                <tbody> 
                <?php  
		
						 $sql="select * FROM `system_checker` ORDER BY `id` DESC"; 
						 $result=$conn->query($sql) ;
             $id = 1;
						 while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
						 {
							?>          
                   <tr style="line-break: auto;" >
                   <td><?php echo $id; ?></td>
                   <td><?php echo $row['name'] ;?></td>
                   <td><?php echo $row['email'] ;?></td>
                   <td><?php echo $row['browser_type'] ;?></td>
                   <td><?php echo $row['browser_version'] ;?></td>
                   <td><?php echo $row['operating_system'] ;?></td>
                   <td><?php echo $row['user_resolution'] ;?></td>
                   <td><?php echo $row['compatibility_mode'] ;?></td>
                   <td><?php echo $row['cookies'] ;?></td>
                   <td><?php echo $row['js'] ;?></td>
                   <td><?php echo $row['formPopups'] ;?></td>
                                    
                  </tr>
                  <?php $id++;
						 }
						 ?>

                
                </tbody>
              </table>
            
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
<script>
function myFunction() {
  alert("Your System Is Scanning");
}
</script>
<?php include "footer.php" ?>