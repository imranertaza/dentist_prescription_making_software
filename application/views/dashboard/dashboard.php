<div class="content-wrapper">
    <section class="content-header">
      	<h1>Dashboard <small>Customer Dashboard</small></h1>
      	<ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <!--<li><a href="#">List</a></li>-->
        	<li class="active">List</li>
      	</ol>
    </section>

    
    <section class="content">
      	<div class="row">
        	<div class="col-xs-12">
        
    
				<div class="box">
        			<div class="box-header">
            			<h3 class="box-title">Prescription List</h3>
        			</div>
        			<div class="box-body">
        				<table class="table table-bordered table-striped">
	            			<thead>
	            				<tr>
	            					<th>Sl</th>
	            					<th>Date</th>
	            					<th>Action</th>
	            				</tr>
	            			</thead>
	            			<tbody>
	            				<?php $i = 1; foreach ($prescription as $row) { ?>
	            				<tr>
	            					<td><?php echo $i++;?></td>
	            					<td><?php echo $row->createDTM;?></td>
	            					<td><a href="<?php echo site_url('dashboard/read/'.$row->prescription_id);?>" class="btn btn-info btn-xs" >View</a></td>
	            				</tr>
	            				<?php } ?>
	            			</tbody>
	            			<tfoot>
	            				<tr>
	            					<th>Sl</th>
	            					<th>Date</th>
	            					<th>Action</th>
	            				</tr>
	            			</tfoot>
	            		</table>

					</div>
				</div>
			</div>
		</div>
	</section>
</div>