<?php

class Atividade extends Eloquent 
{
	public static $timestamps = true;

	public function tipo_atividade()
	{
		return $this->belongs_to('TipoAtividade');
	}

	public function aluno()
	{
		return $this->belongs_to('Aluno');
	}
}