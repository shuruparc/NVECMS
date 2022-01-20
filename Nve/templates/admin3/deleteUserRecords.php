<?php
include 'conn.php';
if (isset($_REQUEST['empid'])) {
    $sql = "DELETE FROM `users` WHERE `id`='" . $_REQUEST['empid'] . "'";
  $result = $conn->query($sql);
  if ($conn->query($sql) === true) {
    $flg = 0;
    $msg = "Record deleted successfully";
    $redirectUrl = ADMIN_URL . 'user_master.php?msg=' . $msg . '&flg=' . $flg;
    echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
  } else {
    $flg = 1;
    $msg = "Error deleting record: " . $conn->error;
    $redirectUrl = ADMIN_URL . 'user_master?msg=' . $msg . '&flg=' . $flg;
    echo "<script type=\"text/javascript\">  window.location.href='$redirectUrl'; </script>";
  }
}
?>
