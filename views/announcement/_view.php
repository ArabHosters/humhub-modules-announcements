<?php
/* @var $this NotificationsController */
/* @var $data ModelNotifications */
echo $data->title;
?>
<div class="ann_itm gritter-add-sticky btn btn-default btn-block btn-icon-stacked glyphicons right_arrow">
    <i class="fa fa-chevron-right"></i>
    <strong class="ann_tit"><?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id' => $data->id)); ?></strong>
    <p style="padding-left: 13px; white-space: normal;"><?php echo Rizer::truncateString($data->content); ?></p>
    <div class="box-body" style="display:none;">
        <div class="toolbox bottom" style="background: #fff; padding: 5px; border-radius: 5px;">
            <b><?php echo CHtml::encode($data->getAttributeLabel('expire')); ?>:</b>
            <?php echo CHtml::encode($data->expire); ?>
            <br />
            <?php
//                if (isset($data->department)):
            ?>
            <b><?php // echo CHtml::encode($data->getAttributeLabel('department_id'));     ?>:</b>
            <?php
//                    echo CHtml::encode($data->department->title);
//                    echo'<br />';
//                endif;
            ?>

            <?php
//                if (isset($data->team)):
            ?>
            <b><?php // echo CHtml::encode($data->getAttributeLabel('team_id'));     ?>:</b>
            <?php
//                    echo CHtml::encode($data->team->title);
//                endif;
            ?>
        </div>
    </div>
</div>
