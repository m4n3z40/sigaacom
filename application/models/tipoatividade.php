<?php

class TipoAtividade extends Eloquent 
{
	public static $table = 'tipos_atv';
	public static $timestamps = true;

	public function atividades()
	{
		return $this->has_many('Atividade', 'tipo_atv_id');
	}

	public function cargas_horarias()
	{
		return $this->has_many('CargaHoraria', 'tipo_atv_id');
	}
}