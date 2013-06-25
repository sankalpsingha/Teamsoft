<?php /* @var $this Controller */ ?>
<!doctype html>

<!-- 

This is the property of the CampusPlugin Team.

@authors : Sankalp Singha , Jagjot Singh, Neeraj Rana

 -->

<head>
	
	<meta name="language" content="en" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" style="margin-top:20px;">

<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/fahrenheit.css'); ?>

<?php $this->widget('bootstrap.widgets.TbNavbar', array(
		'brand' => Yii::app()->name,
		'fixed' => false,
		'collapse' => true,
		'type' => 'list',
		'items' => array(
			array(
					'class' => 'bootstrap.widgets.TbMenu',

					'items' => array(

										'',
										array('label'=>'Home', 'url'=>array('/user/dashboard'),'icon'=>'icon-home icon-large'),'',
										array('label'=>'Complaint', 'url'=>array('/complaint/create'),'icon'=>'icon-warning-sign'),'',
										array('label'=>'Create Module', 'url'=>array('/module/create'),'icon'=>'icon-tag'),'',
										array('label'=>'Blog', 'url'=>array('/blog/'),'icon'=>'icon-bullhorn'),'',
										array('label'=>'CAD/GALLERY', 'url'=>array('/blog/'),'icon'=>'icon-picture'),'',
										array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
										array('label'=>User::model()->findByPk(Yii::app()->user->id)->name, 'url'=>array('/site/logout'), 'icon'=>'icon-off', 'visible'=>!Yii::app()->user->isGuest),'',

										 //'<form class="navbar-search pull-right" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
									)
								)
							)
						));
 ?>
	

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>


<div class="row-fluid">

	<?php echo $content; ?> 
</div>
	

</div><!-- container end -->

</body>
</html>
