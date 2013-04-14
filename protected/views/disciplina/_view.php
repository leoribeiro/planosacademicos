<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDDisciplina')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDDisciplina), array('view', 'id'=>$data->CDDisciplina)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMDisciplina')); ?>:</b>
	<?php echo CHtml::encode($data->NMDisciplina); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('SGDisciplina')); ?>:</b>
	<?php echo CHtml::encode($data->SGDisciplina); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('relDepartamento.NMDepartamento')); ?>:</b>
	<?php echo CHtml::encode($data->relDepartamento->NMDepartamento); ?>
	<br />


</div>