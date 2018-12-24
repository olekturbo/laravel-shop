<?php $relationshipDetails = $relationship['details']; ?>
<div class="row row-dd row-dd-relationship">
    <div class="col-xs-2">
        <h4><i class="voyager-heart"></i><strong><?php echo e($relationship->display_name); ?></strong></h4>
        <div class="handler voyager-handle"></div>
        <strong><?php echo e(__('voyager::database.type')); ?>:</strong> <span><?php echo e(__('voyager::database.relationship.relationship')); ?></span>
        <div class="handler voyager-handle"></div>
        <input class="row_order" type="hidden" value="<?php echo e($relationship['order']); ?>" name="field_order_<?php echo e($relationship['field']); ?>">
    </div>
    <div class="col-xs-2">
        <input type="checkbox" name="field_browse_<?php echo e($relationship['field']); ?>" <?php if(isset($relationship->browse) && $relationship->browse): ?><?php echo e('checked="checked"'); ?><?php elseif(!isset($relationship->browse)): ?><?php echo e('checked="checked"'); ?><?php endif; ?>>
        <label for="field_browse_<?php echo e($relationship['field']); ?>"> <?php echo e(__('voyager::database.relationship.browse')); ?></label><br>
        <input type="checkbox" name="field_read_<?php echo e($relationship['field']); ?>" <?php if(isset($relationship->read) && $relationship->read): ?><?php echo e('checked="checked"'); ?><?php elseif(!isset($relationship->read)): ?><?php echo e('checked="checked"'); ?><?php endif; ?>>
        <label for="field_read_<?php echo e($relationship['field']); ?>"> <?php echo e(__('voyager::database.relationship.read')); ?></label><br>
        <input type="checkbox" name="field_edit_<?php echo e($relationship['field']); ?>" <?php if(isset($relationship->edit) && $relationship->edit): ?><?php echo e('checked="checked"'); ?><?php elseif(!isset($relationship->edit)): ?><?php echo e('checked="checked"'); ?><?php endif; ?>>
        <label for="field_edit_<?php echo e($relationship['field']); ?>"> <?php echo e(__('voyager::database.relationship.edit')); ?></label><br>
        <input type="checkbox" name="field_add_<?php echo e($relationship['field']); ?>" <?php if(isset($relationship->add) && $relationship->add): ?><?php echo e('checked="checked"'); ?><?php elseif(!isset($relationship->add)): ?><?php echo e('checked="checked"'); ?><?php endif; ?>>
        <label for="field_add_<?php echo e($relationship['field']); ?>"> <?php echo e(__('voyager::database.relationship.add')); ?></label><br>
        <input type="checkbox" name="field_delete_<?php echo e($relationship['field']); ?>" <?php if(isset($relationship->delete) && $relationship->delete): ?><?php echo e('checked="checked"'); ?><?php elseif(!isset($relationship->delete)): ?><?php echo e('checked="checked"'); ?><?php endif; ?>>
        <label for="field_delete_<?php echo e($relationship['field']); ?>"> <?php echo e(__('voyager::database.relationship.delete')); ?></label><br>
    </div>
    <div class="col-xs-2">
        <p><?php echo e(__('voyager::database.relationship.relationship')); ?></p>
    </div>
    <div class="col-xs-2">
        <input type="text" name="field_display_name_<?php echo e($relationship['field']); ?>" class="form-control relationship_display_name" value="<?php echo e($relationship['display_name']); ?>">
    </div>
    <div class="col-xs-4">
        <div class="voyager-relationship-details-btn">
            <i class="voyager-angle-down"></i><i class="voyager-angle-up"></i> 
            <span class="open_text"><?php echo e(__('voyager::database.relationship.open')); ?></span>
            <span class="close_text"><?php echo e(__('voyager::database.relationship.close')); ?></span>
            <?php echo e(__('voyager::database.relationship.relationship_details')); ?>

        </div>
    </div>
    <div class="col-md-12 voyager-relationship-details">
        <a href="<?php echo e(route('voyager.bread.delete_relationship', $relationship['id'])); ?>" class="delete_relationship"><i class="voyager-trash"></i> <?php echo e(__('voyager::database.relationship.delete')); ?></a>
        <div class="relationship_details_content">
            <p class="relationship_table_select"><?php echo e(str_singular(ucfirst($table))); ?></p>
            <select class="relationship_type select2" name="relationship_type_<?php echo e($relationship['field']); ?>">
                <option value="hasOne" <?php if(isset($relationshipDetails->type) && $relationshipDetails->type == 'hasOne'): ?><?php echo e('selected="selected"'); ?><?php endif; ?>><?php echo e(__('voyager::database.relationship.has_one')); ?></option>
                <option value="hasMany" <?php if(isset($relationshipDetails->type) && $relationshipDetails->type == 'hasMany'): ?><?php echo e('selected="selected"'); ?><?php endif; ?>><?php echo e(__('voyager::database.relationship.has_many')); ?></option>
                <option value="belongsTo" <?php if(isset($relationshipDetails->type) && $relationshipDetails->type == 'belongsTo'): ?><?php echo e('selected="selected"'); ?><?php endif; ?>><?php echo e(__('voyager::database.relationship.belongs_to')); ?></option>
                <option value="belongsToMany" <?php if(isset($relationshipDetails->type) && $relationshipDetails->type == 'belongsToMany'): ?><?php echo e('selected="selected"'); ?><?php endif; ?>><?php echo e(__('voyager::database.relationship.belongs_to_many')); ?></option>
            </select>
            <select class="relationship_table select2" name="relationship_table_<?php echo e($relationship['field']); ?>">
                <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tablename): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($tablename); ?>" <?php if(isset($relationshipDetails->table) && $relationshipDetails->table == $tablename): ?><?php echo e('selected="selected"'); ?><?php endif; ?>><?php echo e(ucfirst($tablename)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <span><input type="text" class="form-control" name="relationship_model_<?php echo e($relationship['field']); ?>" placeholder="<?php echo e(__('voyager::database.relationship.namespace')); ?>" value="<?php if(isset($relationshipDetails->model)): ?><?php echo e($relationshipDetails->model); ?><?php endif; ?>"></span>
        </div>
            <div class="relationshipField">
                <div class="relationship_details_content margin_top belongsTo <?php if($relationshipDetails->type == 'belongsTo'): ?><?php echo e('flexed'); ?><?php endif; ?>">
                    <label><?php echo e(__('voyager::database.relationship.which_column_from')); ?> <span><?php echo e(str_singular(ucfirst($table))); ?></span> <?php echo e(__('voyager::database.relationship.is_used_to_reference')); ?> <span class="label_table_name"></span>?</label>
                    <select name="relationship_column_belongs_to_<?php echo e($relationship['field']); ?>" class="new_relationship_field select2">
                        <?php $__currentLoopData = $fieldOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($data['field']); ?>" <?php if($relationshipDetails->column == $data['field']): ?><?php echo e('selected="selected"'); ?><?php endif; ?>><?php echo e($data['field']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="relationship_details_content margin_top hasOneMany <?php if($relationshipDetails->type == 'hasOne' || $relationshipDetails->type == 'hasMany'): ?><?php echo e('flexed'); ?><?php endif; ?>">
                    <label><?php echo e(__('voyager::database.relationship.which_column_from')); ?> <span class="label_table_name"></span> <?php echo e(__('voyager::database.relationship.is_used_to_reference')); ?> <span><?php echo e(str_singular(ucfirst($table))); ?></span>?</label>
                    <select name="relationship_column_<?php echo e($relationship['field']); ?>" class="new_relationship_field select2 rowDrop" data-table="<?php if(isset($relationshipDetails->table)): ?><?php echo e($relationshipDetails->table); ?><?php endif; ?>" data-selected="<?php echo e($relationshipDetails->column); ?>">
                    </select>
                </div>
            </div>
        <div class="relationship_details_content margin_top relationshipPivot <?php if($relationshipDetails->type == 'belongsToMany'): ?><?php echo e('visible'); ?><?php endif; ?>">
            <label><?php echo e(__('voyager::database.relationship.pivot_table')); ?>:</label>
            <select name="relationship_pivot_table_<?php echo e($relationship['field']); ?>" class="select2">
                <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($tbl); ?>" <?php if(isset($relationshipDetails->pivot_table) && $relationshipDetails->pivot_table == $tbl): ?><?php echo e('selected="selected"'); ?><?php endif; ?>><?php echo e(str_singular(ucfirst($tbl))); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="relationship_details_content margin_top">
            <label><?php echo e(__('voyager::database.relationship.display_the')); ?> <span class="label_table_name"></span></label>
            <select name="relationship_label_<?php echo e($relationship['field']); ?>" class="rowDrop select2" data-table="<?php if(isset($relationshipDetails->table)): ?><?php echo e($relationshipDetails->table); ?><?php endif; ?>" data-selected="<?php if(isset($relationshipDetails->label)): ?><?php echo e($relationshipDetails->label); ?><?php endif; ?>">
            </select>
            <label class="relationship_key" style="<?php if($relationshipDetails->type == 'belongsTo' || $relationshipDetails->type == 'belongsToMany'): ?><?php echo e('display:block'); ?><?php endif; ?>"><?php echo e(__('voyager::database.relationship.store_the')); ?> <span class="label_table_name"></span></label>
            <select name="relationship_key_<?php echo e($relationship['field']); ?>" class="rowDrop select2 relationship_key" style="<?php if($relationshipDetails->type == 'belongsTo' || $relationshipDetails->type == 'belongsToMany'): ?><?php echo e('display:block'); ?><?php endif; ?>" data-table="<?php if(isset($relationshipDetails->table)): ?><?php echo e($relationshipDetails->table); ?><?php endif; ?>" data-selected="<?php if(isset($relationshipDetails->key)): ?><?php echo e($relationshipDetails->key); ?><?php endif; ?>">
            </select>
            <br>
            <?php if(isset($relationshipDetails->taggable)): ?>
                <label class="relationship_taggable" style="<?php if($relationshipDetails->type == 'belongsToMany'): ?><?php echo e('display:block'); ?><?php endif; ?>">
                    <?php echo e(__('voyager::database.relationship.allow_tagging')); ?>

                </label>
                <span class="relationship_taggable" style="<?php if($relationshipDetails->type == 'belongsToMany'): ?><?php echo e('display:block'); ?><?php endif; ?>">
                    <input type="checkbox" name="relationship_taggable_<?php echo e($relationship['field']); ?>" class="toggleswitch" data-on="<?php echo e(__('voyager::generic.yes')); ?>" data-off="<?php echo e(__('voyager::generic.no')); ?>" <?php echo e($relationshipDetails->taggable == 'on' ? 'checked' : ''); ?>>
                </span>
            <?php endif; ?>
        </div>
    </div>
    <input type="hidden" value="0" name="field_required_<?php echo e($relationship['field']); ?>" checked="checked">
    <input type="hidden" name="field_input_type_<?php echo e($relationship['field']); ?>" value="relationship">
    <input type="hidden" name="field_<?php echo e($relationship['field']); ?>" value="<?php echo e($relationship['field']); ?>">
    <input type="hidden" name="relationships[]" value="<?php echo e($relationship['field']); ?>">
</div>