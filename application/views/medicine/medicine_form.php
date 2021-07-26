<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add Medicine
        <small>Add a new Medicine</small>
        <?php echo anchor(site_url('medicine/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Medicine</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">Add</li>
      </ol>
      

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
    
<div class="box">
        <div class="box-header">
            <h3 class="box-title">Medicine <?php echo $button ?></h3>
        </div>
        <div class="box-body">
    

        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Name <?php echo form_error('name') ?></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Category Name <?php echo form_error('cat_id') ?></label>
            <div class="form-group">
                <select name="cat_id" class="form-control" id="cat_id">
                  <?php print getDropDownCategory($cat_id); ?>
                </select>
            </div>
        </div>
	    <div class="form-group">
            <label for="int">Company Name <?php echo form_error('com_id') ?></label>
            <div class="form-group">
                <select name="com_id" class="form-control" id="com_id">
                  <?php print getDropDownCompany($com_id); ?>
                </select>
            </div>
        </div>
	    <div class="form-group">
            <label for="type">Type <?php echo form_error('type') ?></label>
            <select name="type" class="form-control" id="type">
            <?php print getDropDownType($type); ?>
          </select>
        </div>
	    <input type="hidden" name="med_id" value="<?php echo $med_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('medicine') ?>" class="btn btn-default">Cancel</a>
	</form>
    </div></div></div></section></div>