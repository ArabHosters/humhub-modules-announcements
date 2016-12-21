<?php
/* @var $this AnnouncementController */
/* @var $data Announcement */
?>

<?php if(!(trim($data->team_id) === "")) : ?>
    <div class="view">
        <b><?php echo CHtml::encode($data->getAttributeLabel('team_id')); ?>:</b>
        <?php echo CHtml::encode($data->team_id); ?>
        <br />
        <hr />
        <?php $items = Announcement::model()->findAll(new CDbCriteria(array(
            'condition' => 'team_id=:team_id',
            'params' => array(
                ':team_id' => $data->team_id
            )
        ))); ?>
        <?php if (count($items)) : ?>
            <ul>
                <?php foreach ($items as $item) : ?>
                    <li><?php echo $item->content; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
<?php endif; ?>

