<style type="text/css">
#planoetapa-grid tbody:hover
{
        cursor: pointer;

}
.grid-view table.items tr.selected {
    background: none repeat scroll 0 0 #f5f5f5;
}
.grid-view table.items tr:hover {
    background: none repeat scroll 0 0 #f5f5f5;
}
</style>

<div id="titlePages">
		Planos de etapa
</div>
<script type="text/javascript">

function atualizaGrid(){

	$.fn.yiiGridView.update('planoetapa-grid', {
		data: $("#pe").serialize()
	});
	return false;
}
</script>

<?php echo $this->renderPartial('_search', array('model'=>$model)); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'planoetapa-grid',
	'type'=>' bordered',
	'dataProvider'=>$model->search(),
	'enableSorting' => false,
	//'filter'=>$model,
	'selectableRows'=>1,
	'selectionChanged'=>'function(id){ window.location = "'.$this->createUrl('view').'?id="+$.fn.yiiGridView.getSelection(id)+"&userUrl=t";}',
	'columns'=>array(
		array(
            'name' => 'relDisciplina.NMDisciplina',
            'value' => '$data->relDisciplina->NMDisciplina',
            'header' => 'Disciplina',
        ),
        array(
            'name' => 'relProfessor.relServidor.NMServidor',
            'value' => '$data->relProfessor->relServidor->NMServidor',
            'header' => 'Professor',
        ),
		'relTurma.NMTurma',
		'ano',
	),
)); ?>
