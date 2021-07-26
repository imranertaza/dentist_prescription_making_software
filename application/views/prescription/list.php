<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      	<h1>Prescription <small>List</small> </h1>
      	<ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Prescription</a></li>
        	<li class="active">List</li>
      	</ol>
    </section>

    <!-- Main content -->
    <section class="content">
      	<div class="row">
	        <div class="col-xs-12">
	          	<div class="box">
	            	<div class="box-header">
	              		<h3 class="box-title">Prescription List</h3>
	            	</div>
	            	<!-- /.box-header -->
	            	<div class="box-body">
	            		<table class="table table-bordered table-striped" id="example1">
	            			<thead>
	            				<tr>
	            					<th>Sl</th>
	            					<th>Patient Name</th>
	            					<th>Phone</th>
	            					<th>Action</th>
	            				</tr>
	            			</thead>
	            			<tbody>
	            				<?php $i= 1; foreach ($prescription as $row) { ?>
	            				<tr>
	            					<td><?php echo $i++; ?></td>
	            					<td><?php echo get_data_by_id('name','customer','customer_id',$row->customer_id); ?></td>
	            					<td><?php echo get_data_by_id('phone','customer','customer_id',$row->customer_id); ?></td>
	            					<td>
	            						<a href="<?php echo site_url('prescriptionList/read/'.$row->prescription_id) ; ?>" class="btn btn-info btn-xs">View</a>
	            						
	            							
	            					</td>
	            				</tr>
	            				<?php } ?>

	            			</tbody>

	            		</table>
	            	</div>
	        	</div>
	        </div>
                
      	</div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>





