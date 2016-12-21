<?php
/* @var $this NotificationReadsController */
/* @var $model NotificationReads */

$this->breadcrumbs=array(
	'Notification Reads'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List NotificationReads', 'url'=>array('index')),
	array('label'=>'Create NotificationReads', 'url'=>array('create')),
	array('label'=>'View NotificationReads', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage NotificationReads', 'url'=>array('admin')),
);
?>


<div class="box border orange">
    <div class="box-title">
        <h4><i class="fa fa-bars"></i>Update NotificationReads <?php echo $model->id; ?></h4>   
    </div>
    <div class="box-body big">
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
</div>