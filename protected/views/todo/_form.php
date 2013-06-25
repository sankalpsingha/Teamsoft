<?php
/* @var $this TodoController */
/* @var $model Todo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'todo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'todocol'); ?>
		<?php echo $form->textField($model,'todocol',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'todocol'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deadline'); ?>
		<?php //echo $form->textField($model,'deadline'); ?>
		<?php 
		Yii::app()->clientScript->registerScript('variables', 'var myApp = new Date();');
		Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
		$this->widget('CJuiDateTimePicker',array(
			'name' => 'Todo[deadline]',
        	'model'=>$model,
        	'mode'=>'datetime',
        	'options'=>array(
        		'dateFormat' => 'yy-mm-dd',
        		'minDate' => 'myApp',
        		)
        	)
		); 
		?>
		<?php echo $form->error($model,'deadline'); ?>
	</div>

	<!-- <div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div> -->

	<div class="row-fluid">
			<?php $this->widget('ext.select2.ESelect2',array(
  							'model'=>$model,
							  'attribute'=>'users',
							  'data'=>$model->getUsers($model->module_id),
							  'options' => array(
							  	'width'=>'20%',
							  	'placeholder'=>'Type here to list the users.',
    							'allowClear'=>true,
							  	),
							  'htmlOptions'=>array(
							    'multiple'=>'multiple',
							    
							  ),
							  )
							); ?>

		</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->