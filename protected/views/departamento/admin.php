<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('departamento-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div id="titlePages">
		Departamentos
</div>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Novo Departamento',
    'type'=>'primary',
    'size'=>'',
    'url'=>$this->createUrl('Departamento/create')
)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'departamento-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>'striped bordered',
	'columns'=>array(
		'CDDepartamento',
		'NMDepartamento',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
