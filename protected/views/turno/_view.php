<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDTurno')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDTurno), array('view', 'id'=>$data->CDTurno)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMTurno')); ?>:</b>
	<?php echo CHtml::encode($data->NMTurno); ?>
	<br />


</div>