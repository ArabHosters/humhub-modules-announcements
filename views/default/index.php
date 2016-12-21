<?php $this->breadcrumbs = array($this->module->id); ?>
<div class="panel panel-default">
    <div class="panel-heading">New Announcements</div>
    <div class="panel-body">

        <a class="btn btn-xs btn-danger" href="<?php echo Yii::app()->createUrl('announcements'); ?>">Recent Announcements</a><br/><br/>
        <div class="span-14 box first">
            <?php $number = 1; ?>
            <?php while (Yii::app()->user->hasFlash('success' . ($number))) : ?>
                <?php $message = Yii::app()->user->getFlash('success' . ($number)); ?>
                <div class="alert alert-block alert-info fade in">
                    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
                    <p></p><h4><i class="fa fa-bell fa-fw"></i> <?php echo $message['title']; ?> - <?php echo $message['category']->title; ?></h4> 
                    <?php echo $message['message']; ?>
                    <p></p>
                </div>
                <?php $number = $number + 1; ?>
            <?php endwhile; ?>
            <?php if ($number == 1) : ?>
                <em>0 announcement</em>
            <?php endif; ?>
        </div>
        <h3>All Announcements</h3>
        <div style="text-align: center;">
            <div class="span-14 box last">
                <?php foreach ($announcements as $announcement) : ?>
                    <div class="box">
                        <a href="#"><?php echo $announcement->expire; ?></a> - 
                        <a href="#"><?php echo $announcement->content; ?></a> <br />
                        <a href="<?php echo $this->createUrl('/announcements/default/read', array('id' => $announcement->id)); ?>">mark as read</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>