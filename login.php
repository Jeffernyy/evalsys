<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');
ob_start();
// if(!isset($_SESSION['system'])){

$system = $conn->query("SELECT * FROM system_settings")->fetch_array(); // //  
foreach ($system as $k => $v) {
  $_SESSION['system'][$k] = $v;
}
// }
ob_end_flush();
?>
<?php
if (isset($_SESSION['login_id']))
  header("location:index.php?page=home");

?>
<?php include 'header.php' ?>

<body style="background-image:url('jennyweb.png'); background-size:cover;" class="hold-transition login-page">
  <!--background-image:url('ntclog1.jpg'); background-size:cover; background-color: #212979;-->

  <div class="login-box">
    <div class="login-logo">
      <image src="ntcbg.png" style="height: 150px; width: 300px; text-align: center;">
        <a href="#" class="text-white"></a>
        <h2 style="color: white;"><b>PES - NTC</b></h2> <!--<?php echo $_SESSION['system']['name'] ?> -->
    </div>

    <!-- /.login-logo -->
    <div style="background-color: rgba(255, 255, 255, 0.15)" class="card">
      <!--background-color: rgba(255, 255, 255, 0.15);-->
      <div style="background-color: rgba(255, 255, 255, 0.15)" class="card-body login-card-body">
        <!--background-color: rgba(255, 255, 255, 0.15);-->
        <form action="" id="login-form">
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" required placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" required placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="form-group mb-3">
            <label style="color:black;" for="">Login As</label>
            <select name="login" id="" class="custom-select custom-select-sm">
              <option value="1">Admin</option>
              <option value="2">Faculty</option>
              <option value="3">Student</option>
              <option value="4">Supervisor</option>
              <option value="5">Human Resources</option>
            </select>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label style="color:black;" for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
  <script>
    $(document).ready(function () {
      $('#login-form').submit(function (e) {
        e.preventDefault()
        start_load()
        if ($(this).find('.alert-danger').length > 0)
          $(this).find('.alert-danger').remove();
        $.ajax({
          url: 'ajax.php?action=login',
          method: 'POST',
          data: $(this).serialize(),
          error: err => {
            console.log(err)
            end_load();

          },
          success: function (resp) {
            if (resp == 1) {
              location.href = 'index.php?page=home';
            } else {
              $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
              end_load();
            }
          }
        })
      })
    })
  </script>
  <?php include 'footer.php' ?>

</body>

</html>