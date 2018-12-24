<nav class="navbar navbar-default navbar-fixed-top navbar-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="hamburger btn-link">
                <span class="hamburger-inner"></span>
            </button>
            <?php $__env->startSection('breadcrumbs'); ?>
            <ol class="breadcrumb hidden-xs">
                <?php if(count(Request::segments()) == 1): ?>
                    <li class="active"><i class="voyager-boat"></i> <?php echo e(__('voyager::generic.dashboard')); ?></li>
                <?php else: ?>
                    <li class="active">
                        <a href="<?php echo e(route('voyager.dashboard')); ?>"><i class="voyager-boat"></i> <?php echo e(__('voyager::generic.dashboard')); ?></a>
                    </li>
                <?php endif; ?>
                <?php $breadcrumb_url = url(''); ?>
                <?php for($i = 1; $i <= count(Request::segments()); $i++): ?>
                    <?php $breadcrumb_url .= '/' . Request::segment($i); ?>
                    <?php if(Request::segment($i) != ltrim(route('voyager.dashboard', [], false), '/') && !is_numeric(Request::segment($i))): ?>

                        <?php if($i < count(Request::segments()) & $i > 0 && array_search('database',Request::segments())===false): ?>
                            <li class="active"><a
                                        href="<?php echo e($breadcrumb_url); ?>"><?php echo e(ucwords(str_replace('-', ' ', str_replace('_', ' ', Request::segment($i))))); ?></a>
                            </li>
                        <?php else: ?>
                            <li><?php echo e(ucwords(str_replace('-', ' ', str_replace('_', ' ', Request::segment($i))))); ?></li>
                        <?php endif; ?>

                    <?php endif; ?>
                <?php endfor; ?>
            </ol>
            <?php echo $__env->yieldSection(); ?>
        </div>
        <ul class="nav navbar-nav <?php if(config('voyager.multilingual.rtl')): ?> navbar-left <?php else: ?> navbar-right <?php endif; ?>">
            <li class="dropdown profile">
                <a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" role="button"
                   aria-expanded="false"><img src="<?php echo e($user_avatar); ?>" class="profile-img"> <span
                            class="caret"></span></a>
                <ul class="dropdown-menu dropdown-menu-animated">
                    <li class="profile-img">
                        <img src="<?php echo e($user_avatar); ?>" class="profile-img">
                        <div class="profile-body">
                            <h5><?php echo e(Auth::user()->name); ?></h5>
                            <h6><?php echo e(Auth::user()->email); ?></h6>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <?php $nav_items = config('voyager.dashboard.navbar_items'); ?>
                    <?php if(is_array($nav_items) && !empty($nav_items)): ?>
                    <?php $__currentLoopData = $nav_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li <?php echo isset($item['classes']) && !empty($item['classes']) ? 'class="'.$item['classes'].'"' : ''; ?>>
                        <?php if(isset($item['route']) && $item['route'] == 'voyager.logout'): ?>
                        <form action="<?php echo e(route('voyager.logout')); ?>" method="POST">
                            <?php echo e(csrf_field()); ?>

                            <button type="submit" class="btn btn-danger btn-block">
                                <?php if(isset($item['icon_class']) && !empty($item['icon_class'])): ?>
                                <i class="<?php echo $item['icon_class']; ?>"></i>
                                <?php endif; ?>
                                <?php echo e($name); ?>

                            </button>
                        </form>
                        <?php else: ?>
                        <a href="<?php echo e(isset($item['route']) && Route::has($item['route']) ? route($item['route']) : (isset($item['route']) ? $item['route'] : '#')); ?>" <?php echo isset($item['target_blank']) && $item['target_blank'] ? 'target="_blank"' : ''; ?>>
                            <?php if(isset($item['icon_class']) && !empty($item['icon_class'])): ?>
                            <i class="<?php echo $item['icon_class']; ?>"></i>
                            <?php endif; ?>
                            <?php echo e($name); ?>

                        </a>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ul>
            </li>
        </ul>
    </div>
</nav>
