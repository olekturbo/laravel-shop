<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sklep internetowy wykorzystujący framework Laravel">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>MyOwn Laravel Shop</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext" rel="stylesheet">

    <link href="<?php echo e(mix('css/app.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(mix('css/template.css')); ?>" rel="stylesheet" type="text/css">
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body>
    <div class="container pt-3">
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="<?php echo e(route('welcome')); ?>">
                <img src="<?php echo e(asset('images/logo.png')); ?>" alt="logo">
            </a>
            <div class="nav-option order-lg-last">
                <a class="nav-item nav-link" href="#"><i class="fa fa-user"></i> twoje konto</a>
                <a class="nav-item nav-link" href="<?php echo e(route('product.showCart')); ?>"><i class="fa fa-shopping-cart"></i> koszyk <?php if(session()->get('cart')): ?> <span id="totalQty" class="shopping-cart-amount ml-1"><?php echo e(session()->get('cart') ? session()->get('cart')->totalQty : ""); ?></span> <?php endif; ?> </a>
            </div>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <div class="navbar-nav text-center text-right pr-3">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="nav-item nav-link <?php if($loop->first): ?> active <?php endif; ?>" href="#"><?php echo e($category->name); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </nav>
    </div>
        <?php echo $__env->yieldContent('content'); ?>

    <footer>
        <div class="copy text-center font-weight-bold">
            <span class="my-orange">©</span> <?php echo e(date('Y')); ?> <span class="my-orange">myown.vh</span> all rights reserved
        </div>
    </footer>

    <script src="<?php echo e(mix('js/app.js')); ?>"></script>
    <script src="<?php echo e(mix('js/template.js')); ?>"></script>
    <?php echo $__env->yieldContent('js'); ?>
</body>
</html>
