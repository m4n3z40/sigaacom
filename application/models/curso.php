<?php

class Curso extends Eloquent 
{
	public static $timestamps = true;

	public function categoria()
	{
		return $this->belongs_to('CategoriaCurso');
	}
}