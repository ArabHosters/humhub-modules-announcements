<?php
/* @var $this AnnouncementController */
/* @var $model Announcement */

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
	$('#model-notifications-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
        $('#search-box').modal('hide');
	return false;
});
");
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Announcements</h4>
        <div class="pull-right">
            <a href="<?php echo Yii::app()->createUrl('announcements/announcement/create'); ?>" class="btn btn-warning btn-xs">
                <i class="fa fa-plus-square-o"></i> New Announcement
            </a>
            <a href="#search-box" data-toggle="modal" class="btn btn-grey  btn-xs">
                <i class="fa fa-search"></i> Advanced Search
            </a>
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

        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'model-notifications-grid',
            'dataProvider' => $dataProvider,
            'itemsCssClass' => 'table table-hover',
            'columns' => array(
                array(
                    'name' => 'id',
                    'htmlOptions' => array('width' => 20),
                ),
                array(
                    'name' => 'title',
                    'value' => 'CHtml::link($data->title, Yii::app()->createUrl("announcements/announcement/view/",array("id"=>$data->id)))',
                    'type' => 'raw',
                    'htmlOptions' => array('class' => 'link'),
                ),
                'expire',
                'priorityName',
                'assigner',
                'category.title',
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