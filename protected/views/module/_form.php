<?php
/* @var $this ModuleController */
/* @var $model Module */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'module-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
		<p><?php echo $form->labelEx($model,'category'); ?></p>
		<?php echo $form->textField($model,'category',array('size'=>60,'maxlength'=>100,'placeholder'=>'Type category')); ?>
		<p><?php echo $form->error($model,'category'); ?></p>
	

	
		<p><?php echo $form->labelEx($model,'description'); ?></p>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50,'placeholder'=>'Type Description here.')); ?>
		<?php echo $form->error($model,'description'); ?>

		<p><?php echo $form->labelEx($model, 'color'); ?></p>
		<?php $this->widget('application.extensions.colorpicker.EColorPicker', 
              array(
                    'name'=>'Module[color]',
                    'mode'=>'textfield',
                    'fade' => true,
                    'slide' => true,
                    'curtain' => true,
                   )
             ); 
        ?>
        <?php echo $form->error($model, 'color'); ?>


		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php //echo $form->dropDownList($model,'user_id',$model->getAllUser()); ?>

		 <?php //echo $form->dropDownListRow($model, 'user_id',$model->getAllUser(), array('multiple'=>true)); ?>

		<div class="row-fluid">
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
							  )
							); ?>

		</div>

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