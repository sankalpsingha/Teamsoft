<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */
?>

<div class="span10">
	<div class="row-fluid">
		<div class="span3">
			<img <?php echo "src=".Yii::app()->request->baseUrl."/uploads/san.png"; ?> <?php echo CHtml::encode("alt="."\"".$model['name']."\""); ?> class="img-rounded img-polaroid">
						<?php $this->widget('bootstrap.widgets.TbButton',array(
							'label' => 'Change Profile Pic',
							'icon' => 'icon-edit',
							'type' => 'warning',
							'block' => true,
							
							'htmlOptions' => array(
								'data-toggle' => 'modal',
								'data-target' => '#myProfile',
								'style'=>'margin-top: 5px;',
								'class'=>'span12'
								),
						)); ?>

	 		<div class="row-fluid">
	 			<div class="span12">
	 				<p class="lead" style="text-align:center; margin-top: 10px;">MY TO-DO LIST</p>

					<?php 
					if(count($todos)) {
						?>
						<div id="table-wrap">
			<table class="table-bordered table-striped table-condensed table-hover" style="background-color: #fff;">
				<thead style="background">
					<th>Description</th>
					<th>Deadline</th>
					
				</thead>
				
				<tbody>
					<?php
						foreach ($todos as $todo){
							$days = Yii::app()->Date->daysCount($todo->deadline, Yii::app()->Date->now());
							$message = "";
							$class = "success";
							if ($days == 0) {
								$message = "Today";
								$class = "error";
							} elseif ($days == 1) {
								$message = "Tomorrow";
								$class = "warning";
							} elseif ($days == 2) {
								$message = "Day after tomorrow";
							} elseif ($days > 2) {
								$message = $days-1 ." days remaining";
							}
							?>
							<tr class="<?php echo $class; ?>">
							<td><?php echo Chtml::link(Chtml::encode($todo->description),'todo/view/'.$todo->id); ?></td>
							<td><?php echo Chtml::encode($message); ?></td>
							</tr>
							<?php
						}
						$this->widget('bootstrap.widgets.TbButton',array(
								//'htmlOptions' => array('style'=>'margin-top: -25px;'),
								'label' => 'Show all',
								'type' =>'info',
								'size' => 'mini'
			));
						?>
						</tbody>
			
				

			</table>
		</div>
						<?php
					} else {
						?>
						There are no todos for you right now.
						<?php
					}
					?>					

			<?php 
			 ?>


        
	 			</div>
	 		</div>
		</div>
		
		<div class="span9">
	 				<div class="well">
	 					<div class="row-fluid">
	 						<div class="span6">
	 							

	 							<h1 style="color: #99253b;"><?php echo CHtml::encode($model['name']." ".$model['lastname']); ?></h1>
	 					<p class="lead">
	 						<?php 
	 							$this->widget('bootstrap.widgets.TbEditableField', array(
								'type' => 'text',
								'mode' =>'inline',
								'model' => $model,
								'attribute' => 'course',
								'url' => $this->createUrl('user/updateinfo'), //url for submit data
								'placement' => 'right',
								)); ?>
	 						<?php //echo CHtml::encode($model['course']); ?>
	 					</p>

	 					<h2 style="margin-top: -20px; margin-bottom : -3px;">About me :</h2>
	 					<p style="font-size:18px;"><em>
	 						<?php 
	 							$this->widget('bootstrap.widgets.TbEditableField', array(
								'type' => 'textarea',
								//'mode' =>'inline',
								'model' => $model,
								'attribute' => 'about',
								'url' => $this->createUrl('user/updateinfo'), //url for submit data
								'placement' => 'right',
								)); ?>
	 						<?php //echo CHtml::encode($model['about']); ?>
	 					</em></p>


	 					<br>
	 					<address style="margin-top: -15px;">
	 						<abbr title="Phone">P:</abbr> (123) 456-7890 <br>
	 						<abbr title="Email">@:</abbr> <em><?php echo CHtml::encode($model['email']); ?></em>
	 					</address>
	 					<div id="roles">
	 						<?php if(User::model()->isAdmin()): ?>
	 							<span class="label label-important">Admin</span>
	 						<?php elseif(User::model()->isModerator()): ?>
	 							<span class="label label-warning">Moderator</span>
	 						<?php else: ?>
	 							<span class="label label-info">Member</span>
	 						<?php endif; ?>
	 					</div>
	 					<?php if ($model->modulesCount): ?>
	 						<p style="padding-top:10px;"><strong>Working For Modules :</strong></p>
		 					<div class="alert alert-info">
		 						<?php foreach ($modules as $key) {
		 							echo '<span class="badge badge-success">'.CHtml::link($key->category, array('module/view/'.$key->id),array('style'=>'color:#fff;')).'</span> ';
		 						} ?>
							</div>
	 					<?php endif ?>
	 					
	 					<?php $this->renderPartial('/status/_form',array('model'=>$status)); ?>
	 					<?php if (Yii::app()->user->hasFlash('statusCreated')): ?>
	 						<?php 

	 						$this->widget('bootstrap.widgets.TbAlert', array(
	 											
 												'block'=>true, // display a larger alert block?
												'fade'=>true, // use transitions?
												//'closeText'=>'×', // close link text - if set to false, no close link is displayed
												'alerts'=>array( // configurations per alert type
												'statusCreated'=>array(
														'block'=>true, 
														'fade'=>true, 
														'closeText'=>'×',
														), // success, info, warning, error or danger
												),
										)); ?>
	 					<?php endif ?>
						
	 						</div>

	 						<div class="span6">
	 							<!-- This is the area for the graph -->
								<?php 
								$yes = 0;
								foreach ($modulesArray as $value) {
									if($value['value'] > 0) {
										$yes = 1;
									}
								}
								if($yes) {
									?>
									<p class="lead" style="margin-left: 35px;">TEAM PROGRESS :</p>

						<?php 
        $this->widget(
            'ext.chartjs.widgets.ChPolar', 
            array(
                'width' => 250,
                'height' => 250,
                'htmlOptions' => array(),
                'drawLabels' => true,
                'datasets' => $modulesArray,
                'options' => array()
            )
        ); 
    ?>		
									<?php
								}
								?>
					

					<h3 style="margin-top:20px;">Current Status :</h3>
						<blockquote>
							<p><i class="icon-quote-left"></i> <?php echo CHtml::encode($lastStatus['status']); ?></p>
							 <small><?php echo CHtml::encode($lastStatus['created_on']); ?></small>
						</blockquote>

	 						</div>
	 					</div>
						

	 				</div>

	 	</div>

	 	<div class="row-fluid">
	 					<div class="span12">
	 						<div class="well">
							

