
<?php
/* @var $this NotificationsController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = "Announcements";

//Yii::app()->clientScript->registerScriptFile(
//        Yii::app()->theme->baseUrl . '/assets/js/isotope/jquery.isotope.min.js', CClientScript::POS_END);
//Yii::app()->clientScript->registerScript('filter', "
//    $('#filter_btn a').click(function(){
//        var selector = $(this).attr('data-filter');
//        console.log(selector);
//        $('.items').isotope({ filter: selector }).height(($(window).height/100)*90);
//    });
//");
?>
<div class="panel panel-default">
    <div class="panel-heading">
        New Announcements
    </div>
    <div class="panel-body">
        <a class="btn btn-xs btn-danger" href="<?php echo Yii::app()->createUrl('announcements/announcement/archive'); ?>">Archive</a>
        <?php
        $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider->searchAllAnnouncements(),
            'itemView' => '_view',
        ));
        ?>
        <?php
        Yii::app()->clientScript->registerScript('iso', "
$('.collapse').click(function(){
$($('.items')[0]).delay(900).isotope('reLayout').height(($(window).height));
return false;
});
");
        ?>
    </div>
</div>