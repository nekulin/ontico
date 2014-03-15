<?php
/**
 * @var $this SiteController
 * @var NewsTop[] $attrNews
 */

$this->pageTitle=Yii::app()->name;
?>

<h3>Кэшируем вывод</h3>

<?php $this->renderPartial('//layouts/_news_top_cache'); ?>

<br>
<h3>Из другой таблицы</h3>

<?php if ($attrNews) { ?>
    <?php foreach ($attrNews as $objNewsTop) { ?>
        <div><?php echo $objNewsTop->news->title; ?></div>
    <?php } ?>
<?php } ?>