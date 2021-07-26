<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Medicine List
        <small>List of all Medicine</small>
        <?php echo anchor(site_url('medicine/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Medicine</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">List</li>
      </ol>
      
      <div class="text-right">
            <form action="<?php echo site_url('medicine/index'); ?>" class="form-inline" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                    <span class="input-group-btn">
                        <?php 
                            if ($q <> '')
                            {
                                ?>
                                <a href="<?php echo site_url('medicine'); ?>" class="btn btn-default">Reset</a>
                                <?php
                            }
                        ?>
                      <button class="btn btn-primary" type="submit">Search</button>
                    </span>
                </div>
            </form>
        </div>
    </section>

    
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
    
<div class="box">
        <div class="box-header">
            <h3 class="box-title">Medicine List</h3>
        </div>
        <div class="box-body">
            
            <div class="col-md-8 text-center">
                <div style="margin-top: 12px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        <div class="row"/>
        <div class="col-md-12">
        <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
		<th>Name</th>
		<th>Category</th>
		<th>Company</th>
		<th>Type</th>
		<th>Date Time</th>
		<th>Action</th>
            </tr></thead><tbody><?php
            foreach ($medicine_data as $medicine)
            {
                ?>
               <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $medicine->name ?></td>
			<td><?php echo getCategoryNameById($medicine->cat_id); ?></td>
			<td><?php echo getCompanyNameById($medicine->com_id); ?></td>
			<td><?php echo $medicine->type ?></td>
			<td><?php echo $medicine->date_time ?></td>
			<td width="180px">
				<?php 
				echo anchor(site_url('medicine/read/'.$medicine->med_id),'View', 'class="btn btn-xs btn-info"'); 
				echo ' '; 
				echo anchor(site_url('medicine/update/'.$medicine->med_id),'Update', 'class="btn btn-xs btn-warning"'); 
				echo ' '; 
				echo anchor(site_url('medicine/delete/'.$medicine->med_id),'Delete', 'class="btn btn-xs btn-danger"', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
            </tbody>
            
            <tfoot>
            <tr>
                <th>No</th>
		<th>Name</th>
		<th>Cat Id</th>
		<th>Com Id</th>
		<th>Type</th>
		<th>Date Time</th>
		<th>Action</th>
            </tr></tfoot>
            
        </table>
        </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('medicine/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('medicine/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
</div>
</div>
</div>
</section>
</div>