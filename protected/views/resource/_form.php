<?php
/* @var $this ResourceController */
/* @var $model Resource */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'resource-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
	
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'link'); ?>
	

	
		<?php echo $form->labelEx($model,'info'); ?>
		<?php echo $form->textArea($model,'info',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'info'); ?>
	

	

	<?php $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'submit',
                        'type'=>'success',
                        'label'=>'Send',
                )); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->