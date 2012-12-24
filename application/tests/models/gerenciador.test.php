<?php

class Gerenciador_Test extends PHPUnit_Framework_TestCase 
{
	public static $gerenciadores = array();

	public static function setUpBeforeClass()
	{
		static::$gerenciadores[] = Gerenciador::create(array(
			'nome' => 'Administrador',
			'login' => 'admin',
			'senha' => Hash::make('123456'),
			'nivel_acesso' => Gerenciador::ADMINISTRADOR
		));

		static::$gerenciadores[] = Gerenciador::create(array(
			'nome' => 'Gerenciador Principal',
			'login' => 'gerpri',
			'senha' => Hash::make('123456'),
			'nivel_acesso' => Gerenciador::GERENCIADOR_PRINCIPAL
		));

		static::$gerenciadores[] = Gerenciador::create(array(
			'nome' => 'Gerenciador Auxiliar',
			'login' => 'geraux',
			'senha' => Hash::make('123456'),
			'nivel_acesso' => Gerenciador::GERENCIADOR_AUXILIAR
		));
	}

	public function testTudoEstaProntoParaOsTestes()
	{
		foreach (static::$gerenciadores as $gerenciador) {
			$this->assertInstanceOf('Gerenciador', $gerenciador);
		}
	}

	public function testRecuperaGerenciadorUmPorUmComSucesso()
	{
		foreach (static::$gerenciadores as $expected) {
			$actual = Gerenciador::find( $expected->id );

			$this->assertInstanceOf('Gerenciador', $actual);
			$this->assertEquals($expected->id, $actual->id);
		}
	}

	public function testRecuperaTodosGerenciadoresComSucesso()
	{
		$expected = count( static::$gerenciadores );
		$actual = count( Gerenciador::all() );

		$this->assertGreaterThanOrEqual( $expected, $actual );
	}

	public static function tearDownAfterClass()
	{
		foreach (static::$gerenciadores as $gerenciador) {
			if ($gerenciador instanceof Gerenciador) {
				$gerenciador->delete();
			}
		}
	}
}