<div id="statuses">
	 							<?php foreach ($statuses as $status): ?>
	 							<div class="status">
	 							<blockquote>
	 								<h4>
	 									<img src="http://placehold.it/64x64">
	 									<?php echo CHtml::link(Chtml::encode($status->user->name),'/'.$status->user->username); ?>
	 								</h4>

	 								<?php if ($status->user->id === Yii::app()->user->id): ?>
	 									<?php echo CHtml::link('<i class="icon-trash icon-large"></i>','#',array('submit'=>array('status/delete','id'=>$status->id),'confirm'=>'Are you sure?','csrf'=>true, 'class'=>'pull-right', 'style'=>'text-decoration:none;'));  ?>
	 								<?php endif ?>

	 								<p>
	 									<?php echo CHtml::encode($status->status); ?>
	 								</p>
	 								 <small><?php echo CHtml::encode($status->created_on); ?></small>
	 							</blockquote>
	 						<?php if ($status->statusCommentsCount): ?>
	 							<div class="row-fluid">
		 							<div class="span11 offset1 well" style="margin-top:10px;"> <span class="label label-important">COMMENTS :</span> 
		 								<?php $comments = $status->statusComments; ?>
		 								<?php foreach ($comments as $key_2): ?>
		 									<div class="comment-wrap">
			 									<blockquote>
			 										<?php if ($key_2->user_id === Yii::app()->user->id): ?>
			 											<?php echo CHtml::link('<i class="icon-trash icon-large"></i>','#',array('submit'=>array('statusComment/delete','id'=>$key_2->id),'confirm'=>'Are you sure?','csrf'=>true, 'class'=>'pull-right', 'style'=>'text-decoration:none;'));  ?>
			 										<?php endif ?>
			 										<h4><?php echo User::model()->findByPk($key_2->user_id)->name; ?></h4>
			 										<small><?php echo $key_2->created_on; ?></small>
			 										<p><?php echo $key_2->content; ?></p>
			 									</blockquote>
		 									</div>
		 								<?php endforeach ?>
		 							</div>
		 						</div>
	 						<?php endif ?>
	 						<?php $this->renderPartial('/statusComment/_form', array('model' => new StatusComment, 'id' => $status->id)); ?>
	 						<!-- <input  class="span12" placeholder="Enter your comment here..."></input>
	 						<button class="btn btn-mini btn-success" type="button" style="margin-top: 10px;"><i class="icon-comment"></i> Post Comment</button> -->
	 						</div>
	 							<?php endforeach ?>

	 							<?php 
								$this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    							'contentSelector' => '#statuses',
    							'itemSelector' => 'div.status',
    							'loadingText' => 'Loading...',
    							'donetext' => 'This is the end... my only friend, the end',
    							'pages' => $pages,
							)); ?>
	 						</div>

	 						


	 						</div>
	 					</div>
	 				</div>
	 		</div>



	</div>
