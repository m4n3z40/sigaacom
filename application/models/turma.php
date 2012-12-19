<?php

class Turma extends Eloquent 
{
	public static $timestamps = true;

	public function curso()
	{
		return $this->belongs_to('Curso');
	}

	public function categoria_curso()
	{
		return $this->belongs_to('CategoriaCurso');
	}
}