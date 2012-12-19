<?php

class Aluno extends Eloquent 
{
	public static $timestamps = true;

	public function turma()
	{
		return $this->belongs_to('Turma');
	}

	public function curso()
	{
		return $this->belongs_to('Curso');
	}

	public function categoria_curso()
	{
		return $this->belongs_to('CategoriaCurso');
	}
}