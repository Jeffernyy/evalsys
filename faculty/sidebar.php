<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="dropdown">
    <?php if (isset($_SESSION['login_id'])): ?>
      <a class="brand-link" href=""><br><br>
        <h3 class="text-center p-0 m-0"><b> </b></h3>

      </a>
    <?php endif; ?>
  </div>
  <div class="sidebar ">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
        data-accordion="false">
        <li class="nav-item dropdown">
          <a href="./" class="nav-link nav-home">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link nav-evaluate">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Evaluate
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.php?page=evaluate" class="nav-link nav-criteria_list tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Peer Evaluation</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=self_evaluation" class="nav-link tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Self Evaluation</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link nav-res">
            <i class="nav-icon fas fa-th-list"></i>
            <p>
              Result
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.php?page=peers_evaluation" class="nav-link nav-peers_evaluation tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Peer Evaluation Result</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=self_evaluation_result" class="nav-link nav-self_evaluation_result tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Self Evaluation Result</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link nav-evaluation_result">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Evaluation Report
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.php?page=result" class="nav-link nav-result tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Class </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=report" class="nav-link nav-report tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Supervisor </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=peer_report" class="nav-link nav-peer_report tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Peer </p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link nav-personal_data_sheet">
            <i class="nav-icon fas fa-bookmark"></i>
            <p>
              Personal Data Sheet
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.php?page=manage_employee_filing" class="nav-link nav-employee_profiling tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Employee Filing</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>
<script>
  $(document).ready(function () {
    var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
    if (s != '')
      page = page + '_' + s;
    if ($('.nav-link.nav-' + page).length > 0) {
      $('.nav-link.nav-' + page).addClass('active')
      if ($('.nav-link.nav-' + page).hasClass('tree-item') == true) {
        $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active')
        $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open')
      }
      if ($('.nav-link.nav-' + page).hasClass('nav-is-tree') == true) {
        $('.nav-link.nav-' + page).parent().addClass('menu-open')
      }

    }

  })
</script>