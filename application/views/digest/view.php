<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      	<h1>Deases <small>View</small> </h1>
      	<ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Deases</a></li>
        	<li class="active">View</li>
      	</ol>
    </section>

    <!-- Main content -->
    <section class="content">
    	<div class="row">
	        <div class="col-xs-12">
	          	<div class="box">
	            	<div class="box-header">

	              		<h3 class="box-title">Deases View</h3>
	              		<a href="<?php echo site_url('digest/create')?>" class="btn btn-primary " style="float: right;"> Create</a>
	            	</div>
	            </div>
	        </div>
	    </div>
      	<div class="row">
	        <div class="col-xs-12">
	          	<div class="box">
	            	<div class="box-header">

	              		<h3 class="box-title"><b>Deases:</b> <?php echo get_data_by_id('name','digest','digest_id',$digestId) ?></h3>
	            	</div>

	            	<div class="col-md-12 text-center">
		                <div style="margin-top: 12px" id="message">
		                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
		                </div>
		            </div>
	            	<!-- /.box-header -->
	            	<div class="box-body">
	            		<table  class="table table-hover table-bordered table-striped">
	            			<thead>
	            				<tr>
			                        <th>Type</th>
			                        <th>Medicine</th>
			                        <th>Days</th>
			                        <th>Dosage</th>
			                        <th>Befor/After</th>
			                        <th>Action</th>
			                    </tr>
	            			</thead>
		                    <tbody>		                    
		                    
		                        <?php foreach($digest as $medicine) { ?>
			                    <tr>
			                        <td><?php print $medicine->type; ?></td>
			                        <td><?php print $medicine->name; ?><?php if($medicine->when == 1) { print '<span style="color:red; font-size:20px;">*</span>'; } ?></td>
			                        <td><?php print $medicine->days; ?></td>
			                        <td><?php print $medicine->dosage; ?></td>
			                        <td><?php print $medicine->before_after; ?></td>
			                        <td>
			                        	<a href="<?php echo site_url('digest/remove/'.$medicine->prescription_item_id) ?>"><i class="fa fa-window-close" aria-hidden="true" style="color: red;"></i></a>
			                        </td>
			                        
			                    </tr>
			                    <?php } ?>
			                    <!-- <tr>
			                    	<td colspan="5"><a href="<?php// echo site_url('digest');?>" style="float: right;"  class="btn btn-warning">Goback</a></td>
			                    </tr> -->
		                    </tbody>
		                </table>
	            		
	            	</div>
	        	</div>
	        </div>
                
      	
	        <div class="col-xs-12">
	          	<div class="box">
	            	<div class="box-header">

	              		<h3 class="box-title">Deases Add</h3>
	            	</div>
	            	
	            	<div class="box-body">
		                <form class="form-inline" id="add_medicine" >
		                <table class="table table-bordered table-condensed table-responsive" style="background: #7fc4ec;">
		                    <tbody>
		                    <tr>
		                        <td width="100">
		                            <div class="form-group">
		                                <select id="type_list" onchange="getLimitedCompany(this.value);" name="type" class="form-control pres_form">
		                                  <?php print getDropDownType(); ?>
		                                </select>
		                            </div>
		                        </td>
		                        <td width="100">
		                            <div class="form-group">
		                                <select id="company_list" onchange="getLimitedCategory(this.value);" name="company" class="form-control pres_form">
		                                  <?php print getDropDownCompany(); ?>
		                                </select>
		                            </div>
		                        </td>
		                        <td width="80">
		                            <div class="form-group">
		                                <input type="hidden" name="id" value="<?php print $id; ?>" />
		                                <select id="category_list" onchange="getLimitedMedicine(this.value);" name="category" class="form-control pres_form">
		                                  <?php print getDropDownCategory(); ?>
		                                </select>
		                            </div>
		                        </td>
		                        <td width="100">
		                            <div class="form-group">
		                                <select id="medicine_list" name="medicine" class="form-control pres_form">
		                                  <?php print getDropDownMedicine(); ?>
		                                </select>
		                            </div>
		                        </td>
		                    </tr>
		                    <tr>
		                        <td width="80">
		                            <div class="form-group">
		                                <select name="days" class="form-control pres_form">
		                                  <?php print getDropDownDays(); ?>
		                                </select>
		                            </div>
		                        </td>
		                        <td width="100">
		                            <div class="form-group">
		                                <select name="dosage" class="form-control pres_form">
		                                  <?php print getDropDownDosage(); ?>
		                                </select>
		                            </div>
		                        </td>
		                        <td width="80">
		                            <div class="form-group">
		                                <select name="before_after" class="form-control pres_form">
		                                    <option>Before</option>
		                                    <option>After</option>
		                                </select>
		                            </div>
		                        </td>
		                        <td width="100">
		                            <div class="form-group">
		                                <select name="when" class="form-control" style="width:110px;">
		                                    <option value="0">Always</option>
		                                    <option value="1">When Paining</option>
		                                </select>
		                            </div>
		                            <input type="button" onclick="add_items();" style="font-weight: bold;" class="btn btn-warning" value="+ Add">
		                        </td>
		                    </tr>
		                    </tbody>
		                </table>
		                </form>
		                <hr/>
		                <table id="load_medicine" class="table table-hover table-bordered table-striped">
		                    <tbody>
		                    <tr>
		                        <th>Type</th>
		                        <th>Medicine</th>
		                        <th>Days</th>
		                        <th>Dosage</th>
		                        <th>Befor/After</th>
		                        <th>Action</th>
		                    </tr>
		                    <?php if(!empty($details->medicines)) { 
		                        foreach($details->medicines as $key=>$medicine) { ?>
		                    <tr id="item_<?php print $key; ?>">
		                        <td><?php print $medicine['type']; ?></td>
		                        <td><?php print $medicine['name']; ?><?php if($medicine['when'] == 1) { print '<span style="color:red; font-size:20px;">*</span>'; } ?></td>
		                        <td><?php print $medicine['days']; ?></td>
		                        <td><?php print $medicine['dosage']; ?></td>
		                        <td><?php print $medicine['before_after']; ?></td>
		                        <td><a onclick="delete_item(<?php print $key; ?>);" class="delete_btn"><i class="fa fa-window-close" aria-hidden="true"></a></i></td>
		                    </tr>
		                    <?php }} ?>
		                    <tr>
		                    </tr>
		                    </tbody>
		                </table>

		                <form action="<?php echo site_url('digest/update');?>" method="POST" >
                			<input type="hidden" name="digestId" value="<?php echo $digestId;?>">
                			<button type="submit" class="btn btn-primary" style="float: right;">Create</button>
                		</form>
		                
		            </div>
		            <!-- /.box-body -->




	        	</div>
	        </div>
                
      	</div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
	//Adding any medicine item from the prescription
    function add_items() {
        var prescription_id = $('[name=id]').val();
        var error = 0;
        
        var type = $('[name=type]').val();
        if (type == 0) {
            $('[name=type]').css('border', '1px solid red').css('background-color', '#FFF5AB');
            error = 1;
        } else {
            $('[name=type]').css('border', '1px solid #999').css('background-color', '#FFF');
        }

        var medicine = $('[name=medicine]').val();
        if (medicine == 0) {
            $('[name=medicine]').css('border', '1px solid red').css('background-color', '#FFF5AB');
            error = 1;
        } else {
            $('[name=medicine]').css('border', '1px solid #999').css('background-color', '#FFF');
        }

        var dosage = $('[name=dosage]').val();
        if (dosage == 0) {
            $('[name=dosage]').css('border', '1px solid red').css('background-color', '#FFF5AB');
            error = 1;
        } else {
            $('[name=dosage]').css('border', '1px solid #999').css('background-color', '#FFF');
        }

        if (!error) {
            var formData = $('#add_medicine').serialize();
            $.ajax({
                url: '<?php print base_url(); ?>prescription/add_new_item',
                type: "POST",
                data: formData,
                beforeSend: function () {
                    $('#load_medicine').css('opacity', '0.4');
                },
                success: function (msg) {
                    $('#load_medicine').html(msg);
                    $('#load_medicine').css('opacity', '1');
                    document.getElementById("add_medicine").reset();
                }
            });
        }
    }
    
    //Deleting any medicine item from the prescription
    function delete_item(item_id) {
        var yes = confirm('Really want to remove?');
        if (yes) {
            $.ajax({
                url: '<?php print base_url(); ?>prescription/delete_item/'+item_id,
                type: "POST",
                dataType: "text",
                data: {item_id: item_id},
                beforeSend: function () {
                    $('#item_' + item_id).css('background', '#FF0000');
                },
                success: function (msg) {
                    //$('#load_invoice_items').load('ajax_query.php?reload_invoice_items=yes');
                    setTimeout(function () {
                        $('#item_' + item_id).fadeout('slow');
                    }, 200);
                    setTimeout(function () {
                        $('#load_medicine').html(msg);
                    }, 500);
                }
            });
        }
    }
</script>





