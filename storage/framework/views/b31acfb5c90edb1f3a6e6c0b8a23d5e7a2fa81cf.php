<input <?php if($row->required == 1): ?> required <?php endif; ?> type="text" class="form-control" name="<?php echo e($row->field); ?>"
        placeholder="<?php echo e(isset($options->placeholder)? old($row->field, $options->placeholder): $row->display_name); ?>"
       <?php echo isBreadSlugAutoGenerator($options); ?>

       value="<?php if(isset($dataTypeContent->{$row->field})): ?><?php echo e(old($row->field, $dataTypeContent->{$row->field})); ?><?php elseif(isset($options->default)): ?><?php echo e(old($row->field, $options->default)); ?><?php else: ?><?php echo e(old($row->field)); ?><?php endif; ?>">
