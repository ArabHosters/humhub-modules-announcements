<?php

/**
 * AnnouncementNotification is fired to the user recived announcment
 *
 */
class AnnouncementNotification extends Notification {

    // Path to Web View of this Notification
    public $webView = "announcements.views.notifications.announcement";
    // Path to Mail Template for this notification
    public $mailView = "application.modules.announcements.views.notifications.announcement_mail";

    public function redirectToTarget() {
        $announcemnt = $this->getTargetObject();
        Yii::app()->getController()->redirect(Yii::app()->createUrl('//announcements/announcement/view', array('id' => $announcemnt->id)));
    }
    
}

?>
