<?php
/* @var $this PostController */
/* @var $dataProvider CActiveDataProvider */

// This is the area for the breadcrumbs and all
?>

<div id="posts">
	<?php foreach ($post as $key): ?>
<div class="row-fluid">
	<div class="post"><div class="well">
			<h1><?php echo CHtml::encode($key->title); ?></h1>
			<p>Author : <?php echo CHtml::encode($key->user->name); ?></p>
			<p class="lead">Date : <?php echo CHtml::encode($key->created_on); ?></p>
			<?php echo $key->content; ?>
	</div></div>
</div>
<?php endforeach ?>
</div>

<?php 
	$this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#posts',
    'itemSelector' => 'div.post',
    'loadingText' => 'Loading...',
    'donetext' => 'This is the end... my only friend, the end',
    'pages' => $pages,
)); ?>

