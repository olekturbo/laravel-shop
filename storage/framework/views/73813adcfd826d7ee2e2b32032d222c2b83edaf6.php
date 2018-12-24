<br>
<?php if(isset($dataTypeContent->{$row->field})): ?>
    <?php $images = json_decode($dataTypeContent->{$row->field}); ?>
    <?php if($images != null): ?>
        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="img_settings_container" data-field-name="<?php echo e($row->field); ?>" style="float:left;padding-right:15px;">
                <img src="<?php echo e(Voyager::image( $image )); ?>" data-image="<?php echo e($image); ?>" data-id="<?php echo e($dataTypeContent->getKey()); ?>" style="max-width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:5px;">
                <a href="#" class="voyager-x remove-multi-image"></a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php endif; ?>
<div class="clearfix"></div>
<input <?php if($row->required == 1): ?> required <?php endif; ?> type="file" name="<?php echo e($row->field); ?>[]" multiple="multiple" accept="image/*">
