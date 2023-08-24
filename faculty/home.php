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

<div class="col-lg-12">
  <div class="row">
    <div class="col-md-3">
      <div style="border-top: 5px solid #17a2b8; border-left: 0px;" class="callout callout-info">
        <div class="list-group" id="class-list">
          <img src="assets/uploads/<?php echo $_SESSION['login_avatar'] ?>" alt=""
            style="height:200px; width:200px; margin:0 auto; object-fit:cover; padding:2px; border: 3px solid #adb5bd; border-radius:10%;">
          <h5 style="text-align:center; margin-bottom:0px;">
            <?php echo ucwords($_SESSION['login_firstname']) ?>&nbsp;
            <?php echo ucwords($_SESSION['login_lastname']) ?>
          </h5>
          <h6 style="text-align:center; margin-bottom:0px; color:gray;">Faculty</h6><br>
          <!--<a href="ajax.php?action=logout"> Logout</a>-->

          <ul class="list-group list-group-unbordered mb-3">
            <?php
            $query = "SELECT COUNT(class_id) FROM curr_list where faculty_id = {$_SESSION['login_id']} and academic_id = {$_SESSION['academic']['id']} ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $class_count = $row['COUNT(class_id)'];
            ?>
            <li class="list-group-item">
              <b>Handled Course</b> <a class="float-right">
                <?php echo $class_count ?>
              </a>
            </li>
          </ul>

          <a class="btn btn-primary btn-block" href="javascript:void(0)" id="manage_profile"><b>Manage Profile</b></a>

        </div>
      </div>
    </div>
    <div class="col-md-9">
      <div class="callout callout-info">
        <h5><b>Academic Year:
            <?php echo $_SESSION['academic']['year'] . ' ' . (ordinal_suffix1($_SESSION['academic']['semester'])) ?>
            Semester
          </b></h5>
        <h6><b>Evaluation Status:
            <?php echo $astat[$_SESSION['academic']['status']] ?>
          </b></h6>
      </div>
    </div>
  </div>
  <script>
    $('#manage_profile').click(function () {
      uni_modal('Manage Account', 'manage_user.php?id=<?php echo $_SESSION['login_id'] ?>')
    })
  </script>