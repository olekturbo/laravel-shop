<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>" <?php if(config('voyager.multilingual.rtl')): ?> dir="rtl" <?php endif; ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="none" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="admin login">
    <title>Admin - <?php echo e(Voyager::setting("admin.title")); ?></title>
    <link rel="stylesheet" href="<?php echo e(voyager_asset('css/app.css')); ?>">
    <?php if(config('voyager.multilingual.rtl')): ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css">
        <link rel="stylesheet" href="<?php echo e(voyager_asset('css/rtl.css')); ?>">
    <?php endif; ?>
    <style>
        body {
            background-image:url('<?php echo e(Voyager::image( Voyager::setting("admin.bg_image"), voyager_asset("images/bg.jpg") )); ?>');
            background-color: <?php echo e(Voyager::setting("admin.bg_color", "#FFFFFF" )); ?>;
        }
        body.login .login-sidebar {
            border-top:5px solid <?php echo e(config('voyager.primary_color','#22A7F0')); ?>;
        }
        @media (max-width: 767px) {
            body.login .login-sidebar {
                border-top:0px !important;
                border-left:5px solid <?php echo e(config('voyager.primary_color','#22A7F0')); ?>;
            }
        }
        body.login .form-group-default.focused{
            border-color:<?php echo e(config('voyager.primary_color','#22A7F0')); ?>;
        }
        .login-button, .bar:before, .bar:after{
            background:<?php echo e(config('voyager.primary_color','#22A7F0')); ?>;
        }
    </style>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
</head>
<body class="login">
<div class="container-fluid">
    <div class="row">
        <div class="faded-bg animated"></div>
        <div class="hidden-xs col-sm-7 col-md-8">
            <div class="clearfix">
                <div class="col-sm-12 col-md-10 col-md-offset-2">
                    <div class="logo-title-container">
                        <?php $admin_logo_img = Voyager::setting('admin.icon_image', ''); ?>
                        <?php if($admin_logo_img == ''): ?>
                        <img class="img-responsive pull-left flip logo hidden-xs animated fadeIn" src="<?php echo e(voyager_asset('images/logo-icon-light.png')); ?>" alt="Logo Icon">
                        <?php else: ?>
                        <img class="img-responsive pull-left flip logo hidden-xs animated fadeIn" src="<?php echo e(Voyager::image($admin_logo_img)); ?>" alt="Logo Icon">
                        <?php endif; ?>
                        <div class="copy animated fadeIn">
                            <h1><?php echo e(Voyager::setting('admin.title', 'Voyager')); ?></h1>
                            <p><?php echo e(Voyager::setting('admin.description', __('voyager::login.welcome'))); ?></p>
                        </div>
                    </div> <!-- .logo-title-container -->
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-5 col-md-4 login-sidebar">

            <div class="login-container">

                <p><?php echo e(__('voyager::login.signin_below')); ?></p>

                <form action="<?php echo e(route('voyager.login')); ?>" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group form-group-default" id="emailGroup">
                        <label><?php echo e(__('voyager::generic.email')); ?></label>
                        <div class="controls">
                            <input type="text" name="email" id="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(__('voyager::generic.email')); ?>" class="form-control" required>
                         </div>
                    </div>

                    <div class="form-group form-group-default" id="passwordGroup">
                        <label><?php echo e(__('voyager::generic.password')); ?></label>
                        <div class="controls">
                            <input type="password" name="password" placeholder="<?php echo e(__('voyager::generic.password')); ?>" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-block login-button">
                        <span class="signingin hidden"><span class="voyager-refresh"></span> <?php echo e(__('voyager::login.loggingin')); ?>...</span>
                        <span class="signin"><?php echo e(__('voyager::generic.login')); ?></span>
                    </button>

              </form>

              <div style="clear:both"></div>

              <?php if(!$errors->isEmpty()): ?>
              <div class="alert alert-red">
                <ul class="list-unstyled">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($err); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              <?php endif; ?>

            </div> <!-- .login-container -->

        </div> <!-- .login-sidebar -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->
<script>
    var btn = document.querySelector('button[type="submit"]');
    var form = document.forms[0];
    var email = document.querySelector('[name="email"]');
    var password = document.querySelector('[name="password"]');
    btn.addEventListener('click', function(ev){
        if (form.checkValidity()) {
            btn.querySelector('.signingin').className = 'signingin';
            btn.querySelector('.signin').className = 'signin hidden';
        } else {
            ev.preventDefault();
        }
    });
    email.focus();
    document.getElementById('emailGroup').classList.add("focused");

    // Focus events for email and password fields
    email.addEventListener('focusin', function(e){
        document.getElementById('emailGroup').classList.add("focused");
    });
    email.addEventListener('focusout', function(e){
       document.getElementById('emailGroup').classList.remove("focused");
    });

    password.addEventListener('focusin', function(e){
        document.getElementById('passwordGroup').classList.add("focused");
    });
    password.addEventListener('focusout', function(e){
       document.getElementById('passwordGroup').classList.remove("focused");
    });

</script>
</body>
</html>
