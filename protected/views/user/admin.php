<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);


?>

<h1>Admin Page</h1>
<p class="lead">User Management</p>


<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbExtendedGridView',array(

	'type' => 'striped bordered hover',
	'dataProvider' => $model->search(),
	'filter' => $model,

	'columns' => array( 
		array(
			'name'=>'name', 
			'header' => 'First Name',
			'class' => 'bootstrap.widgets.TbEditableColumn',
			'editable'=>array(
				'type'=>'text', 
				'mode'=>'inline',
				'url' => $this->createUrl('user/updateinfo'))
			),
		array(
			'name' =>'lastname',
			'class' => 'bootstrap.widgets.TbEditableColumn',
			'editable'=>array(
				'type'=>'text', 
				'mode'=>'inline',
				'url' => $this->createUrl('user/updateinfo'))
			),
		array(
			'name'=>'course',
			'header' => 'Course',
			'class' => 'bootstrap.widgets.TbEditableColumn',
			'editable'=>array(
				'type'=>'text', 
				'mode'=>'inline',
				'url' => $this->createUrl('user/updateinfo'))
			
			),
		'username',
		array(
			'name'=>'active',
			'header'=>'Banned/Flagged',
			'class' => 'bootstrap.widgets.TbEditableColumn',
			'editable'=>array(
				'type'=>'select', 
				//'mode'=>'inline',
				'model'=>$model,
				'attribute' => 'power',
				'source' => $model->getBannedStatus(),
				'url' => $this->createUrl('user/powerchange'),
				)
			),
		array(
			'name'=>'power',
			'class' => 'bootstrap.widgets.TbEditableColumn',
			'editable'=>array(
				'type'=>'select', 
				//'mode'=>'inline',
				'model'=>$model,
				'attribute' => 'power',
				'source' => $model->getUserPower(),
				'url' => $this->createUrl('user/powerchange'),
			),

			),
		array(
			'name'=>'ban', 
			'header'=>'Active/Inactive', 
			'class'=>'bootstrap.widgets.TbToggleColumn', 
			'toggleAction'=>'user/toggle'
			),

			
			'email'
		),

)) ?>
