<?php
if($this->session->userdata('admin_logged_in') != 'true') {
$this->session->set_flashdata('error', "You need to be logged in to access the page.");
redirect('admin');
}
?>

<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <style type="text/css">
    @media (min-width: 768px){
      .modal-dialog {
          width: 900px;
          margin: 30px auto;
      }
    }
  </style>

  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary"><br>
                <?php if ($this->session->flashdata('success')) { ?>

                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $this->session->flashdata('error'); ?>
                </div>

                <?php } ?>

                <div class="container">
                    <h2 class="box-title">Register New Student</h2>
                </div>
                <div class="container" style="margin-bottom: 30px;">
                  <div class="col-md-6">
                      <div class="alert alert-success" style="display: none;"></div>
                  </div>
                  <div class="col-md-6 text-right pt-4" style="margin-bottom: 20px;">
                      <button class="btn btn-primary" id="addButton">Add New Student</button>
                    <!--  <a href="javascript:showModal()" class="btn btn-primary">Add New Student</a> -->
                  </div>
                </div>

                <div id="registerStudent" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header modalHeader">
                        <div class="col-md-10">
                          <h2 class="modal-title">Register New Student</h2>
                        </div>                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 40px; color:#c4191f; opacity:0.8">
                          <span aria-hidden="true" >&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                         <form class="form-horizontal" action="" method="post" id="registerForm" name="register_students"> 
                                                    
                                <div class="form-group">
                                    <label for="conc" class="col-sm-4 control-label">Student Name:</label>

                                    <div class="col-sm-6">
                                      <input type="text" name="student_name" class="form-control input-lg" id="student_name" placeholder="enter student name" >
                                      <div class="nameError"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="conc" class="col-sm-4 control-label">Email:</label>

                                    <div class="col-sm-6">
                                      <input type="email" name="email" class="form-control input-lg" id="email" placeholder="enter email id" >
                                      <div class="emailError"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="conc" class="col-sm-4 control-label">Mobile No:</label>

                                    <div class="col-sm-6">
                                      <input type="text" name="mobile_no" class="form-control input-lg" id="mobile_no" placeholder="enter mobile no." >
                                      <div class="mobileError"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="conc" class="col-sm-4 control-label">Select Course:</label>

                                    <div class="col-sm-6">
                                      <select class="form-control input-lg" name="course" id="course">
                                        <option value="" >--Select Course--</option>
                                        <?php foreach($courses as $key => $val): ?>
                                            <option value="<?php echo $val['course_id'] ?>" ><?php echo $val['course_name'] ?></option>
                                        <?php endforeach; ?>
                                      </select>
                                      <div class="courseError"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="conc" class="col-sm-4 control-label">Username:</label>

                                    <div class="col-sm-6">
                                      <input type="text" name="username" class="form-control input-lg" id="username" placeholder="ex. miley@soe.com" >
                                      <div class="usernameError"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="conc" class="col-sm-4 control-label">Password:</label>

                                    <div class="col-sm-6">
                                      <input type="password" name="password" class="form-control input-lg" id="password" placeholder="enter password" >
                                      <div class="passwordError"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="conc" class="col-sm-4 control-label">Retype-Password:</label>

                                    <div class="col-sm-6">
                                      <input type="password" name="password2" class="form-control input-lg" id="password2" placeholder="repeat password" >
                                      <div class="retypePasswordError"></div>
                                    </div>
                                </div>
                              
                                <div class="box-footer" style="text-align: center;" >
                                  <button type="submit" id="btnSave" class="btn btn-primary btn-lg" name="stu_submit">Register Students</button>
                                  <div class="clearfix"></div>
                                </div>
                            </form>
                      </div>
                    </div>
                  </div>
                </div>
            
           
          </div><!--box-->

          <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h2 class="modal-title">Success Message</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  
                  <div class="modal-body" id="success-message">
                        
                  </div>
                  <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        
                  </div>

                                  
                </div>
              </div>
            </div>



          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Student List </h3>

            </div>

            <div class="box-body" style="overflow-x: scroll;">


              <table id="example1" class="table table-bordered ">
                <thead>
                <tr style="background-color:  #424949 ; color: white;">
                  <th>Sr</th>
                  <th>Student Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Username</th>
                  <th>Registered For</th>
                  <th>Created At</th>
                  <th>Modified At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody id="showData">
                    

                </tbody>
              </table>
            </div><!--box-body-->
          </div><!--box-->

        </div><!--col-md-12-->
      </div><!--row-->
    </section>
 </div><!--content wrapper-->

