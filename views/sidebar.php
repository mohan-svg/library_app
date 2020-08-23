<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      
     <br/><br/>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        

        <li style="color: white; font-size: 20px; margin-left: 25px;"><?php echo $this->session->userdata('fname') ?></li>
        <br/><br/>
        <li class="header"></li>
        
        <li>
          <a href="dashboard">
            <i class="fa fa-home"></i> <span>Home</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>

        <li>
          <a href="university_application">
            <i class="fa fa-bank"></i> <span>Apply to University</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
     

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-plus"></i> <span>Update Personal Details</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">            
            <li><a href="personal_details"><i class="fa fa-circle-o"></i> Personal Details</a></li>
            <li><a href="educational_details"><i class="fa fa-circle-o"></i> Educational Details</a></li>
            <li><a href="testing_details"><i class="fa fa-circle-o"></i> Testing Details</a></li>
            <li><a href="work_experience"><i class="fa fa-circle-o"></i> Work Experience</a></li>            
            <li><a href="upload_documents"><i class="fa fa-circle-o"></i> Uploaded Documents</a></li>
          </ul>
        </li>
        
        <li>
          <a href="pdf_editing">
            <i class="glyphicon glyphicon-floppy-saved"></i> <span>Document Editing Tools</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>

        <li>
          <a href="how_to_send">
            <i class="glyphicon glyphicon-education"></i> <span>How to Send Scores</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>

        <li>
          <a href="faqs_ans">
            <i class="glyphicon glyphicon-question-sign"></i> <span>FAQ's</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>
                
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>