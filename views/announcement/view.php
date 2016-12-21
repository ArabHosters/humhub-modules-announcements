<?php
/* @var $this NotificationsController */
/* @var $model ModelNotifications */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4><?php echo $model->title; ?></h4>
    </div>
    <div class="panel-body">
        <div class="col-xs-12">
            <p><?php echo $model->content; ?></p>
            <?php if (isset($model->team->title)): ?>
                <small>
                    Team :
                    <cite title="Source Title"><?php echo $model->team->title; ?></cite>
                </small>
            <?php endif; ?>
        </div>
        <div class="clearfix"></div>
        <div style="border-top: 1px solid #e7e7e7;padding-top: 8px;font-size: 13px;">
            <div class="col-sm-6">
                <b class="muted">Expire Date : </b><?php echo $model->expire; ?>
            </div> 
            <div class="col-sm-6">
                <b class="muted">Assigned to : </b><?php echo $model->assigner; ?>
            </div> 
            <div class="col-sm-6">
                <b class="muted">Announcement Type : </b><?php echo $model->typeTitle; ?>
            </div> 
            <div class="col-sm-6">
                <b class="muted">Priority : </b><?php echo $model->priorityName; ?>
            </div> 
            <div class="clearfix"></div>
            <div class="col-sm-12">
                <h4 style="background: #e7e7e7;display: block;padding: 7px;border-radius: 5px;">Viewed by</h4>
                <?php
                $userlist = ""; // variable for users output
                $maxUser = 10; // limit for rendered users inside the tooltip


                for ($i = 0; $i < count($model->reads); $i++) {

                    // if only one user likes
                    // check if exists more user as limited
                    if ($i == $maxUser) {
                        // output with the number of not rendered users
                        $userlist .= Yii::t('PollsModule.widgets_views_entry', 'and {count} more view for this.', array('{count}' => (intval(count($model->reads) - $maxUser))));

                        // stop the loop
                        break;
                    } else {
                        $userlist .= "<strong>" . CHtml::encode($model->reads[$i]->user->displayName) . "</strong><br>";
                    }
                }
                ?>
                <p style="margin-top: 14px;">
                    <?php if (count($model->reads) > 0) { ?>
                        <a href="<?php echo $this->createUrl('//announcements/announcement/userListResults', array('id' => $model->id)); ?>"
                           class="tt" data-toggle="modal"
                           data-placement="top" title="" data-target="#globalModal"
                           data-original-title="<?php echo $userlist; ?>"><?php echo count($model->reads) . " " . Yii::t('PollsModule.widgets_views_entry', 'views'); ?></a>
                       <?php } else { ?>
                        0 <?php echo Yii::t('PollsModule.widgets_views_entry', 'views'); ?>
                    <?php } ?>
                </p>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>