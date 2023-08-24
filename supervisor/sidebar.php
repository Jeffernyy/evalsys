  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="dropdown">
   	<a href="./" class="brand-link"><br><br>
        <h3 class="text-center p-0 m-0"><b></b></h3>

    </a>
      
    </div>
    <div class="sidebar ">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
         <li class="nav-item dropdown">
            <a href="./index.php?page=home" class="nav-link nav-home">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="./index.php?page=evaluate" class="nav-link nav-evaluate">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Evaluate
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./index.php?page=faculty_peers" class="nav-link nav-faculty_peers">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Faculty Peers
                <!--<i class="right fas fa-angle-left"></i>-->
              </p>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link nav-result">
              <i class="nav-icon fas fa-th-list"></i>
              <p>
                Evaluation Result
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
        </ul>
      </nav>
    </div>
  </aside>
  <script>
  	$(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
  		var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      if(s!='')
        page = page+'_'+s;
  		if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
  			if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
  				$('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
  			}
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

  		}
     
  	})
  </script>