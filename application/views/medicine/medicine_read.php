<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Medicine View
        <small>View of all Medicine</small>
        <?php echo anchor(site_url('medicine/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Medicine</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">View</li>
      </ol>
      

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
    
<div class="box">
        <div class="box-header">
            <h3 class="box-title">Medicine Read</h3>
        </div>
        <div class="box-body">
        
        <table class="table">
	    <tr><td>Name</td><td><?php echo $name; ?></td></tr>
	    <tr><td>Cat Id</td><td><?php echo $cat_id; ?></td></tr>
	    <tr><td>Com Id</td><td><?php echo $com_id; ?></td></tr>
	    <tr><td>Type</td><td><?php echo $type; ?></td></tr>
	    <tr><td>Date Time</td><td><?php echo $date_time; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('medicine') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table></div></div></div></div></section></div>