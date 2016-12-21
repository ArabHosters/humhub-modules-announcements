<?php
/* @var $this AnnouncementTypesController */
/* @var $model AnnouncementTypes */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'announcement-types-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('class' => 'form-horizontal')
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'title', array('class' => 'col-sm-3 control-label')); ?>
        <div class="col-sm-7"><?php echo $form->textField($model, 'title', array('class' => 'form-control', 'size' => 60, 'maxlength' => 100)); ?></div>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'priority', array('class' => 'col-sm-3 control-label')); ?>
        <div class="col-sm-7"><?php echo $form->dropDownList($model, 'priority', array(1 => 'Low', 2 => 'Medium', 3 => 'High'), array('empty' => 'Select', 'class' => 'form-control')); ?></div>
        <?php echo $form->error($model, 'priority'); ?>
    </div>

    <div class="modal-footer">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-success')); ?>
    </div>

    <?php $this->endWidget(); ?>

    <!-- form -->