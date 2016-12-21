<?php

/**
 * This is the model class for table "announcement".
 *
 * The followings are the available columns in table 'announcement':
 * @property integer $id
 * @property string $title
 * @property string $alert_after_date
 * @property string $alert_before_date
 * @property string $expire
 * @property string $content
 * @property integer $team_id
 * @property integer $department_id
 * @property integer $type
 * @property integer $priority
 * @property integer $assigned_to
 * @property integer $assigner_id
 */
class Announcement extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Notifyii the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{announcement}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('expire, content, title', 'required'),
            array('alert_after_date, alert_before_date, assigned_to, assigner_id,type,priority', 'safe'),
            array('id, expire, alert_after_date, alert_before_date, content, assigned_to, assigner_id, title', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'reads' => array(self::HAS_MANY, 'AnnouncementReads', 'announcement_id'),
            'team' => array(self::BELONGS_TO, 'CompanyStructures', 'team_id'),
            'department' => array(self::BELONGS_TO, 'CompanyStructures', 'department_id'),
            'category' => array(self::BELONGS_TO, 'AnnouncementTypes', 'type'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'expire' => 'Expire',
            'alert_after_date' => 'Alert After Date',
            'alert_before_date' => 'Alert Before Date',
            'content' => 'Content',
            'team_id' => 'Team',
            'department_id' => 'Department',
            'type' => 'Category',
            'category.title' => 'Category',
            'priorityName' => 'Priority',
            'assigner' => 'Assigned to',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('expire', $this->expire, true);
        $criteria->compare('alert_after_date', $this->alert_after_date, true);
        $criteria->compare('alert_before_date', $this->alert_before_date, true);
        $criteria->compare('assigned_to', $this->assigned_to);
        $criteria->compare('assigner_id', $this->assigner_id);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('assigned_to', $this->assigned_to);
        $criteria->compare('assigner_id', $this->assigner_id);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchAllAnnouncements() {
        $employee = User::model()->findByPk(Yii::app()->user->id);
        if (isset($employee->department_id)) {
            $department_id = $employee->department_id;
        } else {
            $department_id = 0;
        }

        $criteria = new CDbCriteria(array(
            'condition' => ':now <= expire AND department_id IN (0,:department_id)',
            'params' => array(
                ':now' => date('Y-m-d'),
                ':department_id' => $department_id
            )
        ));
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function getAllAnnouncements() {
        $employee = User::model()->findByPk(Yii::app()->user->id);
        $department_id = $employee->profile->emp_department;
        $criteria = new CDbCriteria(array(
            'condition' => 'department_id IN (0,:department_id)',
            'params' => array(
                ':department_id' => $department_id,
            )
        ));

        $announcements = Announcement::model()->with('reads')->findAll($criteria);

        return $announcements;
    }

    public static function DepartmentAnnouncements() {
        $employee = User::model()->findByPk(Yii::app()->user->id);
        $department_id = $employee->department_id;

        $criteria = new CDbCriteria(array(
            'condition' => ':now <= expire department_id IN (0,:department_id)',
            'with' => array('reads'),
            'params' => array(
                ':now' => date('Y-m-d'),
                ':department_id' => $department_id,
            )
        ));

        $announcements = Announcement::model()->findAll($criteria);

        return $announcements;
    }

    public static function TeamsAnnouncements() {
        $employee = User::model()->findByPk(Yii::app()->user->id);
        $department_id = $employee->Teams;
        dump($department_id);
        exit;
        $criteria = new CDbCriteria(array(
            'condition' => ':now <= expire AND department_id IN (0,:department_id)',
            'params' => array(
                ':now' => date('Y-m-d'),
                ':department_id' => $department_id,
            )
        ));

        $announcements = Announcement::model()
                ->findAll($criteria);

        return $announcements;
    }

    public function expiredAnnouncements() {
        $criteria = new CDbCriteria(array(
            'condition' => ':now >= expire',
            'params' => array(
                ':now' => date('Y-m-d'),
            )
        ));

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function isNotReaded() {
        return !$this->isReaded();
    }

    public function isReaded() {
        if (is_array($this->reads)) {
            foreach ($this->reads as $reads) {
                if ($reads->user_id === Yii::app()->user->id) {
                    return true;
                }
            }
        }

        return false;
    }

    public function getPriorityName() {
        switch ($this->priority) {
            case 1:
                return 'Low';
                break;

            case 2:
                return 'Medium';
                break;

            case 3:
                return 'High';
                break;

            default:
                return 'Unknown';
                break;
        }
    }

    public function getAssignedTo() {
        switch ($this->assigned_to) {
            case 1:
                return 'Company';
                break;

            case 3:
                return 'Department';
                break;

            case 4:
                return 'Team';
                break;

            default:
                return 'Unknown';
                break;
        }
    }

    public function getAssigner() {
        $assigner_id = $this->assigner_id;
        $text = $this->assignedTo . ': ';
        $company = CompanyStructures::model()->findByPk($assigner_id);
        if(isset($company)){
            $text .= $company->title;
        }else{
            $text .= 'Unknown';
        }
        return $text;
    }

    public function getTypeTitle() {
        if ($this->category) {
            return $this->category->title;
        } else {
            return 'Unknown';
        }
    }
    
    public function getUrl() {
        $firstWallEntryId = $this->id;

        if ($firstWallEntryId == "") {
            throw new CException("Could not create url for content!");
        }

        return Yii::app()->createUrl('//announcements/announcement/view', array('id' => $firstWallEntryId));
    }

}
