<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Patient List
        <small>List of all Patient</small>
        <?php echo anchor(site_url('customer/create'),'+ Add', 'class="btn btn-primary"'); ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Patient</a></li>
        <!--<li><a href="#">List</a></li>-->
        <li class="active">List</li>
      </ol>
      
      <div class="text-right">
            <form action="<?php echo site_url('customer/index'); ?>" class="form-inline" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                    <span class="input-group-btn">
                        <?php 
                            if ($q <> '')
                            {
                                ?>
                                <a href="<?php echo site_url('customer'); ?>" class="btn btn-default">Reset</a>
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
            <h3 class="box-title">Patient List</h3>
        </div>
        <div class="box-body">
            
            <div class="col-md-12 text-center">
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
        <th>Phone</th>
        <th>Age</th>
		<th>Date</th>
		<th>Action</th>
            </tr></thead><tbody><?php
            foreach ($customer_data as $customer)
            {
                ?>
               <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $customer->name ?></td>
            <td>0<?php echo $customer->phone ?></td>
            <td><?php echo $customer->age ?></td>
			<td><?php echo $customer->createDTM ?></td>
			<td width="180px">
				<?php 
				// echo anchor(site_url('customer/read/'.$customer->customer_id),'View', 'class="btn btn-xs btn-info"'); 
				// echo ' '; 
				echo anchor(site_url('customer/update/'.$customer->customer_id),'Update', 'class="btn btn-xs btn-warning"'); 
				echo ' '; 
				echo anchor(site_url('customer/delete/'.$customer->customer_id),'Delete', 'class="btn btn-xs btn-danger" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
        <th>Phone</th>
        <th>Age</th>
		<th>Date</th>
		<th>Action</th>
            </tr></tfoot>
            
        </table>
        </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('customer/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('customer/word'), 'Word', 'class="btn btn-primary"'); ?>
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