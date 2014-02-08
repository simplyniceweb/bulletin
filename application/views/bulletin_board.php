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
		.bulletin-stage { margin: 5px; }
		a[href*="http://"].badge { color: #FFF !important; background: green !important }
		.table { background: #FFF; border: 1px solid #CCC; }
		.nav.nav-pills { background: #FFF }
		li.active a{ color: #FFF !important }
	</style>
</head>
<body>
<?php require_once('includes/header.php'); ?>
<div class="container">
	<div class="row">
        <div class="col-sm-8 bulletin-stage">
            <?php if($session['user_level'] == 99) { ?>
                <select id="department_id" class="form-control" name="department_id">
                    <option value="">Choose Category</option>
                    <option value="0">General</option>
                    <?php foreach($department as $did) { ?>
                    <option value="<?php echo $did->department_id; ?>"><?php echo $did->department_name; ?></option>
                    <?php } ?>
                </select>
            <?php } else { ?>
            <ul class="nav nav-pills nav-justified">
				<?php foreach($department as $dept) { ?>
                <li class="active" data-tab-id="<?php echo $dept->department_id; ?>"><a href="javascript: void(0);"><?php echo $dept->department_name; ?> <span class="badge pull-right"><?php echo $counter ;?></span></a></li>
                <li data-tab-id="0"><a href="javascript: void(0);">General <span class="badge pull-right"><?php echo $general; ?></span></a></li>
                <?php } ?>
			</ul>
            <?php } ?>
        </div>
        <div class="calendar-wrapper col-md-3">
        	<?php echo $this->calendar->generate(date("Y"),date("m"),$activity); ?>
        </div>
	</div>
	<div class="row">
    	<br><br><br>
        <div class="panel panel-success">
            <div class="panel-heading">
				<h3 class="panel-title">List of announcements</h3>
            </div>
            
            <div class="panel-body">
            	<ul class="list-group bulletin-list">
				<?php if(!$announcement) { ?>
                        <div class="alert alert-warning  list-group-item">There are no announcement for general category.</div>
                <?php } ?>
                <?php foreach( $announcement as $ann ) { ?>
                    <li class="list-group-item">
                    	<div class="pull-right">
                        	<small><?php echo date('M d, Y', strtotime($ann->announcement_start)); ?> <strong>-</strong> <?php echo date('M d, Y', strtotime($ann->announcement_end)); ?></small>
                        </div>
                    	<p><a href="a/<?php echo $ann->announcement_id; ?>"><?php echo ucfirst($ann->announcement_title); ?></a></p>
                    	<?php echo ucfirst(nl2br(htmlspecialchars($ann->announcement_description))); ?>
                    </li>
                <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php require_once('includes/footer.php'); ?>
<script>
	$(document).ready(function(){
		$('a[href*="http://"]').addClass( "badge" );
	})
</script>

</body>
</html>
