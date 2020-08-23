<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      
     <br/><br/>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        

        <li style="color: white; font-size: 20px; margin-left: 25px;"><?php echo $this->session->userdata('admin_name') ?></li>
        <br/><br/>
        <li class="header"></li>
        
        <li>
          <a href="admin_dashboard">
            <i class="glyphicon glyphicon-th-large"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>

        <li>
          <a href="register_student">
            <i class="fa fa-user-plus"></i> <span>Register Student</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>

   <!--      <li>
          <a href="add_courses">
            <i class="glyphicon glyphicon-text-background"></i> <span>Add Course</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li> -->

        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>GRE</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a href="<?php echo site_url('add_gre_video') ?>"><i class="fa fa-circle-o"></i> Add Videos</a></li>
            <li><a href="<?php echo site_url('add_gre_book') ?>"><i class="fa fa-circle-o"></i> Add Books</a></li>
            <li><a href="<?php echo site_url('add_gre_audio') ?>"><i class="fa fa-circle-o"></i> Add Audios</a></li>            
          </ul>
        </li>


        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>IELTS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a href="<?php echo site_url('add_ielts_video') ?>"><i class="fa fa-circle-o"></i> Add Videos</a></li>
            <li><a href="<?php echo site_url('add_ielts_book') ?>"><i class="fa fa-circle-o"></i> Add Books</a></li>
            <li><a href="<?php echo site_url('add_ielts_audio') ?>"><i class="fa fa-circle-o"></i> Add Audios</a></li>    
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>TOEFL</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li><a href="<?php echo site_url('add_toefl_video') ?>"><i class="fa fa-circle-o"></i> Add Videos</a></li>
            <li><a href="<?php echo site_url('add_toefl_book') ?>"><i class="fa fa-circle-o"></i> Add Books</a></li>
            <li><a href="<?php echo site_url('add_toefl_audio') ?>"><i class="fa fa-circle-o"></i> Add Audios</a></li>    
          </ul>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>