<?php
/* @var $this AnnouncementReadsController */
/* @var $data AnnouncementReads */
?>

<div class="view">
    <strong><?php echo $data->user->username; ?></strong> has read announcement <strong><?php echo $data->announcement->content; ?></strong> that expire at <strong><?php echo $data->announcement->expire; ?></strong>.
</div>