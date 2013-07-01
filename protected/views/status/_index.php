<div class="status">
	<blockquote>
		<h4>
			<img src="http://placehold.it/64x64">
			<?php echo CHtml::link(Chtml::encode($status->user->name),'/'.$status->user->username); ?>
		</h4>
			<?php echo CHtml::link('<i class="icon-trash icon-large"></i>','#',array('submit'=>array('status/delete','id'=>$status->id),'confirm'=>'Are you sure?','csrf'=>true, 'class'=>'pull-right', 'style'=>'text-decoration:none;'));  ?>
		<p>
			<?php echo CHtml::encode($status->status); ?>
		</p>
		 <small><?php echo CHtml::encode($status->created_on); ?></small>
	</blockquote>
	<?php $this->renderPartial('/statusComment/_form', array('model' => new StatusComment, 'id' => $status->id)); ?>
	<?php
		$printStatus = $status->status;
		$printStatus = str_replace(array("'", '"'), '', $printStatus);
        $printStatus = CJSON::encode($printStatus);
    ?>
</div>
<script type="text/javascript">
$('#current-status').text('<?php echo " ".$printStatus; ?>').hide().toggle('slide', 'left');
$('#Status_status').val('');
</script>