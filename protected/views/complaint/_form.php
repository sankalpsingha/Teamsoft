<?php
/* @var $this ComplaintController */
/* @var $model Complaint */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'complaint-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
		<?php echo $form->labelEx($model,'complaint'); ?>
		<?php echo $form->textArea($model,'complaint',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'complaint'); ?>
	
	<?php $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'submit',
                        'type'=>'success',
                        'label'=>'Send',
                )); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->