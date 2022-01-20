<?php
include 'conn.php';


if (isset($_REQUEST['submit'])) {
    // Edit resources within resource hub.
if ($_REQUEST['id'] != '') { //call the resource ID.
    $id = mysqli_real_escape_string($conn, $_REQUEST['id']);
    $rtitle = mysqli_real_escape_string($conn, $_REQUEST['rtitle']);
    $rsubject = mysqli_real_escape_string($conn, $_REQUEST['rsubject']);
    $rdescription = mysqli_real_escape_string($conn, $_REQUEST['rdescription']);
    $rstage = mysqli_real_escape_string($conn, $_REQUEST['rstage']);
    $rurl = mysqli_real_escape_string($conn, $_REQUEST['rurl']);
    $register = mysqli_real_escape_string($conn, $_REQUEST['register']);
    $nve = mysqli_real_escape_string($conn, $_REQUEST['nve']);
    $create_date = mysqli_real_escape_string($conn, $_REQUEST['create_date']);
    $user_role = mysqli_real_escape_string($conn, $_REQUEST['user_role']);
    if (!empty($_FILES["rfile"]["name"])) {
        $rand = rand(1, 999999);
        $target_dir = "resource/";
        $target_file = $rand . basename($_FILES["rfile"]["name"]);
        if (move_uploaded_file($_FILES["rfile"]["tmp_name"], $target_dir . $target_file)) {
            $msg = "The file " . basename($_FILES["rfile"]["name"]) . " has been uploaded.";
        } else {
            $msg = "Sorry, there was an error uploading your file.";
        }
    } else {
        $target_file = $_REQUEST['rfile'];
    }
    $sql3 = "SELECT `rtitle` FROM resource_hub WHERE rtitle='{$rtitle}'"; //checking with the database to see if title is there. EDITING a resource
    $result = mysqli_query($conn, $sql3) or die("Query unsuccessful");
    if (mysqli_num_rows($result) > 1) {
        $name_error = "Sorry... Title already exists";
    } else {
        $sql = "UPDATE `resource_hub` SET `rtitle`='" . $rtitle . "',`rsubject`='" . $rsubject . "',`rdescription`='" . $rdescription . "',`rfile`='" . $target_file . "',`rstage`='" . $rstage . "',`rurl`='" . $rurl . "',`register`='" . $register . "',`nve`='" . $nve . "',`user_role`='" . $user_role . "',`create_date`='" . $create_date . "' WHERE `id`='".$_REQUEST['id']."'";
        if ($conn->query($sql) === true) {
            $msg = "Record updated successfully";
            $flg = 0;
            $redirectUrl = ADMIN_URL . 'resource_hub.php?msg=' . $msg . '&flg=' . $flg;
            echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
        } else {
            $flg = 1;
            $msg = "Error:" . $sql . "<br>" . $conn->error;
            $redirectUrl = ADMIN_URL . 'resource_hub.php?msg=' . $msg . '&flg=' . $flg;
            echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
        }
    }
}
    //Add New Resource
    else {
        $id = mysqli_real_escape_string($conn, $_REQUEST['id']);
        $rtitle = mysqli_real_escape_string($conn, $_REQUEST['rtitle']);
        $rsubject = mysqli_real_escape_string($conn, $_REQUEST['rsubject']);
        $rdescription = mysqli_real_escape_string($conn, $_REQUEST['rdescription']);
        $rstage = mysqli_real_escape_string($conn, $_REQUEST['rstage']);
        $rurl = mysqli_real_escape_string($conn, $_REQUEST['rurl']);
        $register = mysqli_real_escape_string($conn, $_REQUEST['register']);
        $nve = mysqli_real_escape_string($conn, $_REQUEST['nve']);
        $create_date = mysqli_real_escape_string($conn, $_REQUEST['create_date']);
        $user_role = mysqli_real_escape_string($conn, $_REQUEST['user_role']);
        if ($_FILES['rfile'] != "") {
            $rand = rand(1, 9999);
            $target_dir = "resource/";
            $target_file = $rand . basename($_FILES["rfile"]["name"]);
            if (move_uploaded_file($_FILES["rfile"]["tmp_name"], $target_dir . $target_file)) {
                $msg = "The file " . basename($_FILES["rfile"]["name"]) . " has been uploaded.";
            } else {
                $msg = "Sorry, there was an error uploading your file.";
            }
        }
        $sql3 = "SELECT `rtitle` FROM resource_hub WHERE rtitle='{$rtitle}'"; // also if Adding a resource you cannot have the same title
        $result = mysqli_query($conn, $sql3) or die("Query unsuccessful");
        if (mysqli_num_rows($result) > 0) {
            $name_error = "Title already exits, please re-name the resource";
        } else {
            $sql = "INSERT INTO `resource_hub`(`rtitle`,`rsubject`,`rdescription`,`rfile`,`rstage`,`rurl`,`register`,`nve`,`user_role`,`create_date`) VALUES ('" . $rtitle . "','" . $rsubject . "','" . $rdescription . "','" . $target_file . "','" . $rstage . "','" . $rurl . "','" . $register . "','" . $nve . "','" . $user_role . "','" . $create_date . "')";
            if ($conn->query($sql) === true) {
                $flg = 0;
                $msg = "New record created successfully";
                $redirectUrl = ADMIN_URL . 'resource_hub.php?msg=' . $msg . '&flg=' . $flg;
                echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
            } else {
                $flg = 1;
                $msg = "Error:" . $sql . "<br>" . $conn->error;
                $redirectUrl = ADMIN_URL . 'resource_hub.php?msg=' . $msg . '&flg=' . $flg;
                echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
            }
        }
    }
}
//Delete resource
if (isset($_REQUEST['delete'])) {
    $sql = "DELETE FROM `resource_hub` WHERE `id`='".$_REQUEST['delete']."'";
    $result = $conn->query($sql);
    if ($conn->query($sql) === true) {
        $flg = 0;
        $msg = "Record deleted successfully";
        $redirectUrl = ADMIN_URL . 'resource_hub.php?msg=' . $msg . '&flg=' . $flg;
        echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
    } else {
        $flg = 1;
        $msg = "Error deleting record: " . $conn->error;
        $redirectUrl = ADMIN_URL . 'resource_hubs.php?msg=' . $msg . '&flg=' . $flg;
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
          <li class="active"> Resource Hub </li>
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
                  class="caption-subject font-green-sharp bold uppercase">Resource Hub</span></div>
              <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="javascript:;" class="reload">
                </a> <a href="javascript:;" class="remove"> </a> </div>
            </div>
            <div>
              <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
              <div class="col-md-11 col-sm-11 col-xs-11" style="border:none !important">
                <a href="#draggable" id="add_new" class="btn btn-sm blue" data-toggle="modal" title="ADD NEW">+ Add
                  New</a>
              </div>
              <?php } ?>
              <br>
              <br>
              <!-- Message if resource has been successfull added -->
              <div class="row number-stats">
                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important">
                  <?php if (isset($_REQUEST['msg'])) 
                  {
                          if ($_REQUEST['flg'] != '1') 
                          {
                              echo '<div class="alert alert-success" id="alert_msg">';
                              echo '<button class="close" data-close="alert"></button>';
                          } else {
                              echo '<div class="alert alert-reception" id="alert_msg">';
                              echo '<button class="close" data-close="alert"></button>';
                          }
                  } ?>
                  <span>
                    <?php if (isset($_REQUEST['msg'])) 
                          {
                              echo $_REQUEST['msg'];
                          } ?>
                  </span>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12" style="border:none !important; text-align:center">
                  <div <?php if (isset($name_error)) : ?> class="alert alert-reception" id="name_error"
                    <?php endif ?>>
                    <?php if (isset($name_error)) :?>
                    <span>
                      <?php echo $name_error; ?>
                    </span>
                    <button class="close" data-close="alert" id="btnDone"></button>
                    <?php endif ?>
                  </div>
                </div>
                <div class="portlet-body">
                  <table class="table table-striped table-hover table-bordered" id="sample_editable_1"
                    style="line-break: anywhere;font-size:13px !important">
                    <thead>
                      <tr>
                        <th> ID </th>
                        <th> Title </th>
                        <th> Subject </th>
                        <th> Key Stage </th>
                        <th> Description </th>
                        <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                        <th> URL </th>
                        <?php } ?>
                        <th> Registration </th>
                        <th> NVE Link </th>
                        <th> Files </th>
                        <th> Uploaded </th>
                        <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                        <th> Action </th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
        $sql3 = "SELECT * FROM `resource_hub` ORDER BY `id` ASC";
        $result3 = $conn->query($sql3);
        $id = 1;
        while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
            ?>
                      <tr>
                        <td>
                          <?php echo $id; ?>
                        </td>
                        <td>
                          <?php echo $row3['rtitle']; ?>
                        </td>
                        <td>
                          <?php echo $row3['rsubject']; ?>
                        </td>
                        <td>
                          <?php echo $row3['rstage']; ?>
                        </td>
                        <td>
                          <?php echo $row3['rdescription']; ?>
                        </td>
                        <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                        <td>
                          <?php echo $row3['rurl']; ?>
                        </td>
                        <?php } ?>
                        <td>
                          <?php echo $row3['register']; ?>
                        </td>
                        <td><a href="https://<?php echo $row3['nve']; ?>" target="blank">
                            <?php echo $row3['nve']; ?>
                          </a></td>
                        <td><a
                            href="http://localhost:8888/NVECMS/Nve/templates/admin3/resources/<?php echo $row3['rfile']; ?>"
                            download>
                            <?php echo $row3['rfile']; ?>
                          </a></td>
                        <td>
                          <?php echo $row3['create_date']; ?>
                        </td>
                        <?php if ($_SESSION['role'] == 1 || $_SESSION['role'] == 3) { ?>
                        <td>
                          <?php if ($_SESSION['role'] == 3) {?> <?php if ($_SESSION['id'] == $row3['user_role']) { ?>
                          <a onClick="check('<?php echo $row3['id']; ?>')" href="javascript:void(0);">
                          <i class="fa fa-edit" title="Edit"></i> </a> | <a class="delete_resource" data-emp-id="<?php echo $row3["id"]; ?>" href="javascript:void(0)">
                          <i class="fa fa-trash" title="Delete" style="color:#F00 !important"></i></a>
                          <?php } ?>

                          <?php if ($row3['user_role'] == 1 || $_SESSION['id'] != $row3['user_role']) { ?><a
                            onClick="return false" href="javascript:void(0);"><i class="fa fa-edit" title="Edit"></i>
                          </a> | <a><i class="fa fa-trash" title="Delete" style="color:#F00 !important"></i> </a>
                          <?php } ?>
                          <?php } ?>

                          <?php if ($_SESSION['role'] == 1) {?>
                          <?php if ($_SESSION['role'] == 1) { ?><a onClick="check('<?php echo $row3['id']; ?>')"
                            href="javascript:void(0);"><i class="fa fa-edit" title="Edit"></i> </a> | <a
                            class="delete_resource" data-emp-id="<?php echo $row3["id"]; ?>"
                            href="javascript:void(0)"><i class="fa fa-trash" title="Delete"
                              style="color:#F00 !important"></i> </a>
                          <?php } ?>
                          <?php } ?>
                        </td>
                        <?php } ?>

                      </tr>
                      <?php $id++;
} ?>
                    </tbody>
                  </table>


                  <div class="modal fade draggable-modal" id="draggable" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog" id="model_header">
                      <div class="modal-content">
                        <div class="modal-body">
                          <div class="portlet box blue-hoki">
                            <div class="portlet-title">
                              <div class="caption"> <i class="fa fa-gift"></i>Manage Resource </div>
                            </div>
                            <div class="portlet-body form">
                              <!-- BEGIN FORM-->
                              <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-body">
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Resource Title<span
                                        style="color: red">&#42;</span></label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <input required type="text" name="rtitle" id="rtitle" class="form-control"
                                          placeholder="Enter text">
                                        <input type="hidden" name="id" id="id" class="form-control"
                                          placeholder="Enter id" />
                                        <input type="hidden" name="user_role" id="user_role"
                                          value="<?php echo $_SESSION['id']; ?>" class="form-control"
                                          placeholder="Enter id" />
                                      </div>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Resource Subject<span
                                        style="color: red">&#42;</span></label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <select required class="form-control" name="rsubject" id="rsubject">
                                          <option value="">Select Subject</option>
                                          <option value="English">English</option>
                                          <option value="Maths">Maths</option>
                                          <option value="Science">Science</option>
                                          <option value="Biology">Biology</option>
                                          <option value="Chemistry">Chemistry</option>
                                          <option value="Physics">Physics</option>
                                          <option value="Algebra">Algebra</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Resource Description</label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <textarea name="rdescription" id="rdescription" class="form-control"
                                          placeholder="Enter text"></textarea>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Key Stage<span
                                        style="color: red">&#42;</span></label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <select required class="form-control" name="rstage" id="rstage">
                                          <option value="">Select Key Stage</option>
                                          <option value="Early years foundation stage to Key stage 2">Early years
                                            foundation stage to Key stage 2</option>
                                          <option value="Key Stage 1">Key Stage 1</option>
                                          <option value="Key Stage 2">Key Stage 2</option>
                                          <option value="Key Stage 3">Key Stage 3</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Resource Url</label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <input type="text" name="rurl" id="rurl" class="form-control"
                                          placeholder="Enter text">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Resource File</label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <input type="file" name="rfile" id="rfile" class="form-control"
                                          placeholder="Enter text">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Registration<span
                                        style="color: red">&#42;</span></label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <select required class="form-control" name="register" id="register">
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
                                        <input type="text" name="nve" id="nve" class="form-control"
                                          placeholder="Enter TinyURL">

                                      </div><br>
                                      <button type="button" id="gurl" class="btn green">Generate NVE link </button>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-4 control-label">Date Added<span
                                        style="color: red">&#42;</span></label>
                                    <div class="col-md-7">
                                      <div class="input-group">
                                        <input required type="date" name="create_date" id="create_date"
                                          class="form-control" placeholder="Enter text">
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
                              <!-- END FORM-->
                            </div>
                          </div>
                        </div>

                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal-dialog -->
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
  </div>
  <script src="newjs/jquery.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      setTimeout('$("#alert_msg").hide()', 3000);
      setTimeout('$("#name_error").hide()', 3000);

      $("#add_new").click(function () {
        var empty = '';
        $("#id").val(empty);
        $("#rtitle").val(empty);
        $("#rsubject").val(empty);
        $("#rdescription").val(empty);
        $("#rstage").val(empty);
        $("#rfile").val(empty);
        $("#rurl").val(empty);
        $("#register").val(empty);
        $("#nve").val(empty);
        $("#create_date").val(empty);
      });
    });

    function check(id) {

      try {
        //alert(id);
        $.ajax({
          type: "POST",
          url: "<?php echo ADMIN_URL; ?>ajax/resourse_hub_ajax.php",
          dataType: "json",
          data: "id=" + id,
          success: function (data) {
            //alert(data.flag);
            try {

              $('#draggable').modal('show');
              $("#id").val(data.id);
              $("#rtitle").val(data.rtitle);
              $("#rsubject").val(data.rsubject);
              $("#rdescription").val(data.rdescription);
              $("#rstage").val(data.rstage);
              $("#rfile").val(data.rfile);
              $("#rurl").val(data.rurl);
              $("#register").val(data.register);
              $("#nve").val(data.nve);
              $("#create_date").val(data.create_date);

            } catch (err) {
              alert(err.message);
            }

          }
        });
      } catch (err) {
        alert(err.message);
      }
      setInterval(function () {
        $('#error_msg').html('');
      }, 5000);

    }

    //shortened URL API using jQuery
    $(document).ready(function () {

      $("#gurl").click(function () {
        var url = $("#rurl").val();
        let linkRequest = {
          destination: url,
          domain: {
            fullName: "rebrand.ly"
          }
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
    $(document).ready(function () {
      $("#btnDone").click(function () {
        $(this).dialog('close');
      });
    });
  </script>
  <!-- END PAGE CONTAINER -->
  <?php include "footer.php" ?>