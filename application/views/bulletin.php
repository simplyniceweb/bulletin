<?php
$end         = NULL;
$start       = NULL;
$title       = NULL;
$category    = NULL;
$description = NULL;

if(!is_null($announcement)) { 
	foreach($announcement as $ann) {
		$end         = $ann->announcement_end;
		$start       = $ann->announcement_start;
		$title       = $ann->announcement_title;
		$category    = $ann->announcement_category;
		$description = $ann->announcement_description;
	}
}
?>
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
		ul > li{ list-style-type: none; margin: 5px; float: left }
		ul > li > i { background-color: #000; color: #FFF; }
		.announcement-img { position: relative }
		.glyphicon-remove-circle { cursor:pointer; margin-left: 5px; top: 5px; position: absolute; }
	</style>
</head>
<body>
<?php require_once('includes/header.php'); ?>
<div class="container">
	<div class="row">
	<?php if(isset($_GET['add']) && $_GET['add'] == 'true'): ?>
        <div class="alert alert-success">Announcement has been added successfuly!</div>
    <?php endif; ?>
	<?php if(isset($_GET['update']) && $_GET['update'] == 'true'): ?>
        <div class="alert alert-success">Announcement has been updated successfuly!</div>
    <?php endif; ?>
	<?php if(isset($_GET['date']) && $_GET['date'] == 'start_less'): ?>
        <div class="alert alert-danger">Announcement starting date should not be less than the date today.</div>
    <?php endif; ?>
	<?php if(isset($_GET['date']) && $_GET['date'] == 'end_less'): ?>
        <div class="alert alert-danger">Announcement end date should not be less than the date of announcement start.</div>
    <?php endif; ?>
	<?php if(isset($_GET['date']) && $_GET['date'] == 'equal'): ?>
        <div class="alert alert-danger">Announcement end date should not be equal than the announcement starting date.</div>
    <?php endif; ?>
    
        <div class="col-md-7 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Add announcement</h3>
                </div>
                
                <div class="panel-body">
                <?php echo form_open_multipart('bulletin/process'); ?>
                    <div class="form-group">
                        <label for="announcement_category"><small>Announcement Category</small></label>
                        <select id="announcement_category" class="form-control" name="announcement_category" required>
                            <option value="">Choose Department</option>
                            <option <?php if(!is_null($category) && $category == 0) { echo "selected='selected'"; }?> value="0">General</option>
                            <?php foreach($department as $did) { ?>
                            <option <?php if(!is_null($category) && $category == $did->department_id) { echo "selected='selected'"; }?> value="<?php echo $did->department_id; ?>"><?php echo $did->department_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                    	<label for="announcement_start"><small>Start of announcement</small></label>
                        <input type="date" id="announcement_start" class="form-control" name="announcement_start" value="<?php if(!is_null($start)) echo date('Y-m-d', strtotime($start)); ?>" required="required">
                    </div>
                    
                    <div class="form-group">
                    	<label for="announcement_end"><small>End of announcement</small></label>
                        <input type="date" id="announcement_end" class="form-control" name="announcement_end" value="<?php if(!is_null($end)) echo date('Y-m-d', strtotime($end)); ?>" required="required">
                    </div>
                    
                    <div class="form-group">
                    	<label for="announcement_title"><small>Announcement Title</small></label>
                        <input type="text" id="announcement_title" class="form-control" name="announcement_title" value="<?php echo $title; ?>" required="required">
                    </div>
                    
                    <div class="form-group">
                    	<label for="announcement_description"><small>Announcement Description</small></label>
                        <textarea type="text" id="announcement_description" class="form-control" name="announcement_description" required><?php echo $description; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                    	<?php if($action == 0) { ?>
                    	<label for="announcement_image"><small>Announcement Image</small></label>
                        <?php } else { ?>
                        <label for="announcement_image"><small>Announcement Image <span style="color:red">[ ADD ]</span></small></label>
                        <?php } ?>
                       <input type="file" name="announcement_image[]" id="announcement_image" class="form-control" multiple>
                    </div>
                    <button type="submit" class="pull-right btn btn-success">Save</button>
					<?php if($action != 0) { ?>
                        <ul>
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
                    <input type="hidden" name="action" value="<?php echo $action; ?>"/>
				<?php echo form_close(); ?>
                </div>
                
                
            </div>
        </div>
        
        
    </div>
</div>

<?php require_once('includes/footer.php'); ?>
</body>
</html>
