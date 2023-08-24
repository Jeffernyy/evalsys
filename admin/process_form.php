<?php
$employeeId = $_POST['employee_id'];
$checkboxes = $_POST['inputCheckbox'];
$amounts = $_POST['inputAmount'];
include "db_connect.php";
$sql = "INSERT INTO employee_deduction_list (employee_id) VALUES ('$employeeId')";
$result = mysqli_query($conn, $sql);

if ($result) {
  $deductionId = mysqli_insert_id($conn);

  for ($i = 0; $i < count($checkboxes); $i++) {
    $checkbox = $checkboxes[$i];
    $amount = $amounts[$i];
    $sql = "INSERT INTO deduction_details (deduction_id, checkbox_value, amount) VALUES ('$deductionId', '$checkbox', '$amount')";
    mysqli_query($conn, $sql);
  }

  header("Location: success.php");
  exit();
} else {
  echo "Error: " . mysqli_error($conn);
}
?>