<ul class="nav navbar-nav">

<?php
    if (Voyager::translatable($items)) {
        $items = $items->load('translations');
    }
?>

<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $listItemClass = [];
        $styles = null;
        $linkAttributes = null;
        $transItem = $item;

        if (Voyager::translatable($item)) {
            $transItem = $item->translate($options->locale);
        }

        $href = $item->link();

        // Current page
        if(url($href) == url()->current()) {
            array_push($listItemClass, 'active');
        }

        $permission = '';
        $hasChildren = false;

        // With Children Attributes
        if(!$item->children->isEmpty())
        {
            foreach($item->children as $child)
            {
                $hasChildren = $hasChildren || Auth::user()->can('browse', $child);

                if(url($child->link()) == url()->current())
                {
                    array_push($listItemClass, 'active');
                }
            }
            if (!$hasChildren) {
                continue;
            }

            $linkAttributes = 'href="#' . $transItem->id .'-dropdown-element" data-toggle="collapse" aria-expanded="'. (in_array('active', $listItemClass) ? 'true' : 'false').'"';
            array_push($listItemClass, 'dropdown');
        }
        else
        {
            $linkAttributes =  'href="' . url($href) .'"';

            if(!Auth::user()->can('browse', $item)) {
                continue;
            }
        }
    ?>

    <li class="<?php echo e(implode(" ", $listItemClass)); ?>">
        <a <?php echo $linkAttributes; ?> target="<?php echo e($item->target); ?>" style="color:<?php echo e((isset($item->color) && $item->color != '#000000' ? $item->color : '')); ?>">
            <span class="icon <?php echo e($item->icon_class); ?>"></span>
            <span class="title"><?php echo e($transItem->title); ?></span>
        </a>
        <?php if($hasChildren): ?>
            <div id="<?php echo e($transItem->id); ?>-dropdown-element" class="panel-collapse collapse <?php echo e((in_array('active', $listItemClass) ? 'in' : '')); ?>">
                <div class="panel-body">
                    <?php echo $__env->make('voyager::menu.admin_menu', ['items' => $item->children, 'options' => $options, 'innerLoop' => true], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            </div>
        <?php endif; ?>
    </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</ul>
