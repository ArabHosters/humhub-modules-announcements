<?php
/* @var $this AnnouncementTypesController */
/* @var $model AnnouncementTypes */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        Details
        <div class="pull-right">
            <?php echo CHtml::link("", Yii::app()->createUrl("announcements/announcementTypes/update/", array("id" => $model->id)), array("class" => "btn btn-warning fa fa-pencil-square-o")); ?>
        </div>
    </div>

    <div class="panel-body" id="ticket-wrapper">
        <?php
        $this->widget('zii.widgets.CDetailView', array(
            'data' => $model,
            'attributes' => array(
                'id',
                'title',
                'priorityName',
            ),
        ));
        ?>
    </div>
</div>
