<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>Bulletin Board</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
	<style>
	body{ background: #F1F1F1 }
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
		<div class="col-sm-6 col-md-offset-3" style="margin-top: 150px">

		<?php if(isset($_GET['login']) && $_GET['login'] == "false"): ?>
        <div class="alert alert-danger">
            <small>Please provide the right credentials.</small>
        </div>
		<?php endif; ?>

		<?php if(isset($_GET['std']) && $_GET['std'] == "invalid"): ?>
        <div class="alert alert-danger">
            <small>Student ID does not exist.</small>
        </div>
		<?php endif; ?>

		<?php if(isset($_GET['ban']) && $_GET['ban'] == "true"): ?>
        <div class="alert alert-danger">
            <small>An adminastrator blocked you from viewing this system.</small>
        </div>
		<?php endif; ?>
		
		<?php echo form_open('login/verify'); ?>
		<h2>Please Sign Up <small>It's free and always will be.</small></h2>
		<hr class="colorgraph">
        <div class="form-group">
			<div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input type="email" name="user_email" class="form-control input-lg" placeholder="Email Address" required="required">
			</div>
        </div>
		<div class="form-group">
			<div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input type="password" name="user_password" class="form-control input-lg" placeholder="Password" required="required">
			</div>
		</div>
		<hr class="colorgraph">
		<div class="form-group">
		<button class="btn btn-primary btn-lg btn-block pull-right">Log In</button>
		</div><br />
		<h3><a href="register">Don't have an account? Register!</a></h3>
		<?php echo form_close(); ?>
		</div>
	</div>

</div>

<?php require_once('includes/footer.php'); ?>
</body>
</html>
