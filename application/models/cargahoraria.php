<?php

class CargaHoraria extends Eloquent 
{
	public static $table = 'cargas_horarias';
	public static $timestamps = true;

	public function categoria_curso()
	{
		return $this->belongs_to('CategoriaCurso');
	}

	public function tipo_atividade()
	{
		return $this->belongs_to('TipoAtividade');
	}
}