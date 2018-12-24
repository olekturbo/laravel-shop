<?php if(isset($options->model) && isset($options->type)): ?>

    <?php if(class_exists($options->model)): ?>

        <?php $relationshipField = $row->field; ?>

        <?php if($options->type == 'belongsTo'): ?>

            <?php if(isset($view) && ($view == 'browse' || $view == 'read')): ?>

                <?php
                    $relationshipData = (isset($data)) ? $data : $dataTypeContent;
                    $model = app($options->model);
                    if (method_exists($model, 'getRelationship')) {
                        $query = $model::getRelationship($relationshipData->{$options->column});
                    } else {
                        $query = $model::find($relationshipData->{$options->column});
                    }
                ?>

                <?php if(isset($query)): ?>
                    <p><?php echo e($query->{$options->label}); ?></p>
                <?php else: ?>
                    <p>No results</p>
                <?php endif; ?>

            <?php else: ?>

                <select class="form-control select2" name="<?php echo e($options->column); ?>">
                    <?php
                        $model = app($options->model);
                        $query = $model::all();
                    ?>

                    <?php if($row->required === 0): ?>
                        <option value=""><?php echo e(__('voyager::generic.none')); ?></option>
                    <?php endif; ?>

                    <?php $__currentLoopData = $query; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relationshipData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($relationshipData->{$options->key}); ?>" <?php if($dataTypeContent->{$options->column} == $relationshipData->{$options->key}): ?><?php echo e('selected="selected"'); ?><?php endif; ?>><?php echo e($relationshipData->{$options->label}); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>

            <?php endif; ?>

        <?php elseif($options->type == 'hasOne'): ?>

            <?php

                $relationshipData = (isset($data)) ? $data : $dataTypeContent;

                $model = app($options->model);
                $query = $model::where($options->column, '=', $relationshipData->id)->first();

            ?>

            <?php if(isset($query)): ?>
                <p><?php echo e($query->{$options->label}); ?></p>
            <?php else: ?>
                <p>None results</p>
            <?php endif; ?>

        <?php elseif($options->type == 'hasMany'): ?>

            <?php if(isset($view) && ($view == 'browse' || $view == 'read')): ?>

                <?php
                    $relationshipData = (isset($data)) ? $data : $dataTypeContent;
                    $model = app($options->model);
            		$selected_values = $model::where($options->column, '=', $relationshipData->id)->get()->map(function ($item, $key) use ($options) {
            			return $item->{$options->label};
            		})->all();
                ?>

                <?php if($view == 'browse'): ?>
                    <?php
                        $string_values = implode(", ", $selected_values);
                        if(strlen($string_values) > 25){ $string_values = substr($string_values, 0, 25) . '...'; }
                    ?>
                    <?php if(empty($selected_values)): ?>
                        <p>No results</p>
                    <?php else: ?>
                        <p><?php echo e($string_values); ?></p>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(empty($selected_values)): ?>
                        <p>No results</p>
                    <?php else: ?>
                        <ul>
                            <?php $__currentLoopData = $selected_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selected_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($selected_value); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>

            <?php else: ?>

                <?php
                    $model = app($options->model);
                    $query = $model::where($options->column, '=', $dataTypeContent->id)->get();
                ?>

                <?php if(isset($query)): ?>
                    <ul>
                        <?php $__currentLoopData = $query; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $query_res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($query_res->{$options->label}); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>

                <?php else: ?>
                    <p>No results</p>
                <?php endif; ?>

            <?php endif; ?>

        <?php elseif($options->type == 'belongsToMany'): ?>

            <?php if(isset($view) && ($view == 'browse' || $view == 'read')): ?>

                <?php
                    $relationshipData = (isset($data)) ? $data : $dataTypeContent;
                    $selected_values = isset($relationshipData) ? $relationshipData->belongsToMany($options->model, $options->pivot_table)->get()->map(function ($item, $key) use ($options) {
            			return $item->{$options->label};
            		})->all() : array();
                ?>

                <?php if($view == 'browse'): ?>
                    <?php
                        $string_values = implode(", ", $selected_values);
                        if(strlen($string_values) > 25){ $string_values = substr($string_values, 0, 25) . '...'; }
                    ?>
                    <?php if(empty($selected_values)): ?>
                        <p>No results</p>
                    <?php else: ?>
                        <p><?php echo e($string_values); ?></p>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(empty($selected_values)): ?>
                        <p>No results</p>
                    <?php else: ?>
                        <ul>
                            <?php $__currentLoopData = $selected_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selected_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($selected_value); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>

            <?php else: ?>
                <select
                    class="form-control <?php if(isset($options->taggable) && $options->taggable == 'on'): ?> select2-taggable <?php else: ?> select2 <?php endif; ?>"
                    name="<?php echo e($relationshipField); ?>[]" multiple
                    <?php if(isset($options->taggable) && $options->taggable == 'on'): ?>
                        data-route="<?php echo e(route('voyager.'.str_slug($options->table).'.store')); ?>"
                        data-label="<?php echo e($options->label); ?>"
                        data-error-message="<?php echo e(__('voyager::bread.error_tagging')); ?>"
                    <?php endif; ?>
                >

                        <?php
                            $selected_values = isset($dataTypeContent) ? $dataTypeContent->belongsToMany($options->model, $options->pivot_table)->get()->map(function ($item, $key) use ($options) {
                                return $item->{$options->key};
                            })->all() : array();
                            $relationshipOptions = app($options->model)->all();
                        ?>

                        <?php if($row->required === 0): ?>
                            <option value=""><?php echo e(__('voyager::generic.none')); ?></option>
                        <?php endif; ?>

                        <?php $__currentLoopData = $relationshipOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relationshipOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($relationshipOption->{$options->key}); ?>" <?php if(in_array($relationshipOption->{$options->key}, $selected_values)): ?><?php echo e('selected="selected"'); ?><?php endif; ?>><?php echo e($relationshipOption->{$options->label}); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>

            <?php endif; ?>

        <?php endif; ?>

    <?php else: ?>

        cannot make relationship because <?php echo e($options->model); ?> does not exist.

    <?php endif; ?>

<?php endif; ?>
