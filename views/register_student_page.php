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
                    <div class="col-md-6" >
                        <div class="alert alert-success" style="display: none;"></div>
                        <div id="alert-msg"></div>
                    </div>
                    <div class="col-md-6 text-right pt-4" style="margin-bottom: 20px;">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#registerStudent">Add New Student</button>
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
                      <div class="modal-body modalBody">
                         <form class="form-horizontal" action="" method="post" id="registerForm" name="register_students"> 
                                                    
                                <div class="form-group">
                                    <label for="student_name" class="col-sm-4 control-label">Student Name<span class="red">*</span>:</label>

                                    <div class="col-sm-7">
                                      <input type="text" name="student_name" class="form-control input-lg" id="student_name" placeholder="enter student name" >
                                      <div class="nameError"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-sm-4 control-label">Email<span class="red">*</span>:</label>

                                    <div class="col-sm-7">
                                      <input type="email" name="email" class="form-control input-lg" id="email" placeholder="enter email id" >
                                      <div class="emailError"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="mobile_no" class="col-sm-4 control-label">Mobile No<span class="red">*</span>:</label>

                                    <div class="col-sm-7">
                                      <input type="text" name="mobile_no" class="form-control input-lg" id="mobile_no" placeholder="enter mobile no." >
                                      <div class="mobileError"></div>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label for="course" class="col-sm-4 control-label">Select Enrolled Courses:</label>

                                    <div class="col-sm-3">
                                      <select class="form-control input-lg" name="course1" id="course" required>
                                        <option value="" >--Select Course--</option>
                                        <?php foreach($courses as $key => $val): ?>
                                            <option value="<?php echo $val['course_id'] ?>" ><?php echo $val['course_name'] ?></option>
                                        <?php endforeach; ?>
                                      </select>
                                      <div class="courseError"></div>
                                    </div>
                                    <div class="col-sm-1 text-center" > <span style="font-size: 32px;">+</span></div>
                                    <div class="col-sm-3">                                    
                                      <select class="form-control input-lg" name="course2" id="course">
                                        <option value="" >--Select Course--</option>
                                        <?php foreach($courses as $key => $val): ?>
                                            <option value="<?php echo $val['course_id'] ?>" ><?php echo $val['course_name'] ?></option>
                                        <?php endforeach; ?>
                                      </select>
                                      <div class="courseError"></div>
                                    </div>
                                </div> -->
            
                               <div class="form-group">
                                  <label class="col-sm-4 control-label">Select Enrolled Courses<span class="red">*</span>:</label>
                                  <div class="col-sm-6">
                                      <select class="form-control input-lg select2" name="course[]" id="course" data-placeholder="Select Enrolled Courses" style="width: 100%;" multiple>
                                        <?php foreach($courses as $key => $val): ?>
                                            <option value="<?php echo $val['course_id'] ?>" ><?php echo $val['course_name'] ?></option>
                                        <?php endforeach; ?>
                                      </select>
                                      <div class="courseError"></div>
                                  </div>    
                                </div> 
                          <!-- /.form-group -->
          
                             
                                <div class="form-group">
                                    <label for="payment_status" class="col-sm-4 control-label">Payment Status<span class="red">*</span>:</label>

                                    <div class="col-sm-7">
                                      <select class="form-control input-lg" name="payment_status" id="payment_status">
                                        
                                        <?php foreach($payment_status as $key => $val): ?>
                                            <option value="<?php echo $val['p_id'] ?>" ><?php echo $val['payment_value'] ?></option>
                                        <?php endforeach; ?>
                                      </select>                                      
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="conc" class="col-sm-4 control-label">Username<span class="red">*</span>:</label>

                                    <div class="col-sm-7">
                                      <input type="text" name="username" class="form-control input-lg" id="username" placeholder="ex. miley@soe.com" >
                                      <div class="usernameError"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="conc" class="col-sm-4 control-label">Password<span class="red">*</span>:</label>

                                    <div class="col-sm-7">
                                      <input type="password" name="password" class="form-control input-lg" id="password" placeholder="enter password" >
                                      <div class="passwordError"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="conc" class="col-sm-4 control-label">Retype-Password<span class="red">*</span>:</label>

                                    <div class="col-sm-7">
                                      <input type="password" name="password2" class="form-control input-lg" id="password2" placeholder="repeat password" >
                                      <div class="retypePasswordError"></div>
                                    </div>
                                </div>
                              
                                <div class="box-footer modalBody" style="text-align: center;" >
                                  <button type="submit" class="btn btn-primary btn-lg" name="stu_submit">Register Student</button>
                                  <div class="clearfix"></div>
                                </div>
                            </form>
                      </div>
                    </div>
                  </div>
                </div>
           
          </div><!--box-->

          <div class="modal fade" id="updateModal" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header modalHeader">
                    <h2 class="modal-title">Update Student</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  
                  <div class="modal-body modalBody" id="updateBody">
                        
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
                  <th>Payment Status</th>
                  <th>Created At</th>
                  <th>Modified At</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                      $count = 0;
                      foreach($students as $key => $data):
                     
                      $count++;
                    ?>
                    <tr>
                        <td><?php echo $count ;?></td>
                        <td><?php echo $data['student_name'] ;?></td>
                        <td><?php echo $data['email'] ;?></td>
                        <td><?php echo $data['mobile_no'] ;?></td>
                        <td><?php echo $data['username'] ;?></td>
                        <td><?php 
                                  $course = explode(",",$data['enrolled_courses']);
                                  
                                  foreach ($course as $key){
                                    $this->db->where('course_id',$key);
                                  echo  $this->db->get('courses')->row()->course_name." , ";
                                  }
                              
                        ?></td>
                        <td><?php echo $data['payment_value'] ;?></td>
                        <td><?php echo $data['created'] ;?></td>                     

                        <td><?php echo date('d-m-Y H:i:s',strtotime($data['modified'])); ?></td>
                        <td>
                          <a href="javascript:void(0);" onclick ="showEditForm(<?php echo $data['student_id'] ?>);" class="btn btn-warning" >Edit</a>
                          <a href="javascript:void(0);" onclick="showDeleteModal(<?php echo $data['student_id'] ?>);" class="btn btn-danger">Delete</button>
                         </td>
                   </tr>
              

                <?php endforeach;  ?>
                   </tbody>
              </table>
            </div><!--box-body-->
          </div><!--box-->

        </div><!--col-md-12-->
      </div><!--row-->
    </section>
 </div><!--content wrapper-->

 <div class="modal fade" id="deleteModal" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title text-center" style="color: #CB4335; font-weight: bold;">Delete Student</h3>
            </div>
            
            <div class="modal-body">
                
                <h4 class="text-center">Are you sure want to Delete Student Data?</h4>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button id="btnDelete" class="btn btn-danger" >Delete</button>
            </div>
          
          </div>

        </div>
  </div>

