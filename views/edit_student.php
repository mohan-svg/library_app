  <form class="form-horizontal" action="" method="post" id="updateForm"> 
              <input type="hidden" name="stud_id" value="<?php echo $student['student_id'] ?>">                          
          <div class="form-group">  
              <label for="student_name" class="col-sm-4 control-label">Student Name<span class="red">*</span>:</label>

              <div class="col-sm-6">
                <input type="text" name="student_name" class="form-control input-lg" id="student_name" placeholder="enter student name" value="<?php echo $student['student_name'] ?>" >
                <div class="nameError"></div>
              </div>
          </div>

          <div class="form-group">
              <label for="email" class="col-sm-4 control-label">Email<span class="red">*</span>:</label>

              <div class="col-sm-6">
                <input type="email" name="email" class="form-control input-lg" id="email" placeholder="enter email id" value="<?php echo $student['email'] ?>">
                <div class="emailError"></div>
              </div>
          </div>

          <div class="form-group">
              <label for="mobile_no" class="col-sm-4 control-label">Mobile No<span class="red">*</span>:</label>

              <div class="col-sm-6">
                <input type="text" name="mobile_no" class="form-control input-lg" id="mobile_no" placeholder="enter mobile no." value="<?php echo $student['mobile_no'] ?>">
                <div class="mobileError"></div>
              </div>
          </div>

          <div class="form-group">
              <label class="col-sm-4 control-label">Select Enrolled Courses<span class="red">*</span>:</label>
              <div class="col-sm-6">
                  <select class="form-control input-lg select2" name="course[]" id="course" data-placeholder="Select Enrolled Courses" style="width: 100%;" multiple>
                    <?php $c_id=explode(",",$student['enrolled_courses']); ?>
                    <?php foreach($courses as $key => $val): ?>
                        <option value="<?php echo $val['course_id'] ?>" <?php if(!empty($c_id[1])){ 
                          if(($val['course_id']==$c_id[0])|| ($val['course_id']==$c_id[1])): ?>selected <?php endif; } else{ if(($val['course_id']==$c_id[0])): ?>selected <?php endif;   } ?>><?php echo $val['course_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  <div class="courseError"></div>
              </div>    
          </div> 
          <!-- /.form-group -->

          <div class="form-group">
              <label for="course" class="col-sm-4 control-label">Payment Status<span class="red">*</span>:</label>

              <div class="col-sm-6">
                <select class="form-control input-lg" name="payment_status" id="payment_status" required>
                  <option value="<?php echo $student['p_id'] ?>" ><?php echo $student['payment_value'] ?></option>
                  <?php foreach($payment_status as $key => $val): ?>
                      <option value="<?php echo $val['p_id'] ?>" ><?php echo $val['payment_value'] ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="courseError"></div>
              </div>
          </div>

          <div class="form-group">
              <label for="username" class="col-sm-4 control-label">Username<span class="red">*</span>:</label>

              <div class="col-sm-6">
                <input type="text" name="username" class="form-control input-lg" id="username" placeholder="ex. miley@soe.com" value="<?php echo $student['username'] ?>">
                <div class="usernameError"></div>
              </div>
          </div>
          <div class="form-group">
            <label for="username" class="col-sm-4 control-label"></label>
              <div class="col-sm-6">
                <input id="update_password" type="checkbox" name="update_password"> <label class="control-label">Update Password</label>
              </div>
          </div>
          <div class="form-group" id="password_block">
              <label for="password" class="col-sm-4 control-label">Password:</label>

              <div class="col-sm-6">
                <input type="password" name="password" class="form-control input-lg" id="password" placeholder="enter password" >
                <div class="passwordError"></div>
              </div>
          </div>
            <input type="hidden" name="old_password" value="<?php echo $student['password'] ?>">
          <div class="box-footer modalBody" style="text-align: center;" >
            <button type="submit" class="btn btn-primary btn-lg">Update Student</button>
            <div class="clearfix"></div>
          </div>
  </form>
 
<script type="text/javascript">
   $('#password_block').hide();

    $('#update_password').click(function(){
        if($(this).is(':checked')){
            $('#password_block').show();
        } else{
            $('#password_block').hide();
        }
  });
</script>