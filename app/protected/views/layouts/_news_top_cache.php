<?php
/**
 * @var Controller $this
 */
?>

<?php if($this->beginCache('news_top', array('duration'=>3600))) { ?>
    <?php if ($attrNews=News::findAllTopLimit()) { ?>
        <?php foreach ($attrNews as $objNews) { ?>
            <div>
                <?php echo $objNews->title; ?>
            </div>
        <?php } ?>
    <?php } ?>
<?php $this->endCache(); } ?>