<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Dental Point</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Dental Point</b><br>Login to the system</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign In</p>
        <div class="row">
            <div class="col-md-12 text-center">
                <div id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
        <form action="<?php echo base_url(); ?>loginControllers/loginMe" method="post">
          <div class="form-group has-feedback">
            <select class="form-control"  name="role_id" onchange="changeRole(this.value)">
             <option value="1">Doctor</option>    
             <option value="2">Patien</option>  
            </select>
          </div>

          <div class="form-group has-feedback" id="email">
            <input type="email" class="form-control" placeholder="Email" name="email"   id="emaReq" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback" id="phone" style="display: none;">
            <input type="text" class="form-control" placeholder="Phone" name="phone" id="phReq"   />
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
          </div>


          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" required  />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck" style="margin-left: 20px;">
                <label>
                  <input type="checkbox" name="remember" > Remember Me
                </label>
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <input type="submit" class="btn btn-primary btn-block btn-flat" value="Sign In" />
            </div><!-- /.col -->
          </div>
        </form>

        <!-- <a href="<?php //echo base_url() ?>login/forgotPassword">Forgot Password</a><br> -->
        
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>



    <script type="text/javascript">
      function changeRole(id){
        if (id == 2) {
          $('#email').css("display","none");
          $('#phone').css("display","block");
          $('#phReq').prop("required", true);
          $('#emaReq').prop("required", false);
        }else{
          $('#email').css("display","block");
          $('#phone').css("display","none");
          $('#emaReq').prop("required", true);
          $('#phReq').prop("required", false);
        }
      }
    </script>
  </body>
</html>
