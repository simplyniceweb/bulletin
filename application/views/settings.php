<?php 
foreach($info as $info) { } 
$civil_status = array(
	0 => 'Single',
	1 => 'Married',
	2 => 'Widowed',
	3 => 'Divorced'
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<base href="<?php echo base_url(); ?>">
	<title>-::Web Based Generator::<?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
    <style>
		a, .glyphicon { color: green !important }
		body { background: #F1F1F1 }
	</style>
</head>
<body>
<?php require_once('includes/header.php'); ?>

<div class="container mainpage">
    <div class="row">
        <div class="col-sm-6 col-md-offset-3">
        
            <div class="panel panel-success">
            
                <div class="panel-heading">
                    <h3 class="panel-title">Personal Information</h3>
                </div>
                
                <?php echo form_open_multipart('settings/update'); ?>
                <div class="panel-body">
					<?php if(isset($_GET['update']) && $_GET['update'] == 'true'){ ?>
                        <div class="alert alert-success">Users information has been updated successfuly!</div>
                        <?php } else if(isset($_GET['update']) && $_GET['update'] == 'false'){ ?>
                        <div class="alert alert-success">Failed to update user information!</div>
                    <?php } ?>
                
                     <div class="form-group">
                     	<?php if(!empty($info->user_picture)): ?>
                        <input type="hidden" name="original_photo" value="<?php echo $info->user_picture; ?>">
                     	<img src="assets/images/<?php echo $info->user_picture; ?>" class="img-circle" width="100" height="100"/>
                        <br>
                        <?php endif; ?>
                     	<label for="student_profile_picture"><small>Profile Picture</small></label>
                    	<input type="file" id="student_profile_picture" name="userfile" class="form-control">
                    </div>
                
                     <div class="form-group">
                     	<label for="student_username"><small>Student Username</small></label>
                    	<input type="text" id="student_username" name="student_username" value="<?php echo $info->user_name; ?>" class="form-control">
                    </div>
                    
                     <div class="form-group">
                     	<label for="student_email"><small>Student Email</small></label>
                    	<input type="email" id="student_email" name="student_email" value="<?php echo $info->user_email; ?>" class="form-control">
                    </div>
                    
                     <div class="form-group">
                     	<label for="civil_status"><small>Civil Status</small></label>
                    	<select id="civil_status" name="civil_status" class="form-control">
                        <?php for($x=0; $x<count($civil_status); $x++) { ?>
                        	<option <?php if( $info->user_civil_status ==$x){?>selected="selected"<?php }?> value="<?php echo $x; ?>">
                            <?php echo $civil_status[$x]; ?>
                            </option>
                        <?php } ?>
                        </select>
                    </div>
                    
                     <div class="form-group">
                     	<label for="student_address"><small>Student Address</small></label>
                    	<input type="text" id="student_address" name="student_address" value="<?php if(!empty($info->user_address)) echo $info->user_address; ?>" class="form-control">
                    </div>
                    
                     <div class="form-group">
                     	<label for="student_phone_number"><small>Student Phone Number</small></label>
                    	<input type="text" id="student_phone_number" name="student_phone_number" value="<?php if(!empty($info->user_phone_number)) echo $info->user_phone_number; ?>" class="form-control">
                    </div>
                    
                     <div class="form-group">
                     	<label for="student_birthday"><small>Student Birthday</small></label>
                    	<input type="date" id="student_birthday" name="student_birthday" value="<?php  if($info->user_birthday != "0000-00-00 00:00:00") echo date('Y-m-d', strtotime($info->user_birthday)); ?>" class="form-control">
                    </div>
                    
                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                </div>
                <?php echo form_close(); ?>
            </div>
            
            
        </div>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>
</body>
</html>
