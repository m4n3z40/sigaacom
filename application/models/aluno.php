<?php

class Aluno extends Basemodel 
{
	public function turma()
	{
		return $this->belongs_to('Turma', 'turma_id');
	}

	public function curso()
	{
		return $this->belongs_to('Curso', 'curso_id');
	}

	public function categoria_curso()
	{
		return $this->belongs_to('CategoriaCurso', 'cat_curso_id');
	}

	public function atividades()
	{
		return $this->has_many('Atividade', 'aluno_id');
	}
}