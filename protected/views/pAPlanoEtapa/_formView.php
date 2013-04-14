<table class="table table-bordered">
<tr>
	<td><strong>Disciplina</strong></td>
	<td><?php echo $model->relDisciplina->NMDisciplina; ?></td>
</tr>
<tr>
	<td><strong>Turma</strong></td>
	<td><?php echo $model->relTurma->NMTurma; ?></td>
</tr>
<tr>
	<td><strong>Ano</strong></td>
	<td><?php echo $model->ano; ?></td>
</tr>
<tr>
	<td><strong>Professor</strong></td>
	<td><?php echo $model->relProfessor->relServidor->NMServidor; ?></td>
</tr>
</table>
