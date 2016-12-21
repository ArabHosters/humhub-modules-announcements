<?php
/* @var $this AnnouncementReadsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Announcement Reads',
);

?>

<h1>Announcement Reads</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
