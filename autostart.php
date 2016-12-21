<?php

Yii::app()->moduleManager->register(array(
    'id' => 'announcements',
    'class' => 'application.modules.announcements.AnnouncementsModule',
    'import' => array(
        'application.modules.announcements.*',
        'application.modules.announcements.models.*',
        'application.modules.announcements.notifications.*',
    ),
    // Events to Catch 
    'events' => array(
        array('class' => 'TopMenuWidget', 'event' => 'onInit', 'callback' => array('AnnouncementsModule', 'onTopMenuInit')),
    ),
));
?>