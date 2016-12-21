<?php
/* @var $this NotificationsController */
/* @var $dataProvider CActiveDataProvider */
?>
<div class="panel panel-default">
    <div class="panel-body">
        
    <a class="btn btn-xs btn-danger" href="<?php echo Yii::app()->createUrl('announcements'); ?>">Recent Announcements</a>

<!--<h1>Model Notifications</h1>-->

        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider->expiredAnnouncements(),
            'itemView' => '_view',
        ));
        ?>
    </div>
</div>

<?php
//Yii::app()->clientScript->registerScript('iso', "
////$($('.items')[0]).isotope({
//   // itemSelector : '.box-container',})
//   //  .height(($(window).height/100)*90);
////$(window).resize(function(){
////$($('.items')[0]).isotope('reLayout').height(($(window).height/100)*90);
////});
//$('.collapse').click(function(){
//$($('.items')[0]).delay(900).isotope('reLayout').height(($(window).height));
//return false;
//});
//");