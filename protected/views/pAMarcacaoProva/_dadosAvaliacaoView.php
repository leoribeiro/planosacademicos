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
	<td><?php echo $modelT->conteudo; ?></td>
</tr>

<tr>
	<td style="width: 250px"><strong>Tipo de turma</strong></td>
	<td><?php echo $modelT->relTipoTurma->NMTipoTurma; ?></td>
</tr>
<tr>
	<td><strong>Data da Prova</strong></td>
	<?php 
		$DataProva= $modelT->data;
		$ar = explode('-', $DataProva);
		$modelT->data = $ar[2].'/'.$ar[1].'/'.$ar[0];

		$modelInicio = Horario::model()->findByPk($modelT->inicio);
		$modelFim = Horario::model()->findByPk($modelT->fim);

	?>
	<td><?php echo $modelT->data; ?>, de <?php echo $modelInicio->NMHorario; ?> até <?php echo $modelFim->NMHorario; ?></td>
</tr>

</table>