</div>

<div class="span2">
	<div class="well ">

			<p style=" text-align: center;"><strong>Amount Spent :</strong></p>
			<p class="lead" style="text-align: center;"><?php echo CHtml::encode($amount); ?>/-</p>

			<?php 

				$this->widget('bootstrap.widgets.TbButtonGroup', array(
						'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
						'size' => 'mini',
						'buttons' => array(
											array('label' => 'Action', 'url' => '#'), // this makes it split :)
											array('items' => array(
											array('label' => 'Action', 'url' => '#'),
											array('label' => 'Another action', 'url' => '#'),
											array('label' => 'Something else', 'url' => '#'),
											'---',
											array('label' => 'Separate link', 'url' => '#'),
											)),
										),
									));
				 ?>

			<?php $this->widget('bootstrap.widgets.TbButton',array(
				'label' => 'Add',
				'icon' => 'icon-beer',
				'type' => 'success',
				'size' => 'mini',
				'htmlOptions' => array(
					'data-toggle' => 'modal',
					'data-target' => '#myModal',
					),
				)); ?>


				<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myModal')); ?>

					<div class="modal-header">
					<a class="close" data-dismiss="modal">&times;</a>
					<h4>Modal header</h4>
					</div>

					<div class="modal-body">
					<?php $this->renderPartial('/money/_form',array('model'=>$money)); ?>
					</div>

					<div class="modal-footer">
					<?php $this->widget('bootstrap.widgets.TbButton', array(
					'type' => 'primary',
					'label' => 'Save changes',
					'url' => '#',
					'htmlOptions' => array('data-dismiss' => 'modal'),
					)); ?>
					<?php $this->widget('bootstrap.widgets.TbButton', array(
					'label' => 'Close',
					'url' => '#',
					'htmlOptions' => array('data-dismiss' => 'modal'),
					)); ?>
					
					</div>

<?php $this->endWidget(); ?>
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'myProfile')); ?>
<div class="modal-header">
	<h4>Add Gallery Images</h4>
</div>
<div class="modal-body">
		
			<div class="span12">
				<?php $this->widget('bootstrap.widgets.TbFileUpload', array(
						    'url' => $this->createUrl("picture/upload"),
						    'model' => new Picture,
						    'attribute' => 'picture',
						    'multiple' => true,
						    'options' => array(
							    'maxFileSize' => 2000000,
							    'acceptFileTypes' => 'js:/(\.|\/)(gif|jpe?g|png)$/i',
								)
							)
						);
				?>
			</div>
		
</div>
<?php $this->endWidget(); ?>

		</div>


		<div class="row-fluid">
			<?php 
			$this->widget('bootstrap.widgets.TbButton',array(
				'label' => 'Add CAD Models',
				'type' => 'success',
				'block' => true,
				)); ?>
		</div>

		<div class="row-fluid" style="margin-top: 10px;">
			<?php 
			$this->widget('bootstrap.widgets.TbButton',array(
				'label' => 'Add  Gallery Images',
				'type' => 'success',
				'block' => true,
				'htmlOptions' => array(
								'data-toggle' => 'modal',
								'data-target' => '#myProfile',
								'style'=>'margin-top: 5px;',
								'class'=>'span12'
								),
					)
				); ?>
		</div>
</div>



