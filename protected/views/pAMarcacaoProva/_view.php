<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDMarcacao')); ?>:</b>
	<?php echo CHtml::encode($data->CDMarcacao); ?>
	<?php echo CHtml::link(CHtml::image(Yii::app()->createUrl('images/detalhar.png'),'Detalhar Prova'), array('view', 'id'=>$data->CDMarcacao)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('relDisciplina.NMDisciplina')); ?>:</b>
	<?php echo CHtml::encode($data->relDisciplina->NMDisciplina); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('relTurma.NMTurma')); ?>:</b>
	<?php echo CHtml::encode($data->relTurma->NMTurma); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('relProva.NMProva')); ?>:</b>
	<?php echo CHtml::encode($data->relProva->NMProva); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('relProfessor.NMProfessor')); ?>:</b>
	<?php echo CHtml::encode($data->relProfessor->NMProfessor); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('DATA')); ?>:</b>
	<?php echo CHtml::encode(@strftime('%d/%m/%Y', @strtotime($data->DATA))); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('relHorarioInicio.NMHorario')); ?>:</b>
	<?php echo CHtml::encode($data->relHorarioInicio->NMHorario); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('relHorarioFim.NMHorario')); ?>:</b>
	<?php echo CHtml::encode($data->relHorarioFim->NMHorario); ?>
	<br />


</div>