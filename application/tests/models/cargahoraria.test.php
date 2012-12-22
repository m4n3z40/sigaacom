<?php

class CargaHoraria_Test extends PHPUnit_Framework_TestCase 
{
	public static $categoriaCurso;

	public static $tipoAtividade;

	public static $cargasHorarias = array();

	public static function setUpBeforeClass()
	{
		static::$categoriaCurso = CategoriaCurso::create(array(
			'nome' => 'Cursos de Exatas',
			'abreviacao' => 'Exatas'
		));

		static::$tipoAtividade = TipoAtividade::create(array(
			'abreviacao' => 'Estágio',
			'nome' => 'Estágio'
		));

		static::$cargasHorarias[] = static::$tipoAtividade->cargas_horarias()->insert(array(
			'min' => 21600,
			'cat_curso_id' => static::$categoriaCurso->id
		));

		static::$cargasHorarias[] = static::$tipoAtividade->cargas_horarias()->insert(array(
			'min' => 14400,
			'cat_curso_id' => static::$categoriaCurso->id
		));

		static::$cargasHorarias[] = static::$tipoAtividade->cargas_horarias()->insert(array(
			'min' => 4800,
			'cat_curso_id' => static::$categoriaCurso->id
		));
	}

	public function testTudoCertoParaComecarOsTestes()
	{
		$this->assertNotEmpty(static::$categoriaCurso);
		$this->assertNotEmpty(static::$tipoAtividade);

		foreach (static::$cargasHorarias as $cargaHoraria) {
			$this->assertNotEmpty($cargaHoraria);
		}
	}

	public function testRecuperaCargasHorariasUmPorUmComSucesso()
	{
		foreach (static::$cargasHorarias as $expected) {
			$actual = CargaHoraria::find( $expected->id );

			$this->assertEquals( $expected->id, $actual->id );
		}
	}

	public function testRecuperarTodasCargasHorariasComSucesso()
	{
		$expected = count( static::$cargasHorarias );
		$actual = count( CargaHoraria::all() );

		$this->assertGreaterThanOrEqual( $expected, $actual );
	}

	public function testRelacionamentoBelongsToCategoriaCurso()
	{
		$expected = static::$categoriaCurso;

		foreach (static::$cargasHorarias as $cargaHoraria) {
			$actual = $cargaHoraria->categoria_curso;

			$this->assertEquals( $expected->id, $actual->id );
		}
	}

	public function testRelacionamentoBelongsToTipoAtividade()
	{
		$expected = static::$tipoAtividade;

		foreach (static::$cargasHorarias as $cargaHoraria) {
			$actual = $cargaHoraria->tipo_atividade;

			$this->assertEquals( $expected->id, $actual->id );
		}
	}

	public static function tearDownAfterClass()
	{
		foreach (static::$cargasHorarias as $cargaHoraria) {
			if ($cargaHoraria) {
				$cargaHoraria->delete();
			}		
		}

		if (static::$tipoAtividade) {
			static::$tipoAtividade->delete();
		}

		if (static::$categoriaCurso) {
			static::$categoriaCurso->delete();						
		}
	}
}