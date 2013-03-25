<table class="table table-bordered">
<tr>
	<td><h5>Disciplina<h5></td>
	<td><h5> <?php echo $model->relDisciplina->NMDisciplina; ?><h5></td>
</tr>
<tr>
	<td><h5>Turma<h5></td>
	<td><h5> <?php echo $model->relTurma->NMTurma; ?><h5></td>
</tr>
<tr>
	<td><h5>Ano<h5></td>
	<td><h5> <?php echo $model->ano; ?><h5></td>
</tr>
<tr>
	<td><h5>Professor<h5></td>
	<td><h5> <?php echo $model->relProfessor->relServidor->NMServidor; ?><h5></td>
</tr>
</table>