<script type="text/javascript">
  
  $(function(){

      showAllStudents();

      $('#addButton').click(function(){

          $("#registerStudent").modal('show');
          $('#registerForm').attr('action','');


      });


      $("#btnSave").click(function(e){
          e.preventDefault();

          var data = $('#registerForm').serialize();

          $.ajax({

              type: 'post',
              url: '<?php echo base_url()."/insert_student" ?>',
              data: data,
              dataType:'json',
              success: function(response){
                  if(response['status'] == 0){

                       if(response['student_name'] != ''){

                          $('.nameError').html(response['student_name']).addClass('invaleed-feedback');
                          $('#student_name').addClass('is-invalid');

                      } else {
                         
                          $('.nameError').html('').removeClass('invaleed-feedback');
                          $('#student_name').removeClass('is-invalid');
                      }

                      if(response['email'] != ''){
                          
                          $('.emailError').html(response['email']).addClass('invaleed-feedback');
                          $('#email').addClass('is-invalid');

                      } else{

                          $('.emailError').html('').removeClass('invaleed-feedback');
                          $('#email').removeClass('is-invalid');

                      }

                      if(response['mobile_no'] != ''){

                         $('.mobileError').html(response['mobile_no']).addClass('invaleed-feedback');
                         $('#mobile_no').addClass('is-invalid');

                      } else{

                          $('.mobileError').html('').removeClass('invaleed-feedback');
                          $('#mobile_no').removeClass('is-invalid');

                      }

                      if(response['course'] != ''){

                          $('.courseError').html(response['course']).addClass('invaleed-feedback');
                          $('#course').addClass('is-invalid');

                      } else{

                          $('.courseError').html('').removeClass('invaleed-feedback');
                          $('#course').removeClass('is-invalid');

                      }

                      if(response['username'] != ''){

                          $('.usernameError').html(response['username']).addClass('invaleed-feedback');
                          $('#username').addClass('is-invalid');

                      } else{

                          $('.usernameError').html("").removeClass('invaleed-feedback');
                          $('#username').removeClass('is-invalid');
                      }

                      if(response['password'] != ''){

                          $('.passwordError').html(response['password']).addClass('invaleed-feedback');
                          $('#password').addClass('is-invalid');

                      } else{

                          $('.passwordError').html("").removeClass('invaleed-feedback');
                          $('#password').removeClass('is-invalid');

                      }

                      if(response['password2'] != ''){

                          $('.retypePasswordError').html(response['password2']).addClass('invaleed-feedback');
                          $('#password2').addClass('is-invalid');

                      } else{

                          $('.retypePasswordError').html("").removeClass('invaleed-feedback');
                          $('#password2').removeClass('is-invalid');

                      }

                  } else {

                        $("#registerStudent").modal('hide');
                        $("#registerForm")[0].reset();
                        $(".alert-success").html('Student Registered Successfully').fadeIn().delay(4000).fadeOut('slow');
                        showAllStudents();
                  }
              },
               error: function(){
                alert('Not Able to Add Student, Try Again');
               }

          });

      });

      function showAllStudents(){
        $.ajax({

              type: 'ajax',
              url: '<?php echo base_url() ?>viewStudents',
              // async: false,
              dataType: 'json',
              success: function(data){
                var html='';

                
                for(var i=0;i<data.length;i++){
                  html += '<tr>'+
                            '<td>'+ (i+1) +'</td>'+
                                '<td>'+ data[i].student_name +'</td>'+
                                '<td>'+ data[i].email +'</td>'+
                                '<td>'+ data[i].mobile_no +'</td>'+
                                '<td>'+ data[i].username +'</td>'+
                                '<td>'+ data[i].course_selected +'</td>'+
                                '<td>'+ data[i].created +'</td>'+                     

                                '<td>'+ data[i].modified +'</td>'+
                                '<td>'+
                                    '<a href="javascript:;" name="delete" class="btn btn-info btn-sm">Edit</a>'+
                                     '<a href="javascript:;" name="delete" class="btn btn-danger btn-sm">Delete</button>'+
                                 '</td>'+
                         '</tr>';
                }

                

                 

                 $("#showData").html(html);
              },
              error: function(){
                alert('could not get data from db');
              }

        });
      }
  })
</script>