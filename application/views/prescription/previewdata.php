<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Print Prescription</title>
        <link rel="stylesheet" href="<?php print base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">

        <style type="text/css">
            html,body,td,th,p,h1,h2,h3,li {	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif; 	line-height: 1.5; color: #000; }
            html,body,p,h1,h2,h3,li {margin: 0;	padding: 0;}
            html,body,td,th,p,li { font-size: 10pt; }
            body { background:#EEE;}
            * { -webkit-print-color-adjust: exact; }


            /* Page Margin Setup */
            @page { margin: 0 0; }

            .color {background:#C30;}


            @media print {

                body { background:none;}
                page { margin: 0 0; }
                .print_line {  visibility:hidden; display:none; }
                .payment { visibility:hidden; display:none;}
            }

            /*
            @page :left { margin: 0.0cm; }
            @page :right { margin: 0.0cm; }
            */

            .warp { width: 816px; height: 1056px;  padding:20px; margin: 0 auto; background: #FFF; position:relative; overflow:hidden;}

            .print_line {  text-align:center; background:#3f7bd4; color:#FFF; cursor:pointer; width:816px; margin:20px auto; padding:10px 20px;}
            .print_line:hover { background:#407eda;}
            
            table { width:100%; border-collapse:collapse;}
            table th { background:#999; color:#FFF; text-align:left;}
            table th,
            table td { border:1px solid #999; vertical-align:top; padding:2px 5px;}
            table.noborder td {border:inherit; padding:2px 2px !important;}
            
            .cross_teeth td { border: 1px solid #000 !important; width: 25px; height: 18px; }
            .cross_teeth tr:first-child td {
                border-top: 0 !important;
            }
            .cross_teeth tr:last-child td {
                border-bottom: 0 !important;
            }
            .cross_teeth tr td:first-child,
            .cross_teeth tr td:first-child {
                border-left: 0 !important;
            }
            .cross_teeth tr td:last-child,
            .cross_teeth tr td:last-child {
                border-right: 0 !important;
            }
            
            .top_gap {margin-top: 172px; }
            .name_space {padding:0 0 0 100px; }
            .age_space { padding-left: 2px; }
            .date_space { padding: 0 0 0 50px; }
            .cc_space {margin-top:50px !important;}
            .tr_space {margin:0 0 30px 0; height: 125px; overflow:hidden; }
        </style>          
    </head>
    <body>

        <div class="warp">
            <div class="col-xs-12 top_gap">
                <div class="col-xs-8 name_space"><?php print get_data_by_id('name','customer','customer_id',$prescription->customer_id) ; ?><br>0<?php print get_data_by_id('phone','customer','customer_id',$prescription->customer_id) ; ?></div>
                <div class="col-xs-2 age_space">
                    <?php print get_data_by_id('age','customer','customer_id',$prescription->customer_id)?><br>
                    Date: <?php print $prescription->createDTM; ?>
                </div>
                <div class="col-xs-2 date_space"></div>
            </div>
                
            <div class="col-xs-12">
                <div class="row">
                <div class="col-xs-3">
                    <div class="row">
                    <div class="col-xs-12 tr_space cc_space">
                        <table class="noborder">
                            <?php if(!empty($CC)) { 
                                foreach($CC as $row) { ?>
                                <tr>
                                    <td>
                                            <div>
                                                <table class="cross_teeth">
                                                    <tr>
                                                        <td><?php print $row->t_l; ?></td>
                                                        <td><?php print $row->t_r; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php print $row->b_l; ?></td>
                                                        <td><?php print $row->b_r; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                        <td><?php print $row->problem; ?></td>
                                </tr>
                            <?php }} ?>
                        </table>
                    </div>
                    
                    <div class="col-xs-12 tr_space">
                        <table class="noborder">
                            <?php if(!empty($advice)) { 
                                foreach($advice as $advice) { ?>
                                <tr>
                                    <td>
                                            <div>
                                                <table class="cross_teeth">
                                                    <tr>
                                                        <td><?php print $advice->t_l; ?></td>
                                                        <td><?php print $advice->t_r; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php print $advice->b_l; ?></td>
                                                        <td><?php print $advice->b_r; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                        <td><?php print $advice->problem; ?></td>
                                </tr>
                            <?php }} ?>
                        </table>
                    </div>
                    </div>
                </div>
                    <style>
                        .when_class { border-right:1px solid #000; }
                    </style>
                <div class="col-xs-6 cc_space" style="margin-left: -38px;">
                        
                        <?php foreach($prescriptiondata as $medicine) {
                            ($medicine->when == 1) ? $when_class = 'when_class' : $when_class = ''; ?>
                        <div class="row" style="margin-bottom: 15px;">
                            <div class="col-xs-8 <?php print $when_class; ?>">
                                <p><?php print $medicine->type; ?> - <?php print $medicine->name; ?></p>
                                <p style="padding-left:52px;"><?php print $medicine->dosage; ?></p>
                                <p style="padding-left:52px;"><?php print $medicine->days; ?> days -- <?php print $medicine->before_after; ?> Eating</p>                          
                            </div>
                            <div class="col-xs-4">
                                 <?php ($medicine->when == 1) ? print "Take when paining" : "";?>
                            </div>
                        </div>
                        <?php } ?>
                </div>
                </div>
            </div>
        </div>

        <div class="print_line" onClick="print(document);">Print Now</div>
        <a href="<?php echo site_url('prescriptionList');?>" ><div class="print_line" style="background-color: #e06328;">Return List</div></a>

    </body>
</html>