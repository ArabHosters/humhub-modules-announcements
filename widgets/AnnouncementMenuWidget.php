<?php

/**
 * TasksMenuWidget as (usally left) navigation on tasks page options.
 * 
 * @author Nedal
 */
class AnnouncementMenuWidget extends MenuWidget {

    public $template = "application.widgets.views.leftNavigation";
    public $type = "announcmentNavigation";

    public function init() {

        $this->addItemGroup(array(
            'id' => 'announcemnt',
            'label' => '<strong>Announcements</strong> menu',
            'sortOrder' => 100,
        ));

        $this->addItem(array(
            'label' => 'Announcements',
            'icon' => '<i class="fa fa-bell"></i>',
            'group' => 'announcemnt',
            'url' => Yii::app()->createUrl('//announcements/announcement/index'),
            'sortOrder' => 100,
            'isActive' => (Yii::app()->controller->id == "announcement" && (Yii::app()->controller->action->id == "index" || Yii::app()->controller->action->id == "archive")),
        ));

        if (Yii::app()->user->isAdmin()) {
            $this->addItem(array(
                'label' => 'Add New Announcement',
                'icon' => '<i class="fa fa-plus"></i>',
                'group' => 'announcemnt',
                'url' => Yii::app()->createUrl('//announcements/announcement/create'),
                'sortOrder' => 110,
                'isActive' => (Yii::app()->controller->id == "announcement" && Yii::app()->controller->action->id == "create"),
            ));

            $this->addItem(array(
                'label' => 'Manage Announcements',
                'icon' => '<i class="fa fa-wrench"></i>',
                'group' => 'announcemnt',
                'url' => Yii::app()->createUrl('//announcements/announcement/admin'),
                'sortOrder' => 120,
                'isActive' => (Yii::app()->controller->id == "announcement" && Yii::app()->controller->action->id == "admin"),
            ));
        }
        
        
        
        if (Yii::app()->user->isAdmin()) {
            $this->addItemGroup(array(
            'id' => 'announcemntypes',
            'label' => '<strong>Announcements</strong> types',
            'sortOrder' => 100,
        ));
            
            $this->addItem(array(
                'label' => 'Add New Type',
                'icon' => '<i class="fa fa-plus"></i>',
                'group' => 'announcemntypes',
                'url' => Yii::app()->createUrl('//announcements/announcementTypes/create'),
                'sortOrder' => 110,
                'isActive' => (Yii::app()->controller->id == "announcementTypes" && Yii::app()->controller->action->id == "create"),
            ));

            $this->addItem(array(
                'label' => 'Manage Types',
                'icon' => '<i class="fa fa-wrench"></i>',
                'group' => 'announcemntypes',
                'url' => Yii::app()->createUrl('//announcements/announcementTypes/index'),
                'sortOrder' => 120,
                'isActive' => (Yii::app()->controller->id == "announcementTypes" && Yii::app()->controller->action->id == "index"),
            ));
        }
        

        parent::init();
    }

}

?>
