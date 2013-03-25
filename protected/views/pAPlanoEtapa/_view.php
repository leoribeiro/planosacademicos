<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bimestre')); ?>:</b>
	<?php echo CHtml::encode($data->bimestre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ano')); ?>:</b>
	<?php echo CHtml::encode($data->ano); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('professor')); ?>:</b>
	<?php echo CHtml::encode($data->professor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('turma')); ?>:</b>
	<?php echo CHtml::encode($data->turma); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('disciplina')); ?>:</b>
	<?php echo CHtml::encode($data->disciplina); ?>
	<br />


</div>