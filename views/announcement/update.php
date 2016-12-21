<?php
/* @var $this NotificationsController */
/* @var $model ModelNotifications */
?>
<!-- PAGE HEADER-->

<div class="panel panel-default">
    <div class="panel-heading">
        Edit Announcement <?php echo $model->title; ?>
    </div>
    <div class="panel-body">
        <?php $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
</div>