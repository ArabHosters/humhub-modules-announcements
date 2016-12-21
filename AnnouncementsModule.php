<?php

class AnnouncementsModule extends HWebModule {

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'announcements.models.*',
            'announcements.components.*',
        ));
    }

    /**
     * On build of the TopMenu, check if module is enabled
     * When enabled add a menu item
     *
     * @param type $event
     */
    public static function onTopMenuInit($event) {
        if (Yii::app()->user->isGuest) {
            return;
        }

        $event->sender->addItem(array(
            'label' => 'Announcements',
            'url' => Yii::app()->createUrl('//announcements/announcement/index', array()),
            'icon' => '<i class="fa fa-bell"></i>',
            'isActive' => (Yii::app()->controller->module && Yii::app()->controller->module->id == 'announcements'),
            'sortOrder' => 300,
        ));
    }

}
