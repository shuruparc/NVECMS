<?php
include 'conn.php';
if (isset($_REQUEST['empid'])) {
   $sql = "DELETE FROM `resource_hub` WHERE `id`= '" . $_REQUEST['empid'] . "'";
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
