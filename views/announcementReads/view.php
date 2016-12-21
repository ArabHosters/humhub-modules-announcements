<?php
/* @var $this NotificationReadsController */
/* @var $model NotificationReads */

$this->breadcrumbs=array(
	'Notification Reads'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List NotificationReads', 'url'=>array('index')),
	array('label'=>'Create NotificationReads', 'url'=>array('create')),
	array('label'=>'Update NotificationReads', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete NotificationReads', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NotificationReads', 'url'=>array('admin')),
);
?>

<h1>View NotificationReads #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'notification_id',
		'readed',
	),
)); ?>
