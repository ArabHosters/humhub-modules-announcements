<?php
/* @var $this NotificationTypesController */
/* @var $data NotificationTypes */
?>


<div class="ann_itm gritter-add-sticky btn btn-default btn-block btn-icon-stacked glyphicons right_arrow">
    <i class="fa fa-chevron-right"></i>
    <strong class="ann_tit"><?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?></strong>
   
    <div class="box-body" style="display:none;">
            <div class="toolbox bottom" style="background: #fff; padding: 5px; border-radius: 5px;">
               <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
               <?php echo CHtml::encode($data->id); ?>
                <br />

                <b><?php echo CHtml::encode($data->getAttributeLabel('priority')); ?>:</b>
                <?php echo CHtml::encode($data->priority); ?>
                <br />
            </div>
        </div>
</div>