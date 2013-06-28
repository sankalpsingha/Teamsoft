<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
?>
<?php
if(Yii::app()->session['flagged'] === 1) {
	$this->redirect(array('user/flagged'));
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo CHtml::encode($this->pageTitle); ?></title>


</head>
<body>




<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/login.css'); ?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
								//'htmlOptions' => array('class'=>'form-horizontal'),
								'id'=>'login-form',
								//'enableClientValidation'=>true,
								'clientOptions'=>array(
								'validateOnSubmit'=>true,
								),
							)
	); 
?>
		<div class="container-fluid"><div class="row-fluid">					
			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<a href="#" style="text-decoration:none; margin-top:-5px;">Forgot Password</a>
						<i class="icon-group"></i>
						<?php echo CHtml::link('Register',array('user/create')); ?>
					</div>
						<h2 class="offset2" style="color: #99253b;"><i class="icon-unlock icon-2x"></i>Fahrenheit</h2>

								<div class="input-prepend" title="Username">
								<span class="add-on"><i class=" icon-user icon-large"></i></span>
								
								<?php echo $form->textField($model,'username',array('class'=>"input-large span10",'placeholder'=>'Your username')); ?>
								</div>

								<div class="clearfix"></div>
	
								<div class="input-prepend" title="Password">
								<span class="add-on"><i class=" icon-lock icon-large"></i></span>
								<?php echo $form->passwordField($model,'password',array('class'=>"input-large span10",'placeholder'=>'Your Password')); ?>
								<?php //echo $form->error($model,'password'); ?>
								</div>
								
								<?php //echo $form->errorSummary($model); ?>
								<?php echo $form->error($model,'username'); ?>

								<label class="checkbox remember">
								<?php echo $form->checkBox($model,'rememberMe'); ?> Remember me
								</label>
	
								
	
								<div class="row-fluid">
                           		 <div class="span10 offset1">
								<?php $this->widget('bootstrap.widgets.TbButton', array(
                        			'buttonType'=>'submit',
                        			'block' => true,
                        			'type'=>'info',
                        			'label'=>'Enter',
                				)); ?>
                				</div>
								</div>
								<div class="clearfix"></div> 
	

								<?php $this->endWidget(); ?>

					
					<hr>					                    
				</div>
			</div>			
			</div></div>



			<footer></footer>
				
	

<!-- Other stuffs -->

</body>
</html>