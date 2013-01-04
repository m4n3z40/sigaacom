<?php

class CargaHoraria extends Basemodel 
{
	public static $table = 'cargas_horarias';

	public function categoria_curso()
	{
		return $this->belongs_to('CategoriaCurso', 'cat_curso_id');
	}

	public function tipo_atividade()
	{
		return $this->belongs_to('TipoAtividade', 'tipo_atv_id');
	}
}