<?php
/* @var $this NotificationTypesController */
/* @var $model NotificationTypes */
/* @var $form CActiveForm */
?>
<div class="modal fade" id="search-box" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Search Box</h4>
            </div>
            <div class="modal-body">
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'action' => Yii::app()->createUrl($this->route),
                    'method' => 'get',
                    'htmlOptions' => array('class' => 'form-horizontal'),
                ));
                ?>

                <div class="form-group">
                    <?php echo $form->label($model, 'id', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-9"><?php echo $form->textField($model, 'id', array('class' => 'form-control')); ?></div>
                </div>

                <div class="form-group">
                    <?php echo $form->label($model, 'title', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-9"><?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control')); ?></div>
                </div>

                <div class="form-group">
                    <?php echo $form->label($model, 'priority', array('class' => 'col-sm-3 control-label')); ?>
                    <div class="col-sm-9"><?php echo $form->dropDownList($model, 'priority', array(1 => 'Low', 2 => 'Medium', 3 => 'High'), array('empty' => 'Select', 'class' => 'form-control')); ?></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?php echo CHtml::submitButton('Search', array('class' => 'btn btb-primary', 'id' => 'search-sub')); ?>
            </div>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div><!-- search-form -->