<?php
/* @var $this AnnouncementController */
/* @var $dataProvider CActiveDataProvider */
?>

<h1>Announcements</h1>

<div class="box">
    <h3>In this page you can see all Announcements created.</h3>
</div>

<?php $this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view_aggregate',
)); ?>
