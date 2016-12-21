<?php
/* @var $this NotificationsController */
/* @var $model ModelNotifications */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        New Announcement
    </div>
    <div class="panel-body">
        <?php $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
</div>