<?php

class TipoAtividade_Test extends PHPUnit_Framework_TestCase 
{
	public static $tiposAtividades;

	public static function setUpBeforeClass()
	{
		static::$tiposAtividades[] = TipoAtividade::create(array(
			'abreviacao' => 'Estágio',
			'nome' => 'Estágio'
		));

		static::$tiposAtividades[] = TipoAtividade::create(array(
			'abreviacao' => 'PP',
			'nome' => 'Pesquisa e Prática'
		));

		static::$tiposAtividades[] = TipoAtividade::create(array(
			'abreviacao' => 'Outros',
			'nome' => 'Outros'
		));
	}

	public function testTudoEstaProntoParaInicioDosTestes()
	{
		foreach (static::$tiposAtividades as $tipoAtividade) {
			$this->assertInstanceOf('TipoAtividade', $tipoAtividade);
		}
	}

	public function testRecuperaTipoAtividadeUmPorUmComSucesso()
	{
		foreach (static::$tiposAtividades as $expected) {
			$actual = TipoAtividade::find( $expected->id );

			$this->assertInstanceOf('TipoAtividade', $actual);
			$this->assertEquals($expected->id, $actual->id);
		}
	}

	public function testRecuperaTodosTiposAtiviidadesComSucesso()
	{
		$expected = count( static::$tiposAtividades );
		$actual = count( TipoAtividade::all() );

		$this->assertGreaterThanOrEqual($expected, $actual);
	}

	public static function tearDownAfterClass()
	{
		foreach (static::$tiposAtividades as $tipoAtividade) {
			if ($tipoAtividade instanceof TipoAtividade) {
				$tipoAtividade->delete();
			}
		}
	}
}