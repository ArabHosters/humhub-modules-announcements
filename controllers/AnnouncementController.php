<?php

class AnnouncementController extends Controller {

    public $subLayout = "/_layout";

    /**
     *
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
        return array(
            array(
                'allow',
                'actions' => array('index', 'archive', 'view', 'read', 'userListResults'),
                'users' => array('@')
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('create','admin', 'update'),
                'expression' => 'Yii::app()->user->isAdmin()',
            ),
            array(
                'deny', // deny all users
                'users' => array('*')
            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $announcment = $this->loadModel($id);

        if ($announcment->isNotReaded()) {
            $reads = new AnnouncementReads();
            $reads->user_id = Yii::app()->user->id;
            $reads->announcement_id = $id;
            $reads->readed = true;

            $reads->save(false);
        }

        $this->render('view', array(
            'model' => $announcment,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Announcement;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Announcement'])) {
            $model->attributes = $_POST['Announcement'];
            $assigned_to = $model->assigned_to;

            switch ($assigned_to) {
                case 1:
                    $assigner_id = Yii::app()->request->getPost('company_id', 0);
                    $model->assigner_id = $assigner_id;
                    break;
                case 3:
                    $assigner_id = Yii::app()->request->getPost('dept_id', 0);
                    $model->assigner_id = $assigner_id;
                    break;
                case 4:
                    $assigner_id = Yii::app()->request->getPost('team_id', 0);
                    $model->assigner_id = $assigner_id;
                    break;
                case 5:
                    $assigner_id = Yii::app()->request->getPost('employee_id', 0);
                    $model->assigner_id = $assigner_id;
                    break;
            }
            if ($model->save()) {
                switch ($assigned_to) {
                    case 1:
                        $company = CompanyStructures::model()->findByPk($assigner_id);
                        $users = $company->companyMembers;
                        $this->sendToUsers($users, $model);
                        break;
                    case 3:
                        $department = CompanyStructures::model()->findByPk($assigner_id);
                        $users = $department->departmentMembers;
                        $this->sendToUsers($users, $model);
                        break;
                    case 4:
                        $team = CompanyStructures::model()->findByPk($assigner_id);
                        $users = $team->teamMembers;
                        $this->sendToUsers($users, $model);
                        break;
                    case 5:
                        $notification = new Notification();
                        $notification->class = "AnnouncementNotification";
                        $notification->user_id = $assigner_id; // Assigned User
                        $notification->source_object_model = 'Announcement';
                        $notification->source_object_id = $model->id;
                        $notification->target_object_model = 'Announcement';
                        $notification->target_object_id = $model->id;
                        $notification->save();
                        break;
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function sendToUsers($users, $model) {
        foreach ($users as $user) {
            $notification = new Notification();
            $notification->class = "AnnouncementNotification";
            $notification->user_id = $user->user->id; // Assigned User
            $notification->source_object_model = 'Announcement';
            $notification->source_object_id = $model->id;
            $notification->target_object_model = 'Announcement';
            $notification->target_object_id = $model->id;
            $notification->save();
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Announcement'])) {
            $model->attributes = $_POST['Announcement'];
            $assigned_to = $model->assigned_to;

            switch ($assigned_to) {
                case 1:
                    $assigner_id = Yii::app()->request->getPost('company_id', 0);
                    $model->assigner_id = $assigner_id;
                    break;
                case 3:
                    $assigner_id = Yii::app()->request->getPost('dept_id', 0);
                    $model->assigner_id = $assigner_id;
                    break;
                case 4:
                    $assigner_id = Yii::app()->request->getPost('team_id', 0);
                    $model->assigner_id = $assigner_id;
                    break;
                case 5:
                    $assigner_id = Yii::app()->request->getPost('employee_id', 0);
                    $model->assigner_id = $assigner_id;
                    break;
            }
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $announcements = new Announcement;

        $this->render('index', array(
            'dataProvider' => $announcements,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionArchive() {
        $announcements = new Announcement('search');

        $this->render('archive', array(
            'dataProvider' => $announcements,
        ));

//        $dataProvider = new Announcement;
//        $typesDataProvider = new AnnouncementTypes;
//        $this->render('index', array(
//            'dataProvider' => $dataProvider->searchAllAnnouncements(),
//            'typesDataProvider' => $typesDataProvider->search(),
//        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Announcement('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Announcement']))
            $model->attributes = $_GET['Announcement'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionRead($id) {
        $reads = new AnnouncementReads();
        $reads->user_id = Yii::app()->user->id;
        $reads->announcement_id = $id;
        $reads->readed = true;

        $reads->save(false);

        $this->redirect($this->createUrl('/announcements'));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Announcement the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Announcement::model()->with('team', 'reads', 'department', 'category')->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Announcement $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'model-announcement-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Returns a user list including the pagination which contains all results
     * for an answer
     */
    public function actionUserListResults() {
        $announceId = (int) Yii::app()->request->getQuery('id', '');
        $announcment = Announcement::model()->findByPk($announceId);
        if ($announcment == null) {
            throw new CHttpException(401, Yii::t('PollsModule.controllers_PollController', 'Invalid answer!'));
        }

        $page = (int) Yii::app()->request->getParam('page', 1);
        $total = AnnouncementReads::model()->count('announcement_id=:aid', array(':aid' => $announceId));
        $usersPerPage = HSetting::Get('paginationSize');

        $sql = "SELECT u.* FROM `announcement_reads` a " .
                "LEFT JOIN user u ON a.user_id = u.id " .
                "WHERE a.announcement_id=:aid AND u.status=" . User::STATUS_ENABLED . " " .
                "LIMIT " . ($page - 1) * $usersPerPage . "," . $usersPerPage;
        $params = array(':aid' => $announceId);

        $pagination = new CPagination($total);
        $pagination->setPageSize($usersPerPage);

        $users = User::model()->findAllBySql($sql, $params);
        $output = $this->renderPartial('application.modules_core.user.views._listUsers', array(
            'title' => Yii::t('PollsModule.controllers_PollController', "Users viewd : <strong>{answer}</strong>", array('{answer}' => $announcment->title)),
            'users' => $users,
            'pagination' => $pagination
                ), true);

        Yii::app()->clientScript->render($output);
        echo $output;
        Yii::app()->end();
    }

}
