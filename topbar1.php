<style>
  .user-img {
    border-radius: 50%;
    height: 25px;
    width: 25px;
    object-fit: cover;
  }

  .container {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
  }

  .collapse {
    display: none;
  }

  @media (min-width: 768px) {
    .container {
      width: 750px;
    }
  }

  @media (min-width: 992px) {
    .container {
      width: 970px;
    }
  }

  @media (min-width: 1200px) {
    .container {
      width: 1170px;
    }
  }

  .navbar {
    display: none;
    position: relative;
    min-height: 50px;
    margin-bottom: 20px;
    border: 1px solid transparent;
  }

  @media (min-width: 768px) {
    .navbar {
      border-radius: 4px;
    }
  }

  .container>.navbar-header,
  .container-fluid>.navbar-header,
  .container>.navbar-collapse,
  .container-fluid>.navbar-collapse {
    margin-right: -15px;
    margin-left: -15px;
  }

  @media (min-width: 768px) {

    .container>.navbar-header,
    .container-fluid>.navbar-header,
    .container>.navbar-collapse,
    .container-fluid>.navbar-collapse {
      margin-right: 0;
      margin-left: 0;
    }
  }

  @media (min-width: 768px) {

    .navbar>.container .navbar-brand,
    .navbar>.container-fluid .navbar-brand {
      margin-left: -15px;
    }
  }

  @media (min-width: 768px) {
    .navbar-header {
      float: left;
    }
  }

  .navbar-toggle {
    position: relative;
    float: right;
    padding: 9px 10px;
    margin-top: 8px;
    margin-right: 15px;
    margin-bottom: 8px;
    background-color: transparent;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
  }

  .navbar-toggle:focus {
    outline: 0;
  }

  .navbar-toggle .icon-bar {
    display: block;
    width: 22px;
    height: 2px;
    border-radius: 1px;
  }

  .navbar-toggle .icon-bar+.icon-bar {
    margin-top: 4px;
  }

  @media (min-width: 768px) {
    .navbar-toggle {
      display: none;
    }
  }

  .navbar-collapse {
    padding-right: 15px;
    padding-left: 15px;
    overflow-x: visible;
    -webkit-overflow-scrolling: touch;
    border-top: 1px solid transparent;
    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1);
  }

  .navbar-collapse.in {
    overflow-y: auto;
  }

  @media (min-width: 768px) {
    .navbar-collapse {
      width: auto;
      border-top: 0;
      -webkit-box-shadow: none;
      box-shadow: none;
    }

    .navbar-collapse.collapse {
      display: block !important;
      height: auto !important;
      padding-bottom: 0;
      overflow: visible !important;
    }

    .navbar-collapse.in {
      overflow-y: visible;
    }

    .navbar-fixed-top .navbar-collapse,
    .navbar-static-top .navbar-collapse,
    .navbar-fixed-bottom .navbar-collapse {
      padding-right: 0;
      padding-left: 0;
    }
  }

  .navbar-fixed-top .navbar-collapse,
  .navbar-fixed-bottom .navbar-collapse {
    max-height: 340px;
  }

  @media (max-device-width: 480px) and (orientation: landscape) {

    .navbar-fixed-top .navbar-collapse,
    .navbar-fixed-bottom .navbar-collapse {
      max-height: 200px;
    }
  }

  @media (min-width: 768px) {
    .navbar-right .dropdown-menu {
      right: 0;
      left: auto;
    }

    .navbar-right .dropdown-menu-left {
      right: auto;
      left: 0;
    }
  }

  @media (min-width: 768px) {
    .navbar-left {
      float: left !important;
    }

    .navbar-right {
      float: right !important;
      margin-right: -15px;
    }

    .navbar-right~.navbar-right {
      margin-right: 0;
    }
  }

  .nav {
    display: block;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
  }

  .nav>li {
    position: relative;
    display: block;
  }

  .nav>li>a {
    position: relative;
    display: block;
    padding: 10px 15px;
  }

  .nav>li>a:hover,
  .nav>li>a:focus {
    text-decoration: none;
    background-color: #eee;
  }

  .nav>li.disabled>a {
    color: #777;
  }

  .nav>li.disabled>a:hover,
  .nav>li.disabled>a:focus {
    color: #777;
    text-decoration: none;
    cursor: not-allowed;
    background-color: transparent;
  }

  .nav .open>a,
  .nav .open>a:hover,
  .nav .open>a:focus {
    background-color: #eee;
    border-color: #337ab7;
  }

  .nav .nav-divider {
    height: 1px;
    margin: 9px 0;
    overflow: hidden;
    background-color: #e5e5e5;
  }

  .nav>li>a>img {
    max-width: none;
  }

  .navbar-nav {
    margin: 7.5px -15px;
  }

  .navbar-nav>li>a {
    padding-top: 10px;
    padding-bottom: 10px;
    line-height: 20px;
  }

  @media (max-width: 767px) {
    .navbar-nav .open .dropdown-menu {
      position: static;
      float: none;
      width: auto;
      margin-top: 0;
      background-color: transparent;
      border: 0;
      -webkit-box-shadow: none;
      box-shadow: none;
    }

    .navbar-nav .open .dropdown-menu>li>a,
    .navbar-nav .open .dropdown-menu .dropdown-header {
      padding: 5px 15px 5px 25px;
    }

    .navbar-nav .open .dropdown-menu>li>a {
      line-height: 20px;
    }

    .navbar-nav .open .dropdown-menu>li>a:hover,
    .navbar-nav .open .dropdown-menu>li>a:focus {
      background-image: none;
    }
  }

  @media (min-width: 768px) {
    .navbar-nav {
      float: left;
      margin: 0;
    }

    .navbar-nav>li {
      float: left;
    }

    .navbar-nav>li>a {
      padding-top: 15px;
      padding-bottom: 15px;
    }
  }

  .navbar-nav>li>.dropdown-menu {
    margin-top: 0;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }

  .dropdown {
    position: relative;
  }
</style>
<!-- Navbar -->
<nav class="navbar navbar-fixed-top navbar-blue">
  <!-- Left navbar links -->
  <div class="container">
    <div class="collapse navbar-collapse navbar-right">
      <ul class="nav navbar-nav mod-menu">
        <?php if (isset($_SESSION['login_id'])): ?>
          <li class="nav-item">
            <!--<a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>-->
          </li>
        <?php endif; ?>
        <li>
          <a class="nav-link text-white" href="./" role="button">
            <large><b>
                <?php echo $_SESSION['system']['name'] ?>
              </b></large>
          </a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" aria-expanded="true" href="javascript:void(0)">
            <span>
              <div class="d-felx badge-pill">
                <span class=""><img src="assets/uploads/<?php echo $_SESSION['login_avatar'] ?>" alt=""
                    class="user-img border "></span>
                <span><b>
                    <?php echo ucwords($_SESSION['login_firstname']) ?>
                  </b></span>
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
    </div>
  </div>
</nav>
<!-- /.navbar -->
<script>
  $('#manage_account').click(function () {
    uni_modal('Manage Account', 'manage_user.php?id=<?php echo $_SESSION['login_id'] ?>')
  })
</script>