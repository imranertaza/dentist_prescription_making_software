<div class="content-wrapper">
    <section class="content-header">
      	<h1>Serial List <small>List of all Serial</small></h1>
      	<ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Serial</a></li>
        	<li class="active">List</li>
      	</ol>
    </section>

    
    <section class="content">
      	<div class="row">
        	<div class="col-xs-8">  
				<div class="box">
        			<div class="box-header">
            			<h3 class="box-title">Serial List</h3>
        			</div>
        			<div class="box-body">
        				<table class="table table-bordered table-striped">
	            			<thead>
	            				<tr>
	            					<th>Sl</th>
	            					<th>Date</th>
	            				</tr>
	            			</thead>
	            			<tbody>
	            				<?php  $i = 1; foreach ($serial as $row) { ?>
	            				<tr>
	            					<td><?php echo $i++;?></td>
	            					<td><?php echo $row->date;?></td>
	            				</tr>
	            				<?php } ?>
	            			</tbody>
	            			<tfoot>
	            				<tr>
	            					<th>Sl</th>
	            					<th>Date</th>
	            				</tr>
	            			</tfoot>
	            		</table>

					</div>
				</div>
			</div>
		
        	<div class="col-xs-4">  
				<div class="box">
        			<div class="box-header">
            			<h3 class="box-title">Serial Booking</h3>
        			</div>
        			<div class="box-body">
        				<form action="<?php echo site_url('dashboard/booking');?>" method="post" >
        					<div class="form-group">
        						<label>Date</label>
        						<input type="date" name="date" class="form-control" required>
        					</div>

        					<div class="form-group">
        						<button type="submit" class="btn btn-primary " >Booking</button>
        					</div>
        				</form>

					</div>
				</div>
			</div>
		</div>
	</section>
</div>