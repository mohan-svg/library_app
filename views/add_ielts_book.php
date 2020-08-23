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
            <div class="box-header with-border">
              <h3 class="box-title">Add IELTS Book</h3>

            </div>
            <div class="box-body">
                <form class="form-horizontal" action="<?php echo site_url('add_ielts_bookss'); ?>" method="post" enctype="multipart/form-data">
                                                     
                        <div class="form-group">
                            <label for="conc" class="col-sm-4 control-label">Select Sub-section:</label>

                            <div class="col-sm-6">
                              
                              <select name="subSection" class="form-control input-lg" id="subSection" required>
                                <option value="">--Select Sub-section--</option>
                                <option value="IELTS Standard Books">IELTS Standard Books</option>
                                <option value="IELTS Notes">IELTS Notes</option>
                                <option value="IELTS Test Papers">IELTS Test Papers</option>
                              </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Select Topic:</label>

                            <div class="col-sm-6">
                              <select name="topic_name" class="form-control input-lg" id="topic_name">
                                  <option value="">--Select IELTS Topic--</option>                                
                              </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Provide Title for Book:</label>

                            <div class="col-sm-6">
                              <input type="text" name="book_title" class="form-control input-lg" required>
                            </div>

                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Enter Book url:</label>

                            <div class="col-sm-6">
                                <input type="text" name="bookurl" class="form-control input-lg" placeholder="enter book url here">
                            </div>
                            <div class="col-md-12 text-center" style="font-weight: bold; font-size: 18px;">--------OR--------</div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Upload Book:</label>

                            <div class="col-sm-6">
                              <input type="file" name="book" class="form-control input-lg" required>
                            </div>
                            
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Attached Audio url:</label>
                            <div class="col-sm-6">
                              <input type="text" name="attaudio_url" class="form-control input-lg" placeholder="enter audio url here">
                            </div>
                            <div class="col-md-12 text-center" style="font-weight: bold; font-size: 18px;">--------OR--------</div>                            
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Upload Attached Audio:</label>

                            <div class="col-sm-6">
                              <input type="file" name="attaudio" class="form-control input-lg" required>
                            </div>
                            
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Payment Status for Course:</label>
                            <div class="col-sm-6">
                                <select name="payment_status" class="form-control input-lg">
                                  <?php foreach($payment_status as $key => $value): ?>
                                      <option value="<?php echo $value['p_id'] ?>"><?php echo $value['payment_value'] ?></option>
                                  <?php endforeach; ?>  
                                </select>
                            </div>
                        </div>
                     
                       <div class="box-footer" style="text-align: center;" >
                        <button type="submit" class="btn btn-primary btn-lg">ADD IELTS Book</button>
                        <div class="clearfix"></div>
                      </div>
                </form>
          </div><!--box-->


          <div class="box">
            <div class="box-header">
              <h3 class="box-title">IELTS Book</h3>

            </div>

            <div class="box-body" style="overflow-x: scroll;">


              <table id="example1" class="table table-bordered ">
                <thead>
                <tr style="background-color:  #424949 ; color: white;">
                  <th>Sr</th>
                  <th>Payment Status</th>
                  <th>Sub-section</th>
                  <th>Topic Name</th>
                  <th>Book Title</th>
                  <th>IELTS Book</th>
                  <th>Attached Audio</th>
                  <th>Created</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                      $count = 0;
                      foreach($books as $key => $data)
                     {
                      $count++;
                    ?>
                    <tr>
                        <td><?php echo $count ;?></td>
                        <td><?php echo $data['payment_value'] ;?></td>  
                        <td><?php echo $data['subsection'] ;?></td> 
                        <td><?php echo $data['topic_name'] ;?></td>   
                        <td><?php echo $data['book_title'] ;?></td>   
                        <td><?php echo $data['book'] ;?></td>                     
                        <td><?php echo $data['attached_audio'] ;?></td>  
                        <td><?php echo $data['created_at']."<br/>" ?><?php echo date('d-m-Y H:i:s',strtotime($data['updated'])); ?></td>
                        <td>
                          <button type="button" name="delete" class="btn btn-warning" data-toggle="modal" data-target="#myModalu<?php echo $data['id']; ?>">Edit</button>
                          <button type="button" name="delete" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $data['id']; ?>">Delete</button>
                         </td>
                   </tr>
                    <div class="modal fade" id="myModal<?php echo $data['id']; ?>" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title text-center" style="color: #CB4335; font-weight: bold;">Delete GRE Book</h3>
                          </div>
                          <form action="<?php echo site_url('delete_ielts_book') ?>" method="post">
                          <div class="modal-body">
                              <input type="hidden" name="book_id" value="<?php echo $data['id']; ?>">
                              <input type="hidden" name="book_url" value="<?php echo $data['book']; ?>">
                              <h4 class="text-center">Are you sure want to delete IELTS Book?</h4>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-danger" name="delete" value="Yes..! Delete">
                          </div>
                        </form>
                        </div>

                      </div>
                    </div>

                    <div class="modal fade" id="myModalu<?php echo $data['id']; ?>" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header modalHeader">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3 class="modal-title text-center">Update IELTS Book</h3>
                          </div>
                          <div class="modal-body modalBody">
                             <form class="form-horizontal" action="<?php echo site_url('update_ielts_book') ?>" method="post" enctype="multipart/form-data">
                              <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                              <div class="form-group">
                                  <label for="conc" class="col-sm-4 control-label">Select Sub-section:</label>

                                  <div class="col-sm-8">
                                    
                                    <select name="subSection" class="form-control input-lg" required>
                                      <option value="<?php echo $data['subsection'] ?>"><?php echo $data['subsection'] ?></option>
                                      <option value="IELTS Standard Books">IELTS Standard Books</option>
                                      <option value="IELTS Notes">IELTS Notes</option>
                                      <option value="IELTS Test Papers">IELTS Test Papers</option>
                                    </select><br/>
                                  </div>

                              </div><br/>
                              <div class="form-group" >
                                  <label class="col-sm-4 control-label">IELTS Topic:</label>

                                  <div class="col-sm-8">
                                    <input type="text" name="topic_name" value="<?php echo $data['topic_name'] ?>" class="form-control input-lg"><br/>
                                  </div>

                              </div>
                              <div class="form-group" >
                                  <label for="conc" class="col-sm-4 control-label">Provide Title for Book:</label>

                                  <div class="col-sm-8 pb">
                                    <input type="text" name="book_title" class="form-control input-lg" value="<?php echo $data['book_title'] ?>" required><br/>
                                  </div>
                                  <br/>
                              </div>
                              <div class="form-group" >
                                  <label for="conc" class="col-sm-4 control-label">Update Book:</label>

                                  <div class="col-sm-8 pb">
                                    <?php  if($data['book']!=''): ?>

                                      <input type="hidden" name="book_link" value="<?php echo $data['book']; ?>" class="form-control">   
                                      <object data="<?php echo base_url().$data['book']; ?>"></object>
                                      <h4 class="">--------OR---------</h4><br/>
                                        <h4>Replace with new Book</h4>

                                    <?php  endif; ?>

                                    <input type="file" name="book" class="form-control input-lg"><br/>

                                  </div>
                                  
                              </div><br/>

                              <div class="form-group">
                                  <label for="conc" class="col-sm-4 control-label">Attached Audio:</label>

                                  <div class="col-sm-8 pb">
                                    <input type="hidden" name="audio_link" class="form-control input-lg" value="<?php echo $data['attached_audio'] ?>">
                                    <audio controls>
                                      <source src="<?php echo base_url().$data['attached_audio'] ?>" type="audio/mp3">
                                    </audio><br/>
                                    <h4 class="">--------OR---------</h4><br/>
                                    <h4>Replace with new Audio</h4>
                                    <input type="file" name="attaudio" class="form-control input-lg"><br/>
                                  </div>

                              </div><br/>

                               <div class="form-group">
                                <label class="col-sm-4 control-label">Payment Status for Course:</label>
                                <div class="col-sm-8">
                                    <select name="payment_status" class="form-control input-lg">
                                      <option value="<?php echo $data['payment_status'] ?>"><?php echo $data['payment_value'] ?></option>
                                      <?php foreach($payment_status as $key => $value): ?>
                                          <option value="<?php echo $value['p_id'] ?>"><?php echo $value['payment_value'] ?></option>
                                      <?php endforeach; ?>  
                                    </select><br/>
                                </div>
                            </div>
                                                 
                              <div class="modal-footer modalBody">
                                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary btn-lg" name="submit"> Update Book</button>
                              
                              </div>
                          </form>
                        </div>


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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
<script type="text/javascript">
  $(document).on('change', 'select#subSection', function(e){
      e.preventDefault();
      var subsection = $(this).val();
      getGreTopics(subsection);
  });

  function getGreTopics(subsection){
      $.ajax({
        url:'<?php echo base_url()."get_topics" ?>',
        type:'POST',
        data:{subsection: subsection},
        dataType:'json',
        success: function(response){

         var options ='';
         options += '<option value="">--Select IELTS Topic--</option>'; 

         for(i=0; i<response.length;i++){
              options += '<option value="'+response[i].topic+'">'+response[i].topic +'</option>';
          }

         $('#topic_name').html(options); 
        } 

      });
  }

</script>
