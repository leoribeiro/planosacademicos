<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDTurma')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDTurma), array('view', 'id'=>$data->CDTurma)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMTurma')); ?>:</b>
	<?php echo CHtml::encode($data->NMTurma); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('relModalidade.NMModalidade')); ?>:</b>
	<?php echo CHtml::encode($data->relModalidade->NMModalidade); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('relTurno.NMTurno')); ?>:</b>
	<?php echo CHtml::encode($data->relTurno->NMTurno); ?>
	<br />


</div>