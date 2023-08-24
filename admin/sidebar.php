<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="dropdown">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex"><br><br>
      <div class="image" style="margin-top:10px; margin-left:10px;">
      </div>
      <div class="info" style="display: flex; flex-direction: column;">
      </div>
    </div>
  </div>
  <div class="sidebar">
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
        <li class="nav-item dropdown">
          <a href="./index.php?page=questionnaire" class="nav-link nav-questionnaire">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Questionnaires
            </p>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a href="./index.php?page=criteria" class="nav-link nav-criteria">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Evaluation Criteria
            </p>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link nav">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Evaluation Report
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.php?page=report" class="nav-link nav-report tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Class</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=supervisor" class="nav-link nav-supervisor tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Supervisor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=peer" class="nav-link nav-peer tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Peer</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=self_evaluation" class="nav-link nav-self_evaluation tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Self Evaluation</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a href="#" class="nav-link nav">
            <i class="nav-icon fas fa-university"></i>
            <p>
              Academic Settings
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.php?page=subject_list" class="nav-link nav-subject_list tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Courses</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=class_list" class="nav-link nav-class_list tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Classes</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=academic_list" class="nav-link nav-academic_list tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Academic Year</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=class_course" class="nav-link nav-class_course tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Class Course</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="./index.php?page=user_list" class="nav-link nav-user_list">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Users
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.php?page=student_list" class="nav-link nav-student_list tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Students</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=faculty_list" class="nav-link nav-faculty_list tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Faculty</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=supervisor_list" class="nav-link nav-supervisor_list tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Supervisor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=user_list" class="nav-link nav-user_list tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Admin</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=human_resources_list" class="nav-link nav-human_resources_list tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Human Resources</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="./index.php?page=deduction_list" class="nav-link nav-deduction_list">
            <i class="nav-icon fas fa-comment-dollar"></i>
            <p>
              Deduction
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./index.php?page=employee_deduction" class="nav-link nav-employee_deduction">
            <i class="nav-icon fas fa-comments-dollar"></i>
            <p>
              Employee Deduction
            </p>
          </a>
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
  $('#manage_account').click(function () {
    uni_modal('Manage Account', 'manage_user.php?id=<?php echo $_SESSION['login_id'] ?>')
  })
</script>