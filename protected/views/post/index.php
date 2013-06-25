<?php
/* @var $this PostController */
/* @var $dataProvider CActiveDataProvider */

// This is the area for the breadcrumbs and all
?>

<?php foreach ($post as $key): ?>
<div class="row-fluid">
	<div class="well">
			<h1><?php echo CHtml::encode($key->title); ?></h1>
			<p>Author : <?php echo CHtml::encode($key->user->name); ?></p>
			<p class="lead">Date : <?php echo CHtml::encode($key->created_on); ?></p>
			<?php echo $key->content; ?>
	</div>
</div>
<?php endforeach ?>

<div class ="pagination">
<?php $this->widget('CLinkPager',array(

	'pages'=>$pages, 
	'cssFile' => false,
	'header' => '',
    'nextPageLabel' => 'Next',
    'prevPageLabel' => 'Prev',
    'selectedPageCssClass' => 'active',
    'hiddenPageCssClass' => 'disabled',
    'htmlOptions' => array(
            'class' => '',
        )
    
	)); ?>
</div>

