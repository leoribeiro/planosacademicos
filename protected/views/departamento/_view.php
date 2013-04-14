<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDDepartamento')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDDepartamento), array('view', 'id'=>$data->CDDepartamento)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMDepartamento')); ?>:</b>
	<?php echo CHtml::encode($data->NMDepartamento); ?>
	<br />


</div>