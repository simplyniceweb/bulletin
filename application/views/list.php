<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <base href="<?php echo base_url(); ?>"/>
	<title>Bulletin Board::{title}</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css"/>
    <style>
		a, .glyphicon { color: green !important }
		body { background: #F1F1F1 }
		ul.image > li{ list-style-type: none; margin: 5px; float: left }
		ul.image > li > i { background-color: #000; color: #FFF; }
		.announcement-img { position: relative }
		.glyphicon.glyphicon-remove-circle { cursor:pointer; margin-left: 5px; top: 5px; position: absolute; }
	</style>
</head>
<body>
<?php require_once('includes/header.php'); ?>
<div class="container">
	<div class="row">
    <?php if(!$announcement) { ?>
    	<div class="alert alert-danger">
        	<p>The announcement might be:</p>
            <strong><small>Deleted</small></strong><br>
            <strong><small>Expired</small></strong><br>
            <strong><small>Does not exist</small></strong>
        </div>
	<?php } ?>

    <?php foreach( $announcement as $ann ) { ?>
		 <?php if($session['user_level'] == 99) { ?>
        <div class="btn-group pull-right">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            Action <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a href="a/e/{id}"><i class="glyphicon glyphicon-wrench"></i> Edit</a></li>
            <li><a class="announcement-delete" href="javascript:;"><i class="glyphicon glyphicon-remove"></i> Delete</a></li>
          </ul>
        </div>
 		<br><br>
        <?php } ?>
        <div class="panel panel-success">
            <div class="panel-heading">
                <div class="pull-right">
                    <i class="glyphicon glyphicon-calendar"></i> <strong><small><?php echo date('M d, Y', strtotime($ann->announcement_start)); ?> <strong>-</strong> <?php echo date('M d, Y', strtotime($ann->announcement_end)); ?></small></strong>
                </div>
				<h3 class="panel-title"><i class="glyphicon glyphicon-bookmark"></i> <?php echo ucfirst($ann->announcement_title); ?></h3>
            </div>
            <div class="panel-body">
            	<?php echo ucfirst(nl2br(htmlspecialchars($ann->announcement_description))); ?>
            </div>
        </div>
        <ul class="image">
            <?php
                $this->db->from('announcement_image');
                $this->db->where('status', 0);
                $this->db->where('announcement_id', $ann->announcement_id);
                $images = $this->db->get();
                foreach($images->result() as $img) {
            ?>
            <li class="announcement-img">
            <i class="glyphicon glyphicon-remove-circle" data-entry-id="<?php echo $img->image_id; ?>"></i>
            <img src="assets/announcement/<?php echo $img->image_name; ?>" class="img-square img-<?php echo $img->image_id; ?>"  style="padding: 3px; border: 1px solid #CCC; background: #FFF; width: 150px; height: 150px">
            </li>
            <?php } ?>
        </ul>
	<?php } ?>
    </div>
</div>
<input type="hidden" value="{id}" class="announcement-id"/>
<?php require_once('includes/footer.php'); ?>
</body>
</html>
