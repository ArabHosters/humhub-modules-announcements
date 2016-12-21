<?php
/* @var $this NotificationReadsController */
/* @var $model NotificationReads */

$this->breadcrumbs=array(
	'Notification Reads'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NotificationReads', 'url'=>array('index')),
	array('label'=>'Manage NotificationReads', 'url'=>array('admin')),
);
?>

<h1>Create NotificationReads</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>