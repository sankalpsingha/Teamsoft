<?php
$this->breadcrumbs=array(
	'Module'=>array('index'),
	'Add Users',
);
?>
<h1>Add Users</h1>
<?php echo "Module -> ".$model->category; ?>

<div class="form">
	
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'module-form',
		'enableAjaxValidation'=>false,
	)); ?>

	<div class="row-fluid">
		<?php echo $form->labelEx($model, 'mod'); ?>
		<?php $this->widget('ext.select2.ESelect2',array(
			'model'=>$model,
			'attribute'=>'users',
			'data'=>$model->getAllUser(),
			'options' => array(
				'width'=>'20%',
				'placeholder'=>'Type here to list the users.',
				'allowClear'=>true,
			),
			'htmlOptions'=>array(
				'multiple'=>'multiple',

			),
		)); 
		?>
		<?php echo $form->error($model, 'mod'); ?>
	</div>

	<div class="row-fluid">

		<?php $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'submit',
                        'type'=>'success',
                        'label'=>'Send',
                )); ?>
	</div>
	<?php $this->endWidget(); ?>
</div>