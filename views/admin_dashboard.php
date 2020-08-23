
<!-- 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> -->
<style type="text/css">
.float{
  position:fixed;
  width:60px;
  height:60px;
  bottom:40px;
  right:40px;
  background-color:#25d366;
  color:#FFF;
  border-radius:50px;
  text-align:center;
  font-size:30px;
  box-shadow: 2px 2px 3px #999;
  z-index:100;
}

.my-float{
  margin-top:16px;
}

</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"> Home</i></li>
      </ol>
     <!--  <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Student Profile</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">                  
        <div class="col-md-12">
        	<div class="box box-primary">
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
	              <h3 class="box-title">List of Applied Universities</h3>
	            </div>
	            <div class="box-body" style="overflow-x: scroll;">
	            	
	            </div>

        	</div>
          
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>


<!-- <div class="visible-md visible-lg">
 <a href="https://web.whatsapp.com/send?phone=+919657849086&text=Hi," class="float" target="_blank">
  <i class="fa fa-whatsapp my-float"></i>
</a>
</div>

<div class="visible-sm visible-xs">
 <a href="https://api.whatsapp.com/send?phone=+919657849086&text=Hi," class="float" target="_blank">
  <i class="fa fa-whatsapp my-float"></i>
</a>
</div> -->


<!-- <script src="<?php echo base_url('whatsapp/floating-wpp.min.js')?>"></script> -->

<!--  <div class="container">
  <div class="floating-wpp"></div>
</div> -->

<!--      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
        crossorigin="anonymous">
</script>

  <script type="text/javascript">

  $(function () {
  $('.floating-wpp').floatingWhatsApp({
    phone: '919657849086',
    popupMessage: 'Popup Message',
    showPopup: true,
    message: 'Message To Send',
    headerTitle: 'Application'
  });
});

</script>