<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>Bulletin Board::Register</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
	<style>
	body{ background: #F1F1F1 }
	.form_class { background: #FFF; padding: 10px }
	.colorgraph {
	  height: 5px;
	  border-top: 0;
	  background: #c4e17f;
	  border-radius: 5px;
	  background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
	  background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
	  background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
	  background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
	}
	</style>
</head>
<body>
<div class="container">

	<div class="row">
		<div class="col-sm-8 col-md-offset-2">
		<?php echo form_open('register/process', array('class' => 'form_class')); ?>
		<?php if(isset($_GET['std_id']) && $_GET['std_id'] == "invalid"): ?>
		<div class="form-group">
			<div class="alert alert-danger">
				Invalid Student Number!
			</div>
		</div>
		<?php endif; ?>
		
		<?php if(isset($_GET['used_id']) && $_GET['used_id'] == "true"): ?>
		<div class="form-group">
			<div class="alert alert-danger">
				Invalid Student Number!
			</div>
		</div>
		<?php endif; ?>
	
		<?php if(isset($_GET['add']) && $_GET['add'] == "true"): ?>
		<div class="form-group">
			<div class="alert alert-success">
				Successful registration!
				<br>
				<a href="">Sign In!</a>
			</div>
		</div>
		<?php endif; ?>
			<legend><h2>REGISTER</h2></legend>
			<hr class="colorgraph">
			<div class="form-group">
				<input type="text" name="user_name" class="form-control input-lg" required="required" placeholder="Full Name">
			</div>
			
			<div class="form-group">
				<input type="email" name="user_email" class="form-control input-lg" required="required" placeholder="Email Address">
			</div>

			<div class="form-group">
				<input type="password" name="user_password" class="form-control input-lg" required="required" placeholder="Password">
			</div>

			<div class="form-group">
				<input type="date" name="user_birthday" class="form-control input-lg" required="required" placeholder="Birthday">
			</div>
			
			<div class="form-group">
				<input type="text" name="user_std_id" class="form-control input-lg" required="required" placeholder="Student Number">
			</div>
			<hr class="colorgraph">
			<div class="form-group">
				<button class="btn btn-lg btn-primary btn-block">
					<small>Register</small>
				</button>
			</div>
			
			<h3><a class="col-md-offset-4" href="">Have an account? Sign In!</a></h3>
		<?php echo form_close(); ?>
		</div>
	</div>

</div>
<?php require_once('includes/footer.php'); ?>
</body>
</html>
