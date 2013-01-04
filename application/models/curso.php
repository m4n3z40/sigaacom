<?php

class Curso extends Basemodel 
{
	public function categoria()
	{
		return $this->belongs_to('CategoriaCurso', 'cat_curso_id');
	}

	public function alunos()
	{
		return $this->has_many('Aluno', 'curso_id');
	}

	public function turmas()
	{
		return $this->has_many('Turma', 'curso_id');
	}
}