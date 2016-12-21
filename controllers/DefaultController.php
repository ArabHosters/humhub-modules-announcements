<?php

class DefaultController extends Controller
{

    public $subLayout = "/_layout";

    /**
     *
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl'
                ) // perform access control for CRUD operations
        ;
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * 
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'users' => array('@')
            ),
            array(
                'deny', // deny all users
                'users' => array('*')
            )
        );
    }
    
    public function actionRead($id)
    {
        $reads = new AnnouncementReads();
        $reads->user_id = Yii::app()->user->id;
        $reads->announcement_id = $id;
        $reads->readed = true;

        $reads->save(false);

        $this->redirect($this->createUrl('/announcements'));
    }

    public function actionIndex()
    {
        $announcements = Announcement::getAllAnnouncements();
        $number = 0;
        foreach ($announcements as $announcement) {
            if($announcement->isNotReaded()) {
                $number = $number + 1;
                Yii::app()->user->setFlash('success' . ($number), array(
                    'message' => $announcement->content,
                    'category' => $announcement->category,
                    'title' => $announcement->title
                ));
            }
        }

        $this->render('index', array(
            'announcements' => $announcements,
        ));
    }

}