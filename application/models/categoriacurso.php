<?php

class CategoriaCurso extends Basemodel 
{
	public static $table = 'cat_cursos';

	public function alunos()
	{
		return $this->has_many('Aluno', 'cat_curso_id');
	}

	public function cargas_horarias()
	{
		return $this->has_many('CargaHoraria', 'cat_curso_id');
	}

	public function cursos()
	{
		return $this->has_many('Curso', 'cat_curso_id');
	}

	public function turmas()
	{
		return $this->has_many('Turma', 'cat_curso_id');
	}
}