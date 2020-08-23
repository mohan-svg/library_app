<?php
if($this->session->userdata('admin_logged_in') != 'true') {
$this->session->set_flashdata('error', "You need to be logged in to access the page.");
redirect('admin');
}
?>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
            <div class="box-header with-border">
              <h3 class="box-title">Add Courses</h3>

            </div>
            <form class="form-horizontal" action="insert_courses" method="post">
              <div class="box-body">
                  <div id="dynamic_field">
                    <div class="form-group">
                            <label class="col-sm-4 control-label">University Name*:</label>

                            <div class="col-sm-5">
                              <select class="form-control input-lg" name="university" required="required">
                                <option value="">-- Select University --</option>
                                <?php foreach ($university as $key => $val) { ?>
                                 <option value="<?php echo $val['university_id'] ?>"><?php echo $val['university_name'] ?></option>
                               <?php  } ?>
                              </select>                              
                            </div>
                        </div>
                     <div id="row">
                        <div class="form-group">
                            <label for="course" class="col-sm-4 control-label">Course Name*:</label>
                            <div class="col-sm-5">
                              <input type="text" name="course[]" class="form-control input-lg" id="course" placeholder="ex. MS Computer Science" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gre" class="col-sm-4 control-label">GRE Code*:</label>
                            <div class="col-sm-5">
                              <input type="text" name="gre[]" class="form-control input-lg" id="gre" placeholder="ex. 4007" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="toefl" class="col-sm-4 control-label">TOEFL Code*:</label>
                            <div class="col-sm-5">
                              <input type="text" name="toefl[]" class="form-control input-lg" id="toefl" placeholder="ex. 4007" required>
                            </div>
                        </div>
                                              
                      </div> <!--Id="row"-->
                    
                      <div class="form-group">
                          <label class="col-sm-4 control-label"><button type="button" name="add" id="add" class="btn btn-success">+ Add More</button></label>
                     </div>
                  </div>

               <div class="box-footer" style="text-align: center;" >

                <button type="submit" class="btn btn-primary btn-lg" name="stu_submit">ADD Courses</button>
                <div class="clearfix"></div>
              </div>
            </form>
          </div><!--box-->


          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Courses List </h3>

            </div>

            <div class="box-body" style="overflow-x: scroll;">


              <table id="example1" class="table table-bordered ">
                <thead>
                <tr style="background-color:  #424949 ; color: white;">
                  <th>Sr</th>
                  <th>Country Name</th>
                  <th>University Name</th>
                  <th>Course Name</th>   
                  <th>GRE Code</th>   
                  <th>TOEFL Code</th>                  
                  <th>Updated by</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                      $count = 0;
                      foreach($courses as $key => $data)
                     {
                      $count++;
                    ?>
                    <tr>
                        <td><?php echo $count ;?></td>
                        <td><?php echo $data['country_name'] ;?></td>  
                        <td><?php echo $data['university_name'] ;?></td> 
                        <td><?php echo $data['course_name'] ;?></td>  
                        <td><?php echo $data['univ_gre_code'] ;?></td>  
                        <td><?php echo $data['univ_toefl_code'] ;?></td>                                          
                        <td><?php echo $data['courses_updated_by']."<br/>" ?><?php echo date('d-m-Y H:i:s',strtotime($data['course_created'])); ?></td>
                        <td>
                          <button type="button" name="delete" class="btn btn-warning" data-toggle="modal" data-target="#myModalu<?php echo $data['course_id']; ?>"> Edit</button>
                          <button type="button" name="delete" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $data['course_id']; ?>">Delete</button>
                         </td>
                   </tr>
              <div class="modal fade" id="myModal<?php echo $data['course_id']; ?>" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h3 class="modal-title text-center" style="color: #CB4335; font-weight: bold;">Delete Course Name</h3>
                    </div>
                    <form action="delete_courses" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="course_id" value="<?php echo $data['course_id']; ?>">
                        <h4 class="text-center">Are you sure want to Delete Course Name?</h4>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <input type="submit" class="btn btn-danger" name="delete" value="Yes..! Delete">
                    </div>
                  </form>
                  </div>

                </div>
              </div>

               <div class="modal fade" id="myModalu<?php echo $data['course_id']; ?>" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h3 class="modal-title text-center" style="color: #CB4335; font-weight: bold;">Update University Name</h3>
                    </div>
                    <div class="modal-body">
                       <form class="form-horizontal" action="update_courses" method="post">
                        <div class="col-sm-11" style="margin-bottom: 20px;">
                          <input type="hidden" name="course_id" value="<?php echo $data['course_id']; ?>">
                            
                            <div class="form-group col-sm-12">
                              <label for="country" class="col-sm-4 control-label">University Name*:</label>

                              <div class="col-sm-6">
                                <select class="form-control input-lg" name="university" required="required">
                                <option value="<?php echo $data['university_id'] ?>"><?php echo $data['university_name'] ?></option>
                                <?php foreach ($university as $key => $val) { ?>
                                 <option value="<?php echo $val['university_id'] ?>"><?php echo $val['university_name'] ?></option>
                               <?php  } ?>                              
                              </select> 

                              </div>
                            </div> 

                            <div class="form-group col-sm-12" style="margin-top:20px;">
                              <label for="course" class="col-sm-4 control-label">Course Name*:</label>
                              <div class="col-sm-6">
                                <input type="text" name="course" class="form-control input-lg" id="course" placeholder="ex. MS Computer Science" value="<?php echo $data['course_name'] ?>" required>
                              </div>
                              <div class="col-sm-6">
                                <input type="text" name="gre_code" class="form-control input-lg" id="gre_code" placeholder="ex. MS Computer Science" value="<?php echo $data['univ_gre_code'] ?>" required>
                              </div>
                              <div class="col-sm-6">
                                <input type="text" name="toefl_code" class="form-control input-lg" id="toefl_code" placeholder="ex. MS Computer Science" value="<?php echo $data['univ_toefl_code'] ?>" required>
                              </div>
                          </div>
                                            
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
                         <button type="submit" class="btn btn-success btn-lg" name="submit"> Update</button>
                        
                        </div>
                    </form>
                  </div>

                </div>
              </div>
                      <?php
                        }
                      ?>
                   </tbody>
              </table>
            </div><!--box-body-->
          </div><!--box-->

        </div><!--col-md-12-->
      </div><!--row-->
    </section>
 </div><!--content wrapper-->

