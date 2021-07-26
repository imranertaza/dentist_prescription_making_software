<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add Advice
        <small>Add a new Advice</small>
        <?php echo anchor(site_url('advice/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Advice</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">Add</li>
      </ol>
      

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
    
<div class="box">
        <div class="box-header">
            <h3 class="box-title">Advice <?php echo $button ?></h3>
        </div>
        <div class="box-body">
    

        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="advice">Advice <?php echo form_error('advice') ?></label>
            <textarea class="form-control" rows="3" name="advice" id="advice" placeholder="Advice"><?php echo $advice; ?></textarea>
        </div>
	    <input type="hidden" name="ad_id" value="<?php echo $ad_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('advice') ?>" class="btn btn-default">Cancel</a>
	</form>
    </div></div></div></section></div>