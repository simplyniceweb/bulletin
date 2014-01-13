<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>Bulletin Board</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
    <style>
		.table { border: 1px solid #CCC; text-align: center }
		.calendar-action:first-child { text-align:left }
		.calendar-action:last-child { margin-left: 75px }
	</style>
</head>
<body>
<?php require_once('includes/header.php'); ?>
<div class="container">
	<div class="row">
        <div class="calendar-wrapper col-md-7 col-md-offset-2">
        	<?php echo $this->calendar->generate(date("Y"),date("m"),$activity); ?>
        </div>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>
</body>
</html>