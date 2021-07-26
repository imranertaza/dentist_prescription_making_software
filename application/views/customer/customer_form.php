<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add Patient
        <small>Add a new Patient</small>
        <?php echo anchor(site_url('customer/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Patient</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">Add</li>
      </ol>
      

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
    
<div class="box">
        <div class="box-header">
            <h3 class="box-title">Patient <?php echo $button ?></h3>
        </div>
        <div class="box-body">
    

        <form action="<?php echo $action; ?>" method="post">
	        <div class="form-group">
              <label for="varchar">Name <?php echo form_error('name') ?></label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
          </div>

          <div class="form-group">
              <label for="varchar">Age <?php echo form_error('age') ?></label>
              <input type="text" class="form-control" name="age" id="age" placeholder="Age" value="<?php echo $age; ?>" />
          </div>

          <div class="form-group">
              <label for="varchar">Phone <?php echo form_error('phone') ?></label>
              <input type="text" class="form-control" name="phone" id="phone" placeholder="phone" value="<?php echo $phone; ?>" />
              <small>like: 01710 000000</small>
          </div>

          <div class="form-group">
              <label for="varchar">Password <?php echo form_error('password') ?></label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="" />
          </div>

          <div class="form-group">
              <label for="varchar">Confirm Password <?php echo form_error('password') ?></label>
              <input type="password" class="form-control" name="con_password" id="con_password" placeholder="Password" value="" />
          </div>




    	    <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" /> 
    	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
    	    <a href="<?php echo site_url('customer') ?>" class="btn btn-default">Cancel</a>
    	</form>
    </div></div></div></section></div>