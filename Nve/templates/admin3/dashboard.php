<?php
include 'conn.php';
include "header.php"; ?>

<!-- Dashboard For Admin An Editor Start -->
<?php if ($_SESSION['role'] == 3 || $_SESSION['role'] == 1) { ?>
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
                <!-- Checking user to prompt its name As Admin Or Editor -->
                <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> <span class="caption-subject font-green-sharp bold uppercase">
                    <?php if ($_SESSION['role'] == "1") {
                      echo "Admin";
                    }
                    if ($_SESSION['role'] == "3") {
                      echo "Editor";
                    } ?> Board</span></div>
                <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div> <!-- assets/admin/pages/scripts/table-editable -->
              </div>
              <div class="portlet-body">
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1" style="line-break: anywhere;"> <!-- assets/admin/pages/scripts/table-editable -->
                  <thead>
                    <tr>
                      <th> ID</th>
                      <th> Title</th>
                      <th> Subject </th>
                      <th> Description</th>
                      <th> Resource File</th>
                      <th> Key Stage</th>
                      <th> Document</th>
                      <th> Registration</th>
                      <th> NVE</th>
                      <th> Uploaded</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Fetching Data From Database to be ordered by the date resource was created.
                    $sql3 = "SELECT * FROM `resource_hub` ORDER BY `create_date` DESC"; //query inserted into myPHPAdmin
                    $result3 = $conn->query($sql3);
                    $id = 1;
                    while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                    ?>
                      <tr>
                        <td><?php echo $id; ?></td> <!-- id=1 calling from the loop and incrementing by 1 and printing the resources by date last uploaded -->
                        <td><?php echo $row3['rtitle']; ?></td>
                        <td><?php echo $row3['rsubject']; ?></td>
                        <td><?php echo $row3['rdescription']; ?></td>
                        <td><?php echo $row3['rfile']; ?></td>
                        <td><?php echo $row3['rstage']; ?></td>
                        <td><?php echo $row3['rurl']; ?></td>
                        <td><?php echo $row3['register']; ?></td>
                        <td><?php echo $row3['nve']; ?></td>
                        <td><?php echo $row3['create_date']; ?></td>

                      </tr>
                    <?php
                      $id++;
                    } ?>
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
<?php } ?>
<!-- Dashboard For Admin An Editor Ends -->

<script src="newjs/jquery.min.js" type="text/javascript"></script>
<!-- END PAGE CONTAINER -->
<?php include "footer.php" ?>