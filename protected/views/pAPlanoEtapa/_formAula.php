<div id="addAula">
	
	<?php echo CHtml::label('Data','aula_data'); ?>
    <?php echo CHtml::textField('aula_data', '',array('class'=>'span3')); ?>
	
	<?php echo CHtml::label('Conteúdo','aula_conteudo'); ?>
    <?php echo CHtml::textArea('aula_conteudo', '',array('class'=>'span9','rows'=>'9')); ?>
	
	<?php echo CHtml::label('Material/Exercícios','aula_material'); ?>
    <?php echo CHtml::textArea('aula_material', '',array('class'=>'span9','rows'=>'6')); ?>

</div>