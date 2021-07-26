<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Prescription
        <small>Create Prescription</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Prescription</a></li>
        <li class="active">Create Prescription</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-9">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add Medicine To Prescription</h3>
              <select class="form-control pres_form" name="digest" id="digest" style="float: right;" onchange="radeyPres(this.value)" >
                  <option value="" >Please select Deases</option>
                  <?php foreach ($digest as $val) { ?>
                    <option value="<?php echo $val->digest_id;?>"><?php echo $val->name;?></option>
                  <?php } ?>
              </select>
            </div>
            <!-- /.box-header -->
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
                    </tbody>
                </table>
                
            </div>
            <!-- /.box-body -->
          </div>
            
            
            
            
            
            <div class="col-xs-6">
                <div class="row">
                <div class="box">
                    <div class="box-body">
                        <form class="form-inline" id="add_treatment" action="">
                        <table class="table table-bordered" style="background: #7fc4ec;">
                            <tbody>
                            <tr>
                                <td width="80">
                                    <div class="form-group">
                                        <select name="t_type" class="form-control probelm_form">
                                            <option value="C_C">C/C</option>
                                            <option value="M_H">M/H</option>
                                            <option value="O_E">O/E</option>
                                            <option value="treatment">Treatment Plan</option>
                                        </select>
                                    </div>
                                </td>
                                <td width="80">
                                    <div class="form-group">
                                        <input type="text" name="problem" class="form-control probelm_form">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="100" colspan="2">
                                    <div class="form-group">
                                    <table>
                                        <tr>
                                            <td><input type="text" name="top_left" class="form-control teethnum" id="which_teeth" placeholder="top left teeth"></td>
                                            <td><input type="text" name="top_right" class="form-control teethnum" id="which_teeth" placeholder="top right teeth"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="bottom_left" class="form-control teethnum" id="which_teeth" placeholder="bottom left teeth"></td>
                                            <td><input type="text" name="bottom_right" class="form-control teethnum" id="which_teeth" placeholder="bottom right teeth"></td>
                                        </tr>
                                    </table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="100" colspan="2">
                                    <input type="button" onclick="add_treatment();" style="font-weight: bold;width: 100%;" class="btn btn-warning" value="+ Add To Prescription">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </form>
                        <hr/>
                        <table id="load_C_C" class="table table-bordered table-striped">
                            <thead>
                                <tr style="background: #4ce899;">
                                    <th width="200">Teeth <span style="color: #fff;background: #000; padding: 2px 5px;border-radius: 10px;float: right;">C/C</span></th>
                                    <th width="100">Problem</th>
                                    <th width="20">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($details->C_C)) { 
                                foreach($details->C_C as $key=>$C_C) { ?>
                                <tr id="C_C_<?php print $key; ?>">
                                    <td>
                                        <div class="form-group">
                                            <table class="table cross_teeth cross_teeth">
                                                <tr>
                                                    <td><?php print $C_C['teeth']['t_l']; ?></td>
                                                    <td><?php print $C_C['teeth']['t_r']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php print $C_C['teeth']['b_l']; ?></td>
                                                    <td><?php print $C_C['teeth']['b_r']; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                    <td><?php print $C_C['problem']; ?></td>
                                    <td><a onclick="delete_treatment('C_C', <?php print $key; ?>);" class="delete_btn"><i class="fa fa-window-close" aria-hidden="true"></a></i></td>
                                </tr>
                            <?php }} ?>
                                </tbody>
                            </table>
                        
                            <table id="load_M_H" class="table table-bordered table-striped">
                                <thead>
                                <tr style="background: #4ce899;">
                                    <th width="200">Teeth <span style="color: #fff;background: #000; padding: 2px 5px;border-radius: 10px;float: right;">M/H</span></th>
                                    <th width="100">Problem</th>
                                    <th width="20">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                            <?php if(!empty($details->M_H)) { 
                                foreach($details->M_H as $key=>$M_H) { ?>
                                <tr id="treatment_<?php print $key; ?>">
                                    <td>
                                        <div class="form-group">
                                            <table class="table cross_teeth">
                                                <tr>
                                                    <td><?php print $M_H['teeth']['t_l']; ?></td>
                                                    <td><?php print $M_H['teeth']['t_r']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php print $M_H['teeth']['b_l']; ?></td>
                                                    <td><?php print $M_H['teeth']['b_r']; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                    <td><?php print $M_H['problem']; ?></td>
                                    <td><a onclick="delete_treatment('M_H', <?php print $key; ?>);" class="delete_btn"><i class="fa fa-window-close" aria-hidden="true"></a></i></td>
                                </tr>
                            <?php }} ?>
                                </tbody>
                            </table>
                                
                            <table id="load_O_E" class="table table-bordered table-striped">
                            <thead>
                                <tr style="background: #4ce899;">
                                    <th width="200">Teeth <span style="color: #fff;background: #000; padding: 2px 5px;border-radius: 10px;float: right;">O/E</span></th>
                                    <th width="100">Problem</th>
                                    <th width="20">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($details->O_E)) { 
                                foreach($details->O_E as $key=>$O_E) { ?>
                                <tr id="O_E_<?php print $key; ?>">
                                    <td>
                                        <div class="form-group">
                                            <table class="table cross_teeth">
                                                <tr>
                                                    <td><?php print $O_E['teeth']['t_l']; ?></td>
                                                    <td><?php print $O_E['teeth']['t_r']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php print $O_E['teeth']['b_l']; ?></td>
                                                    <td><?php print $O_E['teeth']['b_r']; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                    <td><?php print $O_E['problem']; ?></td>
                                    <td><a onclick="delete_treatment('O_E', <?php print $key; ?>);" class="delete_btn"><i class="fa fa-window-close" aria-hidden="true"></a></i></td>
                                </tr>
                            <?php }} ?>
                            </tbody>
                        </table>
                                
                        <table id="load_treatment" class="table table-bordered table-striped">
                            <thead>
                                <tr style="background: #4ce899;">
                                    <th width="200">Teeth <span style="color: #fff;background: #000; padding: 2px 5px;border-radius: 10px;float: right;">Plan</span></th>
                                    <th width="100">Problem</th>
                                    <th width="20">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($details->treatment)) { 
                                foreach($details->treatment as $key=>$treatment) { ?>
                                <tr id="treatment_<?php print $key; ?>">
                                    <td>
                                        <div class="form-group">
                                            <table class="table cross_teeth">
                                                <tr>
                                                    <td><?php print $treatment['teeth']['t_l']; ?></td>
                                                    <td><?php print $treatment['teeth']['t_r']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php print $treatment['teeth']['b_l']; ?></td>
                                                    <td><?php print $treatment['teeth']['b_r']; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                    <td><?php print $treatment['problem']; ?></td>
                                    <td><a onclick="delete_treatment('treatment', <?php print $key; ?>);" class="delete_btn"><i class="fa fa-window-close" aria-hidden="true"></a></i></td>
                                </tr>
                            <?php }} ?>
                            </tbody>
                        </table>

                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
            </div>
            
            <div class="col-xs-5 col-xs-offset-1">
                <div class="row">
                <div class="box">
                    <div class="box-body">
                        <form class="form-inline" id="add_advice" action="">
                        <table class="table table-bordered table-striped" style="background: #7fc4ec;">
                            <tbody>
                            <tr>
                                <td width="80" style="background: #7fc4ec;">
                                    <div class="form-group advice_form">
                                        <select name="advice" class="form-control" style="width:100%;">
                                            <?php print getDropDownAdvice(); ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="100">
                                    <div class="form-group">
                                    <table>
                                        <tr>
                                            <td><input type="text" name="a_top_left" class="form-control teeth_advice" id="what_teeth" placeholder="top left teeth"></td>
                                            <td><input type="text" name="a_top_right" class="form-control teeth_advice" id="what_teeth" placeholder="top right teeth"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="a_bottom_left" class="form-control teeth_advice" id="what_teeth" placeholder="bottom left teeth"></td>
                                            <td><input type="text" name="a_bottom_right" class="form-control teeth_advice" id="what_teeth" placeholder="bottom right teeth"></td>
                                        </tr>
                                    </table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="100">
                                    <input type="button" onclick="add_advice();" style="font-weight: bold;width: 100%;" class="btn btn-warning" value="+ Add To Prescription">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </form>
                        <hr/>
                        <table id="load_advice" class="table table-bordered table-striped">
                            <thead>
                                <tr style="background: #4ce899;">
                                    <th width="200">Teeth <span style="color: #fff;background: #000; padding: 2px 5px;border-radius: 10px;float: right;">Advice</span></th>
                                    <th width="100">Problem</th>
                                    <th width="20">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($details->advice)) { 
                                foreach($details->advice as $key=>$advice) { ?>
                            <tr id="advice_<?php print $key; ?>">
                                <td>
                                        <div class="form-group">
                                            <table class="table cross_teeth">
                                                <tr>
                                                    <td><?php print $advice['teeth']['t_l']; ?></td>
                                                    <td><?php print $advice['teeth']['t_r']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><?php print $advice['teeth']['b_l']; ?></td>
                                                    <td><?php print $advice['teeth']['b_r']; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                    <td><?php print $advice['problem']; ?></td>
                                <td><a onclick="delete_advice(<?php print $key; ?>);" class="delete_btn"><i class="fa fa-window-close" aria-hidden="true"></a></i></td>
                            </tr>
                            <?php }} ?>
                            </tbody>
                        </table>

                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
            </div>
          <!-- /.box -->
        </div>
        <div class="col-xs-3">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Patient Information</h3>
            </div>
            <!-- /.box-header -->
            <form method="post" id="create_prescription" action="<?php print base_url(); ?>prescription/print_view">
            <div class="box-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <!-- <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name"> -->
                    <select name="name" class="form-control" id="name" onchange="getAge(this.value)" >
                        <option value="">Please select</option>
                        <?php foreach ($customer as $row) { ?>
                        <option value="<?php echo $row->customer_id ?>">0<?php echo $row->phone ?> (<small><?php echo $row->name ?></small>)</option>
                        <?php } ?>
                    </select>

                </div>
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="text" name="age" class="form-control" id="age" placeholder="Enter Age" readonly>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <div class="input-group">                            
                        <span class="input-group-addon" style="background: #ececec;"><i class="fa fa-calendar"></i></span>
                        <input type="text" class="form-control pull-right" id="datepicker" name="date" id="created_date" placeholder="Date" value="<?php print $date; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <input type="button" class="btn btn-primary" onclick="create_prescription();" value="+ Create" />
                </div>
            </div>
            </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>


