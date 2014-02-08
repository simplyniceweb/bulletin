<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>Bulletin Board</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
    <style>
		a, .glyphicon { color: green !important }
		body { background: #F1F1F1 }
		.table { border: 1px solid #CCC }
	</style>
</head>
<body>
<?php require_once('includes/header.php'); ?>
<div class="container">
	<div class="row">
    
        <div class="panel panel-success">
            <div class="panel-heading">
				<h3 class="panel-title">Bulletin Board</h3>
            </div>
            
            <div class="panel-body">
            	<ul class="list-group">
                	<li class="list-group-item"><i class="glyphicon glyphicon-calendar"></i> <a href="calendar">View Calendar</a></li>
                	<li class="list-group-item"><i class="glyphicon glyphicon-list-alt"></i> <a href="homepage">View Bulletin Board</a></li>
                    <li class="list-group-item"><i class="glyphicon glyphicon-plus"></i> <a href="bulletin">Add Bulletin Board</a></li>
                    <li class="list-group-item"><i class="glyphicon glyphicon-briefcase"></i> <a href="department">Add Department</a></li>
                    <li class="list-group-item"><i class="glyphicon glyphicon-user"></i> <a href="studentnumber">Add Student Number</a></li>
                    <li class="list-group-item"><i class="glyphicon glyphicon-wrench"></i> <a href="admin/edit_user">Edit User</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>
</body>
</html>
