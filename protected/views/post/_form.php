<?php
/* @var $this PostController */
/* @var $model Post */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'post-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	

	

	
		<p><?php echo $form->labelEx($model,'title'); ?></p>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	

	
		
		<?php echo $form->ckEditorRow($model, 'content', array('options'=>array('fullpage'=>'js:true', 'width'=>'640', 'resize_maxWidth'=>'640','resize_minWidth'=>'320')));?>
		

		
			<div style="margin-top:20px;"><?php $this->widget('ext.select2.ESelect2',array(
  							'model'=>$model,
							'attribute'=>'tag',
							'data'=>Tag::model()->getAllTags(),
							'options' => array(
							  	'width'=>'20%',
							  	'placeholder'=>'Start tagging here.',
							  	
    							'allowClear'=>true,
							  	),
							'htmlOptions'=>array(
						    'multiple'=>'multiple',

							    
							  ),
							  )
							); ?>

						<?php echo $form->error($model,'tag'); ?>
						</div>

							<?php $this->widget('bootstrap.widgets.TbButton',array(
								'type' => 'info',
								'label' => 'Add new tags',
								'url' => array('tag/create'),
 							)); ?>

		
	

		<?php //echo $form->textFieldRow($tag, 'tag', array('class'=>'span3')); ?>
	
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',$model->getPostStatus()); ?>

		<?php echo $form->error($model,'status'); ?>
	

	<div class="row-fluid">
			<div class="span4 offset4" >
			<?php 
			$this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'submit',
                        'type'=>'inverse',
                        'block'=>'true',
                        'label'=>'Post',
                        'htmlOptions' => array(
                        	'class' =>  'span9',
                        ),
            )); 
            ?>
            </div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->