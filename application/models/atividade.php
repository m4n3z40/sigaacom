<?php

class Atividade extends Basemodel 
{
	public function tipo_atividade()
	{
		return $this->belongs_to('TipoAtividade', 'tipo_atv_id');
	}

	public function aluno()
	{
		return $this->belongs_to('Aluno', 'aluno_id');
	}
}