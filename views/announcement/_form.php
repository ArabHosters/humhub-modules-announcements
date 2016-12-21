<?php
/* @var $this AnnouncementController */
/* @var $model Announcement */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'model-announcement-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal')
        ));
?>
    <div class="panel-body">
        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'title'); ?>
            <?php echo $form->textField($model, 'title', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'content'); ?>
            <?php echo $form->textArea($model, 'content', array('class' => 'form-control', 'rows' => '4', 'id' => 'content')); ?>
            <?php $this->widget('application.widgets.MarkdownEditorWidget', array('fieldId' => 'content')); ?>
            <?php echo $form->error($model, 'content'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'type'); ?>
            <?php
            echo CHtml::activeDropDownList(
                    $model, 'type', CHtml::listData(AnnouncementTypes::model()->findAll(), 'id', 'title'), array(
                'empty' => 'Select Announcement Type',
                'class' => 'form-control'
                    )
            );
            ?>
            <?php echo $form->error($model, 'type'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'priority'); ?>
            <?php echo $form->dropDownList($model, 'priority', array(1 => 'Low', 2 => 'Medium', 3 => 'High'), array('empty' => 'Select Priority', 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'priority'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'expire'); ?>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'expire',
                'model' => $model,
                'attribute' => 'expire',
                'options' => array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'yy-mm-dd'
                ),
                'value' => $model->expire,
                'htmlOptions' => array(
                    'class' => 'form-control'
                ),
            ));
            ?>
            <?php echo $form->error($model, 'expire'); ?>
        </div>
        <h4>Assign To</h4>
        <div class="form-group">
            <?php
            $assigned_to = $model->assigned_to;
            ?>

            <label><input id="rdb1" class="toggler" type="radio" name="Announcement[assigned_to]" value="1" <?php if ($assigned_to == 1) echo 'checked'; ?> />Company</label>
            <label><input id="rdb3" class="toggler" type="radio" name="Announcement[assigned_to]" value="3" <?php if ($assigned_to == 3) echo 'checked'; ?> />Department</label>
            <label><input id="rdb4" class="toggler" type="radio" name="Announcement[assigned_to]" value="4" <?php if ($assigned_to == 4) echo 'checked'; ?> />Team</label>
        </div>
        <div id="blk-1" class="options">
            <?php echo CHtml::label('Company', 'company_id'); ?>
            <?php
            $comanies_list = CHtml::listData(CompanyStructures::model()->findAllByAttributes(array('type' => 'Company')), 'id', 'title');
            $company_selected = '';
            if (!$model->isNewRecord)
                $company_selected = $model->assigner_id;
            echo CHtml::dropDownList(
                    'company_id', $company_selected, $comanies_list, array(
                'empty' => 'Select Company',
                'key' => 'company_id',
                'class' => 'form-control'
                    )
            );
            ?>
        </div>
        <div id="blk-3" class="options">
            <?php echo CHtml::label('Department', 'dept_id'); ?>
            <?php
            $dept_list = CHtml::listData(CompanyStructures::model()->findAllByAttributes(array('type' => 'Department')), 'id', 'title');
            $dept_selected = '';
            if (!$model->isNewRecord)
                $dept_selected = $model->assigner_id;
            echo CHtml::dropDownList(
                    'dept_id', $dept_selected, $dept_list, array(
                'empty' => 'Select Department',
                'key' => 'dept_id',
                'class' => 'form-control'
                    )
            );
            ?>
        </div>
        <div id="blk-4" class="options">
            <?php echo CHtml::label('Team', 'team_id'); ?>
            <?php
            $team_list = CHtml::listData(CompanyStructures::model()->findAllByAttributes(array('type' => 'Team')), 'id', 'title');
            $team_selected = '';
            if (!$model->isNewRecord)
                $team_selected = $model->assigner_id;
            echo CHtml::dropDownList(
                    'team_id', $team_selected, $team_list, array(
                'empty' => 'Select Team',
                'key' => 'team_id',
                'class' => 'form-control'
                    )
            );
            ?>
        </div> 

        <div class="form-group">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-success')); ?>
        </div>
</div>
<?php $this->endWidget(); ?>
<?php
Yii::app()->clientScript->registerScript('toggleassign', "
    $('.options').hide();
$('.toggler').click(function(){
            $('.options').hide();
            $('#blk-'+$(this).val()).show('slow');
    });
");
