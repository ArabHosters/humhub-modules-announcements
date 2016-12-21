<?php $this->beginContent('application.modules_core.notification.views.notificationLayoutMail', array('notification' => $notification, 'hideUserImage' => true)); ?>
<?php

echo Yii::t('announcement', 'New {assignedTo} Announcement recived ({announcement}).', array(
    '{assignedTo}' => '<strong>' . $targetObject->assignedTo . '</strong>',
    '{announcement}' => '<strong>' . NotificationModule::formatOutput($targetObject->title) . '</strong>'
));
?>
<?php $this->endContent(); ?>
