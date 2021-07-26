<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      	<h1>Deases <small>List</small> </h1>
      	<ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Deases</a></li>
        	<li class="active">List</li>
      	</ol>
    </section>

    <!-- Main content -->
    <section class="content">
      	<div class="row">
	        <div class="col-xs-12">
	          	<div class="box">
	            	<div class="box-header">

	              		<h3 class="box-title">Deases List</h3>
	              		<a href="<?php echo site_url('digest/create')?>" class="btn btn-primary " style="float: right;">+ Add</a>
	            	</div>
	            	<div class="col-md-12 text-center">
		                <div style="margin-top: 12px" id="message">
		                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
		                </div>
		            </div>
	            	<!-- /.box-header -->
	            	<div class="box-body">
	            		<table class="table table-bordered table-striped" id="example1">
	            			<thead>
	            				<tr>
	            					<th>Sl</th>
	            					<th>Deases Name</th>
	            					<th>Action</th>
	            				</tr>
	            			</thead>
	            			<tbody>
	            				<?php $i = 1; foreach ($digest as $row) { ?>
	            				<tr>
	            					<td><?php echo $i++;?></td>
	            					<td><?php echo $row->name;?></td>
	            					<td>

	            						<a href="<?php echo site_url('digest/read/'.$row->digest_id)?>" class="btn btn-info btn-xs">View</a>
	            						<!-- <a href="<?php //echo site_url('digest/update/'.$row->digest_id)?>" class="btn btn-warning btn-xs">Update</a> -->

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





