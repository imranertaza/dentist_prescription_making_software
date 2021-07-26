<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add Category
        <small>Add a new Category</small>
        <?php echo anchor(site_url('category/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Category</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">Add</li>
      </ol>
      

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
    
<div class="box">
        <div class="box-header">
            <h3 class="box-title">Category <?php echo $button ?></h3>
        </div>
        <div class="box-body">
    

        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Name <?php echo form_error('name') ?></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
        </div>
	    <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('category') ?>" class="btn btn-default">Cancel</a>
	</form>
    </div></div></div></section></div>