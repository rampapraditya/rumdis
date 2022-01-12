<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>SI RUMDIS</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap-social/bootstrap-social.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/izitoast/css/iziToast.min.css">
    </head>

    <body>
        <div id="app">
            <section class="section">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                            <div class="login-brand">
                                <img src="<?php echo $logo; ?>" style="width: 25%;">
                                <p style="margin-top: 15px;">SI RUMDIS</p>
                            </div>
                            <div class="card card-primary" style="margin-top: -20px;">
                                <div class="card-body">
                                    <div class="needs-validation">
                                        <form id="form">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input id="username" type="text" class="form-control" name="username" tabindex="1" required autofocus autocomplete="off">
                                                <div id="pesan_user" class="invalid-feedback">
                                                    Please fill in your email
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="d-block">
                                                    <label class="control-label">Password</label>
                                                </div>
                                                <input id="password" type="password" class="form-control" name="password" tabindex="2" required autocomplete="off">
                                                <div id="pesan_pass" class="invalid-feedback">
                                                    please fill in your password
                                                </div>
                                            </div>
                                        </form>

                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary btn-lg btn-block" tabindex="4" onclick="login();">
                                                Login
                                            </button>
                                        </div>
                                        <div id="pesanall" class="invalid-feedback">
                                            <!-- PESAN ERROR -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="simple-footer">
                                Copyright &copy; <?php echo date('Y'); ?> <div class="bullet"></div> <a href="https://pramediaenginering.com/">Wahyu</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- General JS Scripts -->
        <script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/popper.min.js" ></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" ></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
        
        <!-- Toast -->
        <script src="<?php echo base_url(); ?>assets/modules/izitoast/js/iziToast.min.js"></script>
        
        <script type="text/javascript">
            
            $(document).ready(function() {
                $("#pesan_user").hide();
                $("#pesan_pass").hide();
            });
    
            function login(){
                var user = document.getElementById('username').value;
                var pass = document.getElementById('password').value;
                if(user === ''){
                    $("#pesan_user").show();
                }else if(pass === ''){
                    $("#pesan_pass").show();
                }else{
                    $.ajax({
                        url : "<?php echo base_url(); ?>login/proses",
                        type: "POST",
                        data: $('#form').serialize(),
                        dataType: "JSON",
                        success: function(data){
                            if(data.status === 'ok'){
                                $("#pesan_user").hide();
                                $("#pesan_pass").hide();
                                window.location.href = "<?php echo base_url(); ?>welcome";
                            }else if(data.status === 'okuser'){
                                $("#pesan_user").hide();
                                $("#pesan_pass").hide();
                                window.location.href = "<?php echo base_url(); ?>welcomeuser";
                            }else{
                                $("#pesanall").show();
                                $("#pesanall").html(data.status);
                            }
                        },error: function (jqXHR, textStatus, errorThrown){
                            $("#pesanall").show();
                            $("#pesanall").html("Error json " + errorThrown);
                        }
                    });
                }
            }
        </script>
    </body>
</html>
