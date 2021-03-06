<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<base href="<?php echo base_url(); ?>">
	<title>Student Number</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
    <style>
		a, .glyphicon { color: green !important }
		body { background: #F1F1F1 }
	</style>
</head>
<body>
<?php require_once('includes/header.php'); ?>	
<div class="container">
	<div class="row">
    
	<?php if(isset($_GET['exist']) && $_GET['exist'] == "true") { ?>
    <div class="alert alert-danger">The Department name that you added is already in the database.</div>
    <?php } else if(isset($_GET['unique']) && $_GET['unique'] == "false") { ?>
    <div class="alert alert-danger">Please enter a unique department name.</div>
	<?php } ?>

    	<div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Add Department</h3>
                </div>
                
                <div class="panel-body">
                    <?php echo form_open('department/department_add'); ?>
                    <div class="form-group">
                    <label for="student_id_text"><small>Department Name</small></label>
                    <input type="text" id="student_id_text" class="form-control" name="department_name">
                    </div>
                    <button type="submit" class="btn btn-success">Store</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        
        
    	<div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Department</h3>
                </div>
                
                <div class="panel-body">
                    <?php echo form_open('department/department_edit'); ?>
                    <div class="form-group">
                        <label for="student_id_edit"><small>Department Name</small></label>
                        <select id="student_id_edit" class="form-control" name="department_name">
                            <option value="0">Select To Edit Department</option>
                            <?php foreach($department as $did) { ?>
                            <option value="<?php echo $did->department_id; ?>"><?php echo $did->department_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                     <div class="form-group">
                     	<label for="student_id_new"><small>New Department Name</small></label>
                    	<input type="text" id="student_id_new" name="new_department_name" class="form-control" >
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        
    	<div class="col-md-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Delete Department</h3>
                </div>
                
                <div class="panel-body">
                <?php echo form_open('department/department_delete'); ?>
                <div class="form-group">
                	<label for="student_id_delete"><small>Department Name</small></label>
                    <select id="student_id_delete" class="form-control" name="department_name">
                        <option value="0">Select To Delete Department</option>
                        <?php foreach($department as $did) { ?>
                        <option value="<?php echo $did->department_id; ?>"><?php echo $did->department_name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-danger">Delete</button>
                <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        

    </div>
</div>

<?php require_once('includes/footer.php'); ?>
</body>
</html>
