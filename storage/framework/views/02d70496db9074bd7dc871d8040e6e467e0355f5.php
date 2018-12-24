<br>
<?php $checked = false; ?>
<?php if(isset($dataTypeContent->{$row->field}) || old($row->field)): ?>
    <?php $checked = old($row->field, $dataTypeContent->{$row->field}); ?>
<?php else: ?>
    <?php $checked = isset($options->checked) && $options->checked ? true : false; ?>
<?php endif; ?>

<?php if(isset($options->on) && isset($options->off)): ?>
    <input type="checkbox" name="<?php echo e($row->field); ?>" class="toggleswitch"
           data-on="<?php echo e($options->on); ?>" <?php echo $checked ? 'checked="checked"' : ''; ?>

           data-off="<?php echo e($options->off); ?>">
<?php else: ?>
    <input type="checkbox" name="<?php echo e($row->field); ?>" class="toggleswitch"
           <?php if($checked): ?> checked <?php endif; ?>>
<?php endif; ?>
