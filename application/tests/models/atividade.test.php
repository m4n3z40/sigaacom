<?php

class Atividade_Test extends PHPUnit_Framework_TestCase 
{
	public static $categoriaCurso;

	public static $curso;

	public static $turma;

	public static $aluno;

	public static $tipoAtividade;

	public static $atividades = array();

	public static function setUpBeforeClass()
	{
		static::$categoriaCurso = CategoriaCurso::create(array(
			'nome' => 'Cursos de Exatas',
			'abreviacao' => 'Exatas'
		));

		static::$curso = static::$categoriaCurso->cursos()->insert(array(
			'nome' => 'Sistemas de Informação',
			'abreviacao' => 'SisInfo'
		));

		static::$turma = static::$curso->turmas()->insert(array(
			'nome' => '1º Período de Sistemas de Informação',
			'abreviacao' => '201301sisinfo',
			'cat_curso_id' => static::$categoriaCurso->id
		));

		static::$aluno = static::$turma->alunos()->insert(array(
			'matricula' => '2013000001',
			'nome' => 'Zé Fulano da Silva',
			'senha' => Hash::make('123456'),
			'curso_id' => static::$curso->id,
			'cat_curso_id' => static::$categoriaCurso->id
		));

		static::$tipoAtividade = TipoAtividade::create(array(
			'abreviacao' => 'Estágio',
			'nome' => 'Estágio'
		));

		static::$atividades[] = static::$aluno->atividades()->insert(array(
			'descricao' => 'Atividade 1',
			'tempo' => 120,
			'tipo_atv_id' => static::$tipoAtividade->id
		));

		static::$atividades[] = static::$aluno->atividades()->insert(array(
			'descricao' => 'Atividade 2',
			'tempo' => 180,
			'tipo_atv_id' => static::$tipoAtividade->id
		));

		static::$atividades[] = static::$aluno->atividades()->insert(array(
			'descricao' => 'Atividade 3',
			'tempo' => 240,
			'tipo_atv_id' => static::$tipoAtividade->id
		));
	}

	public function testTudoCertoParaInicioDosTestes()
	{
		$this->assertNotEmpty(static::$categoriaCurso);
		$this->assertNotEmpty(static::$curso);
		$this->assertNotEmpty(static::$turma);
		$this->assertNotEmpty(static::$aluno);
		$this->assertNotEmpty(static::$tipoAtividade);

		foreach (static::$atividades as $atividade) {
			$this->assertNotEmpty($atividade);
		}
	}

	public function testRecuperaAtividadesUmPorUmComSucesso()
	{
		foreach (static::$atividades as $expected) {
			$actual = Atividade::find( $expected->id );

			$this->assertEquals( $expected->id, $actual->id );
		}
	}

	public function testRecuperaTodasAtividadesComSucesso()
	{
		$expected = count( static::$atividades );
		$actual = count( Atividade::all() );

		$this->assertGreaterThanOrEqual( $expected, $actual );
	}

	public function testRecuperaTodasAtividadesDeUmAlunoComSucesso()
	{
		$expected = static::$atividades;
		$actual = static::$aluno->atividades;

		for ($i=0; $i < count($expected); $i++) { 
			$this->assertEquals( $expected[$i]->id, $actual[$i]->id );
		}
	}

	public function testRelacionamentoBelongsToTipoAtividade()
	{
		$expected = static::$tipoAtividade;

		foreach (static::$atividades as $atividade) {
			$actual = $atividade->tipo_atividade;

			$this->assertEquals( $expected->id, $actual->id );
		}
	}

	public function testRelacionamentoBelongsToAluno()
	{
		$expected = static::$aluno;

		foreach (static::$atividades as $atividade) {
			$actual = $atividade->aluno;

			$this->assertEquals( $expected->id, $actual->id );
		}
	}

	public static function tearDownAfterClass()
	{
		foreach (static::$atividades as $atividade) {
			if ($atividade) {
				$atividade->delete();
			}		
		}

		if (static::$tipoAtividade) {
			static::$tipoAtividade->delete();
		}

		if (static::$aluno) {
			static::$aluno->delete();
		}

		if (static::$turma) {
			static::$turma->delete();
		}

		if (static::$curso) {
			static::$curso->delete();
		}

		if (static::$categoriaCurso) {
			static::$categoriaCurso->delete();						
		}
	}
}