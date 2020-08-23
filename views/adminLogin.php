<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
	.wrap{
		max-width: 1170px;
		margin: 25px auto;
	}

	.paddings{
		padding:0 20px;
	}
	.left{
		float: left !important;
	}
	.right{
		float: right!important;
	}

	.margings{
		margin-top: 40px!important;
	}

	@media screen and (max-width:640px){
		.marg{
			margin-left: 0px;
		}

		.input-group{
			margin-top:20px;
		}

		.margings{
		margin-top: 20px!important;
	}

	.head-size{
			font-size: 18px;
			margin-top:13px;
		}

		section{
			height: 530px;
		}

	} 

	@media screen and (min-width:640px){
		.marg{
			margin-left:30px;
		}

		body{
			font-size: 15px;
		}
		.hedpads{
			/*padding: 25px 25px 6px 25px;*/
		}

		.head-size{
			font-size: 30px;
			margin-top:16px;
		}

		section{
			height: 650px;
		}

		.login-box {
    width: 400px;
    margin: 0% auto;
}
	} 

	.heders{
		padding: 10px;
		background-color: #2f3562;

	}


	.input-group .input-group-addon {
   
		background-color:#2f3562!important;
	}

	.input-group-addon {
  
    	color: white;
	}

	body{
		color: #2f3562 !important;
		background-color:  #f2f3f4 !important;
	}

	html{
		background-color:  #f2f3f4;
	}

</style>

<body>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 heders">
	<div class="col-md-4 col-sm-2 col-xs-2">
		<img class="img-responsive" src="<?php echo base_url('assets/images/shah_overseas.png')?>">
	</div> 
	<div class="col-md-8 col-sm-10 col-xs-10 head-size" style="font-weight: bold; ">
		<span class="hedpads" style="color: white; background-color: #DC2E27; padding: 10px; border-radius: 4px; margin: 0% auto;">
			Online Library System
		</span>
	</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12" style="min-height: 70px;">
</div>
<section class="hold-transition login-page">
	
		<div class="login-box">
		  <div class="login-logo">
		    <a href=""><b>Admin</b>&nbsp;Login</a>
		  </div>
		  <!-- /.login-logo -->
		  <div class="login-box-body">
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
		    <p class="login-box-msg">Sign in to register Students </p>

		    <form action="admin_signin" method="post">
		      <div class="form-group has-feedback">
		        <input type="email" name="username" class="form-control input-lg" placeholder="Email">
		        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		      </div>
		      <div class="form-group has-feedback">
		        <input type="password" name="password" class="form-control input-lg" placeholder="Password">
		        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		      </div>
		      <div class="row">
		        <div class="col-xs-8">
		          <div class="checkbox icheck">
		            <label>
		              
		            </label>
		          </div>
		        </div>
		        <!-- /.col -->
		        <div class="col-xs-4">
		          <button type="submit" class="btn btn-primary btn-block btn-flat" style="font-size: 18px;">Log In</button>
		        </div>
		        <!-- /.col -->
		      </div>
		    </form>

		    <!-- /.social-auth-links -->

		  </div>
		  <!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->
</section>
