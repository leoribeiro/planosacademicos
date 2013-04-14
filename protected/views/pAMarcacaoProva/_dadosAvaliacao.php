<table class="table table-bordered table-striped">
<tr>
	<td style="width: 250px"><strong>Avaliação</strong></td>
	<td><?php echo $model->descricao; ?></td>
</tr>
<tr>
	<td><strong>Valor</strong></td>
	<td><?php echo $model->valor; ?></td>
</tr>
<tr>
	<td><strong>Conteúdo</strong></td>
	<td><?php echo CHtml::activeTextArea($modelT, 'conteudo', array('class'=>'span8', 'rows'=>5)); ?></td>
</tr>

</table>
