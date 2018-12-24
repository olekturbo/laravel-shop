<textarea <?php if($row->required == 1): ?> required <?php endif; ?> class="form-control richTextBox" name="<?php echo e($row->field); ?>" id="richtext<?php echo e($row->field); ?>">
    <?php if(isset($dataTypeContent->{$row->field})): ?>
        <?php echo e(old($row->field, $dataTypeContent->{$row->field})); ?>

    <?php else: ?>
        <?php echo e(old($row->field)); ?>

    <?php endif; ?>
</textarea>
