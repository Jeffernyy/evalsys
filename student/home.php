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
$astat = array("Not Yet Started", "Started", "Closed");
?>

<div class="col-lg-12">
  <div class="row">
    <div class="col-md-3">
      <div style="border-top: 5px solid #17a2b8; border-left: 0px;" class="callout callout-info">
        <div class="list-group" id="class-list">
          <?php
          $query = "SELECT * ,concat(program,' ',year) as class FROM class_l WHERE class_id = '{$_SESSION['login_class_id']}'";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_assoc($result);
          ?>
          <img src="assets/uploads/<?php echo $_SESSION['login_avatar'] ?>" alt=""
            style="height:200px; width:200px; margin:0 auto; object-fit:cover; padding:2px; border: 3px solid #adb5bd; border-radius:10%;">
          <h5 style="text-align:center; margin-bottom:0px;">
            <?php echo ucwords($_SESSION['login_firstname']) ?>&nbsp;
            <?php echo ucwords($_SESSION['login_lastname']) ?>
          </h5>
          <h6 style="text-align:center; margin-bottom:0px; color:gray;">
            <?php echo ucwords($row['class']) ?>
          </h6><br>

          <ul class="list-group list-group-unbordered mb-3">
            <?php
            $query = "SELECT COUNT(subject_id) FROM curr_list where class_id = {$_SESSION['login_class_id']} and academic_id = {$_SESSION['academic']['id']} ";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $class_count = $row['COUNT(subject_id)'];

            $query2 = "SELECT COUNT(subject_id) FROM evaluation_list where student_id = {$_SESSION['login_id']} and class_id = {$_SESSION['login_class_id']} and academic_id = {$_SESSION['academic']['id']} ";
            $result2 = mysqli_query($conn, $query2);
            $row2 = mysqli_fetch_assoc($result2);
            $class_count2 = $row2['COUNT(subject_id)'];
            ?>
            <li class="list-group-item">
              <b>Course Enrolled</b>
              <p class="float-right">
                <?php echo $class_count ?>
              </p>
            </li>
            <li class="list-group-item">
              <b>Faculty Evaluated</b>
              <p class="float-right">
                <?php echo $class_count2 ?>
              </p>
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

</div>
<script>
  $('#manage_profile').click(function () {
    uni_modal('Manage Account', 'manage_user.php?id=<?php echo $_SESSION['login_id'] ?>')
  })
</script>