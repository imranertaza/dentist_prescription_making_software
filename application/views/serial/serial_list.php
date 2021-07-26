<div class="content-wrapper">
    <section class="content-header">
      	<h1>Serial List <small>List of all Serial</small></h1>
      	<ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Serial</a></li>
        <!--<li><a href="#">List</a></li>-->
        	<li class="active">List</li>
      	</ol>
    </section>

    
    <section class="content">
      	<div class="row">
        	<div class="col-xs-12">
        
    
				<div class="box">
        			<div class="box-header">
            			<h3 class="box-title">Serial List</h3>
        			</div>
        			<div class="box-body">
        				<table class="table table-bordered table-striped">
	            			<thead>
	            				<tr>
	            					<th>Sl</th>
	            					<th>Patient Name</th>
	            					<th>Phone</th>
	            					<th>Date</th>
	            				</tr>
	            			</thead>
	            			<tbody>
	            				<?php $i=1; foreach ($serial as $row) { ?>
	            				<tr>
	            					<td><?php echo $i++;?></td>
	            					<td><?php echo get_data_by_id('name','customer','customer_id',$row->customer_id);?></td>
	            					<td><?php echo get_data_by_id('phone','customer','customer_id',$row->customer_id);?></td>
	            					<td><?php echo $row->date;?></td>
	            				</tr>
	            				<?php } ?>
	            			</tbody>
	            			<tfoot>
	            				<tr>
	            					<th>Sl</th>
	            					<th>Patient Name</th>
	            					<th>Phone</th>
	            					<th>Date</th>
	            				</tr>
	            			</tfoot>
	            		</table>

					</div>
				</div>
			</div>
		</div>
	</section>
</div>