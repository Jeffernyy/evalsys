<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=7">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

</html>

<?php
include "db_connect.php";
if (isset($_GET['deleteId'])) {
  $id = $_GET['deleteId'];
  $sql = "DELETE FROM `deduction_list` WHERE id=$id";
  $res = mysqli_query($conn, $sql);
  if ($res) {
    echo '
    <script>
      swal({
        title: "Good Job!",
        text: "Data deleted successfully",
        icon: "success",
        buttons: ["Close", "Aww Yiss!"]
      }).then(() => {
        window.location.href = "index.php?page=deduction_list";
      })
    </script>
    ';
  }
}
?>