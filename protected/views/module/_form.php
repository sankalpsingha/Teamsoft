<?php
/* @var $this ModuleController */
/* @var $model Module */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveform', array(
	'id'=>'module-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
		<?php echo $form->labelEx($model,'category'); ?>
		<?php echo $form->textField($model,'category',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'category'); ?>
	

	
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	

	
		<?php //echo $form->labelEx($model,'user_id'); ?>
		<?php //echo $form->dropDownList($model,'user_id',$model->getAllUser()); ?>

		 <?php echo $form->dropDownListRow($model, 'user_id',$model->getAllUser(), array('multiple'=>true)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	

	<div class="row-fluid">

		<?php $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'submit',
                        'type'=>'success',
                        'label'=>'Send',
                )); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->