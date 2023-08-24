<?php include('db_connect.php');
function ordinal_suffix1($num)
{
  $num = $num % 100; // protect against large numbers
  if ($num < 11 || $num > 13) {
    switch ($num % 10) {
      case 1:
        return $num . 'st';
      case 2:
        return $num . 'nd';
      case 3:
        return $num . 'rd';
    }
  }
  return $num . 'th';
}
$astat = array("Not Yet Started", "On-going", "Closed");
?>

<div class="container">
  <div class="row d-flex align-items-center justify-content-center">
    <div class="col-md-6">
      <div style="border-top: 5px solid #17a2b8; border-left: 0px;" class="callout callout-info">
        <div class="list-group" id="class-list">
          <img src="assets/uploads/<?php echo $_SESSION['login_avatar'] ?>" alt=""
            style="height:200px; width:200px; margin:30px auto 0; object-fit:cover; padding:2px; border: 3px solid #adb5bd; border-radius:10%;">
          <h5 style="text-align:center; margin: 10px 0 0;">
            <?php echo ucwords($_SESSION['login_firstname']) ?>&nbsp;
            <?php echo ucwords($_SESSION['login_lastname']) ?>
          </h5>
          <h6 style="text-align:center; margin-bottom:0px; color:gray;">Human Resources</h6><br>
          <ul class="list-group list-group-unbordered mb-3">
            <?php
            $query = "SELECT COUNT(faculty_id) FROM visor_eval_list where visor_id = {$_SESSION['login_id']} and academic_id = {$_SESSION['academic']['id']} ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $faculty_count = $row['COUNT(faculty_id)'];
            ?>
          </ul>
          <a class="btn btn-primary btn-block text-light text-decoration-none" href="javascript:void(0)"
            id="manage_profile"><b>Manage
              Profile</b></a>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $('#manage_profile').click(function () {
    uni_modal('Manage Account', 'manage_user.php?id=<?php echo $_SESSION['login_id'] ?>')
  })
</script>