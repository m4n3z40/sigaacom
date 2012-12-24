<?php

class Gerenciador extends Eloquent 
{
	const ADMINISTRADOR = 9999;
	const GERENCIADOR_PRINCIPAL = 8888;
	const GERENCIADOR_AUXILIAR = 11;

	public static $table = 'gerenciadores';
	public static $timestamps = true;
}