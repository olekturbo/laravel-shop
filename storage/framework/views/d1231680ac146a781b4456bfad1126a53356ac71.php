<?php $action = new $action($dataType, $data); ?>

<?php if($action->shouldActionDisplayOnDataType()): ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($action->getPolicy(), $data)): ?>
        <a href="<?php echo e($action->getRoute($dataType->name)); ?>" title="<?php echo e($action->getTitle()); ?>" <?php echo $action->convertAttributesToHtml(); ?>>
            <i class="<?php echo e($action->getIcon()); ?>"></i> <span class="hidden-xs hidden-sm"><?php echo e($action->getTitle()); ?></span>
        </a>
    <?php endif; ?>
<?php endif; ?>