<script type="text/javascript">

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

  });
  
  function showModal(){
      $("#registerStudent").modal("show");
  }

    
  $("#registerForm").submit(function(e){
      e.preventDefault();

      $.ajax({
            url: '<?php echo base_url().'/insert_student' ?>',
            type: 'POST',
            data:$(this).serializeArray(),
            dataType: 'json',
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

              } else if(response['status'] == 1){


                      $("#registerStudent").modal('hide');
                      $("#registerForm")[0].reset();
                      $(".alert-success").html('Student Registered Successfully').fadeIn().delay(3000).fadeOut('slow');
                      // $("#successModal").modal("show");

                      
                     
                      $(".nameError").html("").removeClass('invaleed-feedback');
                      $("#student_name").removeClass('is-invalid');

                      $(".emailError").html("").removeClass('invaleed-feedback');
                      $("#email").removeClass('is-invalid');

                      $(".mobileError").html("").removeClass('invaleed-feedback');
                      $("#mobile_no").removeClass('is-invalid');

                      $('.courseError').html("").removeClass('invaleed-feedback');
                      $('#course').removeClass('is-invalid');

                      $('.usernameError').html("").removeClass('invaleed-feedback');
                      $('#username').removeClass('is-invalid');

                      $('.passwordError').html("").removeClass('invaleed-feedback');
                      $('#password').removeClass('is-invalid');

                      $('.retypePasswordError').html("").removeClass('invaleed-feedback');
                      $('#password2').removeClass('is-invalid');

                      // $("#example1").append(response['row']);
                      // location.reload();
                      setTimeout(function () { location.reload(true); }, 3000);


              }
        }
      });
  });
  

function showDeleteModal(id){

    $("#deleteModal").modal("show");

    $("#btnDelete").click(function(){
        
        $.ajax({

          url: '<?php echo base_url()."/delete_student/" ?>'+id,
          type: 'POST',
          dataType: 'json',
          success: function(response){
            $("#deleteModal").modal("hide");
             $("#alert-msg").html(response['html']).fadeIn().delay(3000).fadeOut('slow');
             setTimeout(function () { location.reload(true); }, 3000);
          }          

        });
    });
}

function showEditForm(id){
 
  $.ajax({
      url: '<?php echo base_url()."getUpdateStudent/" ?>'+id,
      type: 'POST',
      dataType: 'json',
      success: function(response){

          $('#updateModal #updateBody').html(response['html']);
          $('#updateModal').modal('show');

      }

  });
}


        


$("body").on("submit","#updateForm",function(e){
    e.preventDefault();

    $.ajax({
      url: '<?php echo base_url()."/update_student" ?>',
      type: 'POST',
      data: $(this).serializeArray(),
      dataType: 'json',
      success: function(response){

        if(response['status']==0){

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
                    


        } else if(response['status']==1 || response['status']==2){

                    $("#updateModal").modal('hide');                  
                    $("#alert-msg").html(response['html']).fadeIn().delay(3000).fadeOut('slow');

                      $(".nameError").html("").removeClass('invaleed-feedback');
                      $("#student_name").removeClass('is-invalid');

                      $(".emailError").html("").removeClass('invaleed-feedback');
                      $("#email").removeClass('is-invalid');

                      $(".mobileError").html("").removeClass('invaleed-feedback');
                      $("#mobile_no").removeClass('is-invalid');

                      $('.courseError').html("").removeClass('invaleed-feedback');
                      $('#course').removeClass('is-invalid');

                      $('.usernameError').html("").removeClass('invaleed-feedback');
                      $('#username').removeClass('is-invalid');

                      $('.passwordError').html("").removeClass('invaleed-feedback');
                      $('#password').removeClass('is-invalid');

                      $('.retypePasswordError').html("").removeClass('invaleed-feedback');
                      $('#password2').removeClass('is-invalid');

                      // $("#example1").append(response['row']);
                      // location.reload();
                      setTimeout(function () { location.reload(true); }, 3000);

        } 
      }
    });

});

</script>