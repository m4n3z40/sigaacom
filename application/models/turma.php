<?php

class Turma extends Basemodel 
{
	public function curso()
	{
		return $this->belongs_to('Curso', 'curso_id');
	}

	public function categoria_curso()
	{
		return $this->belongs_to('CategoriaCurso', 'cat_curso_id');
	}

	public function alunos()
	{
		return $this->has_many('Aluno', 'turma_id');
	}
}