<script>
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
    
    
    //When need to add any other treatment like C/C, M/H, O/E, Treatment (All using this function)
    function add_treatment() {
        var error = 0;
        
        var top_left       = $('[name=top_left]').val();
        var top_right      = $('[name=top_right]').val();
        var bottom_left    = $('[name=bottom_left]').val();
        var bottom_right   = $('[name=bottom_right]').val();
        if ((top_left) || (top_right) || (bottom_left) || (bottom_right)) {
            $('[id=which_teeth]').css('border', '1px solid #999').css('background-color', '#FFF');
        } else {
            $('[id=which_teeth]').css('border', '1px solid red').css('background-color', '#FFF5AB');
            error = 1;
        }

        var t_type = $('[name=t_type]').val();
        if (t_type == 0) {
            $('[id=t_type]').css('border', '1px solid red').css('background-color', '#FFF5AB');
            error = 1;
        } else {
            $('[name=t_type]').css('border', '1px solid #999').css('background-color', '#FFF');
        }

        var problem = $('[name=problem]').val();
        if (problem == 0) {
            $('[name=problem]').css('border', '1px solid red').css('background-color', '#FFF5AB');
            error = 1;
        } else {
            $('[name=problem]').css('border', '1px solid #999').css('background-color', '#FFF');
        }

        if (!error) {
            var formData = $('#add_treatment').serialize();
            $.ajax({
                url: '<?php print base_url(); ?>prescription/add_new_treatment',
                type: "POST",
                data: formData,
                beforeSend: function () {
                    $('#load_'+t_type).css('opacity', '0.4');
                },
                success: function (msg) {
                    $('#load_'+t_type).html(msg);
                    $('#load_'+t_type).css('opacity', '1');
                    document.getElementById("add_treatment").reset();
                }
            });
        }
    }
    
    //When need to delete any other treatment like C/C, M/H, O/E, Treatment (All using this function)
    function delete_treatment(t_type, treatment_id) {
        var yes = confirm('Really want to remove?'+t_type+treatment_id);
        if (yes) {
            $.ajax({
                url: '<?php print base_url(); ?>prescription/delete_treatment/'+t_type,
                type: "POST",
                dataType: "text",
                data: {treatment_id: treatment_id},
                beforeSend: function () {
                    $('#'+t_type+'_' + treatment_id).css('background', '#FF0000');
                },
                success: function (msg) {
                    //$('#load_invoice_items').load('ajax_query.php?reload_invoice_items=yes');
                    setTimeout(function () {
                        $('#'+t_type+'_' + treatment_id).fadeout('slow');
                    }, 200);
                    setTimeout(function () {
                        $('#load_'+t_type).html(msg);
                    }, 500);
                }
            });
        }
    }
    
    
    
    // When need to add an advice to the list
    function add_advice() {
        var error = 0;
        
        var a_top_left       = $('[name=a_top_left]').val();
        var a_top_right      = $('[name=a_top_right]').val();
        var a_bottom_left    = $('[name=a_bottom_left]').val();
        var a_bottom_right   = $('[name=a_bottom_right]').val();
        if ((a_top_left) || (a_top_right) || (a_bottom_left) || (a_bottom_right)) {
            $('[id=what_teeth]').css('border', '1px solid #999').css('background-color', '#FFF');
        } else {
            $('[id=what_teeth]').css('border', '1px solid red').css('background-color', '#FFF5AB');
            error = 1;
        }
        
        var advice = $('[name=advice]').val();
        if (advice == 0) {
            $('[name=advice]').css('border', '1px solid red').css('background-color', '#FFF5AB');
            error = 1;
        } else {
            $('[name=advice]').css('border', '1px solid #999').css('background-color', '#FFF');
        }

        if (!error) {
            var formData = $('#add_advice').serialize();
            $.ajax({
                url: '<?php print base_url(); ?>prescription/add_new_advice',
                type: "POST",
                data: formData,
                beforeSend: function () {
                    $('#load_advice').css('opacity', '0.4');
                },
                success: function (msg) {
                    $('#load_advice').html(msg);
                    $('#load_advice').css('opacity', '1');
                    document.getElementById("add_advice").reset();
                }
            });
        }
    }
    
    
    // When need to delete an advice from the list
    function delete_advice(advice_id) {
        var yes = confirm('Really want to remove?');
        if (yes) {
            $.ajax({
                url: '<?php print base_url(); ?>prescription/delete_advice/'+advice_id,
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
    
    
    // Create Prescription Function. When Click on Create button
    function create_prescription() {
        var prescription_id = $('[name=id]').val();
        var error = 0;
        
        var name = $('[name=name]').val();
        if (name == 0) {
            $('[name=name]').css('border', '1px solid red').css('background-color', '#FFF5AB');
            error = 1;
        } else {
            $('[name=name]').css('border', '1px solid #999').css('background-color', '#FFF');
        }

        var age = $('[name=age]').val();
        if (age == 0) {
            $('[name=age]').css('border', '1px solid red').css('background-color', '#FFF5AB');
            error = 1;
        } else {
            $('[name=age]').css('border', '1px solid #999').css('background-color', '#FFF');
        }

        var date = $('[name=date]').val();
        if (date == 0) {
            $('[name=date]').css('border', '1px solid red').css('background-color', '#FFF5AB');
            error = 1;
        } else {
            $('[name=date]').css('border', '1px solid #999').css('background-color', '#FFF');
        }

        if (!error) {
           $( "#create_prescription" ).submit();
        }
    }
    
    
    function getLimitedCompany(type){
            $.ajax({
                url: '<?php print base_url(); ?>prescription/company_list/',
                type: "POST",
                dataType: "text",
                data: {type: type},
                beforeSend: function () {
                    $('#company_list').html("<option>Loading...</option>");
                },
                success: function (msg) {
                    $('#company_list').html(msg);
                }
            });
    }
    
    function getLimitedCategory(company){
            var type = $('#type_list').val();
            $.ajax({
                url: '<?php print base_url(); ?>prescription/category_list/',
                type: "POST",
                dataType: "text",
                data: {company: company, type:type},
                beforeSend: function () {
                    $('#category_list').html("<option>Loading...</option>");
                },
                success: function (msg) {
                    $('#category_list').html(msg);
                }
            });
    }
    
    function getLimitedMedicine(category){
            var type = $('#type_list').val();
            var company = $('#company_list').val();
            $.ajax({
                url: '<?php print base_url(); ?>prescription/medicine_list/',
                type: "POST",
                dataType: "text",
                data: {category: category, company: company, type:type},
                beforeSend: function () {
                    $('#medicine_list').html("<option>Loading...</option>");
                },
                success: function (msg) {
                    $('#medicine_list').html(msg);
                }
            });
    }

    function getAge(id){
        $.ajax({
            url: '<?php print base_url(); ?>prescription/customer_age/',
            type: "POST",
            dataType: "text",
            data: {customer_id: id},
            beforeSend: function () {
                $('#age').html("<option>Loading...</option>");
            },
            success: function (msg) {
                $('#age').val(msg);
            }
        });
    }

    function radeyPres(id){
        $.ajax({
            url: '<?php print base_url(); ?>prescription/radeyprescription/',
            type: "POST",
            dataType: "text",
            data: {digest_id: id},
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

</script>


<style>
    .pres_form {width: 176px !important;}
    .probelm_form {width: 175px !important;}
    .teethnum {width: 185px !important;}
    .advice_form {width: 100% !important;}
    .teeth_advice {width: 149px !important;}
    .delete_btn { cursor:pointer; }
    .delete_btn i {font-size: 26px;color: #e40b0b;}
    .cross_teeth td { border: 1px solid #000; background: #f9f9f9; width: 60px; height: 33px; }
    
    .cross_teeth tr:first-child td {
        border-top: 0;
    }
    .cross_teeth tr:last-child td {
        border-bottom: 0;
    }
    .cross_teeth tr td:first-child,
    .cross_teeth tr td:first-child {
        border-left: 0;
    }
    .cross_teeth tr td:last-child,
    .cross_teeth tr td:last-child {
        border-right: 0;
    }
</style>