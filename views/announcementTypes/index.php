<?php
/* @var $this NotificationTypesController */
/* @var $model NotificationTypes */

Yii::app()->clientScript->registerScript('search', "
//$('.search-button').click(function(){
//	$('.search-form').toggle();
//	return false;
//});
$('.search-form form').submit(function(){
	$('#notification-types-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
        $('#search-box').modal('hide');
	return false;
});
");
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Announcement Types</h4>
        <div class="pull-right">
            <a href="<?php echo Yii::app()->createUrl('announcements/announcementTypes/create'); ?>" class="btn btn-warning btn-xs">
                <i class="fa fa-plus-square-o"></i> New Type
            </a>
            <a href="#search-box" data-toggle="modal" class="btn btn-grey  btn-xs"><i class="fa fa-search"></i> Advanced Search</a>
        </div>
    </div>
    <div class="panel-body">
        <?php
        $this->renderPartial('_search', array(
            'model' => $model,
        ));
        ?>

        <?php
        $visible = Yii::app()->user->isAdmin() ? true : false;

        $dataProvider = $model->search();
        if (Yii::app()->user->getState("pageSize", @$_GET["pageSize"]))
            $pageSize = Yii::app()->user->getState("pageSize", @$_GET["pageSize"]);
        else
            $pageSize = Yii::app()->params['pageSize'];
        $dataProvider->getPagination()->setPageSize($pageSize);

        $this->widget('application.widgets.CustomGridView', array(
            'id' => 'notification-types-grid',
            'dataProvider' => $dataProvider,
            'columns' => array(
                array(
                    'name' => 'id',
                    'htmlOptions' => array('width' => 20),
                    'headerHtmlOptions' => array('class' => 'custom header', 'style' => 'color:black;'),
                ),
                array(
                    'name' => 'title',
                    'value' => 'CHtml::link($data->title, Yii::app()->createUrl("announcements/announcementTypes/view/",array("id"=>$data->id)))',
                    'type' => 'raw',
                    'htmlOptions' => array('class' => 'link'),
                ),
                'priorityName',
                'announcementsCount',
                array(
                    'htmlOptions' => array('nowrap' => 'nowrap'),
                    'class' => 'application.widgets.CustomButtonColumn',
                    'visible' => $visible,
                )
            ),
        ));
        
        ?>
    </div>
</div>