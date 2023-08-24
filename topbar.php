<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-primary navbar-dark" style="background: #212979;">
  <!--style="backgound-color: darkblue; style="background: #212979;""-->
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link nav-item-mobile" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="logo-item"> <!--style="margin-top:5px;" -->
      <img src="ntclogo.png" alt="" class="logo-image"><!--style="height:65px; width:65px; margin:0 auto;"-->
      <img src="ntcbg.png" alt="" class="logo-image-mobile">
    </li>
    <li class="title-item"> <!--style="margin-top:10px;" --> <!-- -->
      <a class="nav-link text-white" href="./" role="button" style="font-family: Arial, Helvetica, sans-serif;">
        <h3>NORTHLINK TECHNOLOGICAL COLLEGE</h3>
      </a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">

    <!-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>-->
    <li class="nav-item dropdown">
      <!--<a class="nav-link" href="ajax.php?action=logout"><i class="fa"></i> Logout</a>-->
      <a class="nav-link" data-toggle="dropdown" aria-expanded="true" href="javascript:void(0)">
        <span>
          <div class="d-felx badge-pill">
            <span class=""><img src="assets/uploads/<?php echo $_SESSION['login_avatar'] ?>" alt=""
                class="user-img border "></span>

            <span class="fa fa-angle-down ml-2"></span>
          </div>
        </span>
      </a>
      <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
        <a class="dropdown-item" href="javascript:void(0)" id="manage_account"><i class="fa fa-cog"></i> Manage
          Account</a>
        <a class="dropdown-item" href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Logout</a>
      </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
<script>
  $('#manage_account').click(function () {
    uni_modal('Manage Account', 'manage_user.php?id=<?php echo $_SESSION['login_id'] ?>')
  })
</script>

<style>
  .user-img {
    border-radius: 50%;
    height: 25px;
    width: 25px;
    object-fit: cover;
  }

  .logo-item {
    margin-top: 5px;
  }

  /* Logo image styling */
  .logo-image {
    height: 65px;
    width: 65px;
    margin: 0 auto;
  }

  /* Title item styling */
  .title-item {
    margin-top: 10px;

  }

  .logo-image-mobile {
    display: none;
  }

  .nav-item-mobile {
    display: none;
  }

  /* Responsive styles */
  @media only screen and (max-width: 600px) {
    .logo-image {
      display: none;
    }

    .logo-image-mobile {
      display: inline-block;
      height: 50px;
      width: 100px;
    }

    .title-item {
      display: none;
    }

    .logo-item {
      margin-right: 0;
    }

    .nav-item-mobile {
      display: block;
    }
  }

  @media only screen and (max-width: 400px) {
    .logo-image {
      display: none;
    }

    .logo-image-mobile {
      display: inline-block;
      height: 40px;
      width: 80px;
    }

    .title-item {
      display: none;
    }

    .logo-item {
      margin-right: 0;
    }

    .nav-item-mobile {
      display: block;
    }
  }
</style>