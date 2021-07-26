<div class="box" style="width: 1065px; float: right; background: #fff; padding: 20px; margin-bottom: 100px;">
        <h2 style="margin-top:0px">Actor <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Fullname <?php echo form_error('fullname') ?></label>
            <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Fullname" value="<?php echo $fullname; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Last Update <?php echo form_error('last_update') ?></label>
            <input type="text" class="form-control" name="last_update" id="last_update" placeholder="Last Update" value="<?php echo $last_update; ?>" />
        </div>
	    <input type="hidden" name="actor_id" value="<?php echo $actor_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('actor') ?>" class="btn btn-default">Cancel</a>
	</form>
    </div>