<script>
  $(document).ready(function(){
    var i =1;
    
    $('#add').click(function(){
      i++;
      $('#dynamic_field').append('<div id="row'+i+'" class="col-md-12" style="padding:6px;margin-top: 15px;"><div class="col-md-12"><button type="button" name="remove" id="'+i+'" class="btn btn_remove pull-right" style="border-radius:50%;color:red;">X</button></div><div class="form-group"><label for="course'+i+'" class="col-sm-4 control-label">Course Name*:</label><div class="col-sm-6"><input type="text" name="course[]" class="form-control input-lg" id="course'+i+'" placeholder="ex. MS Computer Science" required></div></div><div class="form-group"><label for="gre'+i+'" class="col-sm-4 control-label">GRE Code*:</label><div class="col-sm-5"><input type="text" name="gre[]" class="form-control input-lg" id="gre'+i+'" placeholder="ex.4007" required></div></div><div class="form-group"><label for="toefl'+i+'" class="col-sm-4 control-label">TOEFL Code*:</label><div class="col-sm-5"><input type="text" name="toefl[]" class="form-control input-lg" id="toefl'+i+'" placeholder="ex. 4007" required></div></div></div>');
    });

    $(document).on('click', '.btn_remove', function(){
      var button_id = $(this).attr("id");
      $('#row'+button_id+'').remove();
    });
  });

</script>

