<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDModalidade')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDModalidade), array('view', 'id'=>$data->CDModalidade)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMModalidade')); ?>:</b>
	<?php echo CHtml::encode($data->NMModalidade); ?>
	<br />


</div>