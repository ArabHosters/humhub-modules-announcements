<?php

/**
 * This is the model class for table "announcement_reads".
 *
 * The followings are the available columns in table 'announcement_reads':
 * @property integer $id
 * @property integer $user_id
 * @property integer $announcement_id
 * @property integer $readed
 */
class AnnouncementReads extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return NotifyiiReads the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{announcement_reads}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('user_id', 'required'),
            array('announcement_id, readed', 'numerical', 'integerOnly' => true),
            array('id, user_id, announcement_id, readed', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
           'announcement' => array(self::BELONGS_TO, 'Announcement', 'announcement_id'),
           'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user_id' => 'User',
            'announcement_id' => 'Announcement',
            'readed' => 'Readed',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('announcement_id', $this->announcement_id);
        $criteria->compare('readed', $this->readed);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

}
