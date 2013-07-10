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
	<div class="row-fluid">
	<div class="span8 offset1">
	<p class="muted">Fields with <span class="required">*</span> are required.</p>
	</div>

	</div>


	<?php echo $form->errorSummary($model); ?>
	
<div class="row-fluid">
						<div class="span5 offset3">
	
		<p><?php echo $form->labelEx($model,'complaint'); ?><p>
		<?php echo $form->textArea($model,'complaint',array('rows'=>9, 'cols'=>50)); ?>
		<?php echo $form->error($model,'complaint'); ?>
	
	<?php $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'submit',
                        'type'=>'inverse',
                        'block' => true,

                        'label'=>'Send',
                )); ?>

<?php $this->endWidget(); ?>
</div>
</div>


</div><!-- form -->