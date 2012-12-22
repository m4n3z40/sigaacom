<?php

class CategoriaCurso_Test extends PHPUnit_Framework_TestCase 
{
	public static $categoriaCurso;

	public static function setUpBeforeClass()
	{
		static::$categoriaCurso = CategoriaCurso::create(array(
			'abreviacao' => 'Exatas',
			'nome' => 'Exatas'
		));
	}

	public function testTudoCertoParaInicioDosTestes()
	{
		$this->assertNotEmpty(static::$categoriaCurso);
	}

	public function testRecuperaCategoriasCursoumPorUmComSucesso()
	{
		$actual = CategoriaCurso::find( static::$categoriaCurso->id );

		$this->assertEquals(static::$categoriaCurso->id, $actual->id);
	}

	public function testRecuperaTodasCategoriasCursoComSucesso()
	{
		$expected = 1;
		$actual = count( CategoriaCurso::all() );

		$this->assertGreaterThanOrEqual($expected, $actual);
	}

	public function testRelacionamentoHasManyCurso()
	{
		$curso = static::$categoriaCurso->cursos()->insert(array(
			'abreviacao' => 'SisInfo',
			'nome' => 'Sistemas de Informação'
		));

		$this->assertInstanceOf('Curso', $curso);
		$this->assertNotNull(Curso::find( $curso->id ));

		static::$categoriaCurso->cursos()->delete();

		$this->assertNull(Curso::find( $curso->id ));
	}

	public function testRelacionamentoHasManyTurma()
	{
		$curso = static::$categoriaCurso->cursos()->insert(array(
			'abreviacao' => 'SisInfo',
			'nome' => 'Sistemas de Informação'
		));

		$turma = static::$categoriaCurso->turmas()->insert(array(
			'abreviacao' => 'SisInfo1001',
			'nome' => '1º Período de Sistemas de Informação',
			'curso_id' => $curso->id
		));

		$this->assertInstanceOf('Turma', $turma);
		$this->assertNotNull(Turma::find( $turma->id ));

		static::$categoriaCurso->turmas()->delete();
		static::$categoriaCurso->cursos()->delete();

		$this->assertNull(Turma::find( $curso->id ));
	}

	public function testRelacionamentoHasManyAluno()
	{
		$curso = static::$categoriaCurso->cursos()->insert(array(
			'abreviacao' => 'SisInfo',
			'nome' => 'Sistemas de Informação'
		));

		$turma = static::$categoriaCurso->turmas()->insert(array(
			'abreviacao' => 'SisInfo1001',
			'nome' => '1º Período de Sistemas de Informação',
			'curso_id' => $curso->id
		));

		$aluno = static::$categoriaCurso->alunos()->insert(array(
			'matricula' => '2013000001',
			'nome' => 'Zé Fulano da Silva',
			'senha' => Hash::make('123456'),
			'curso_id' => $curso->id,
			'turma_id' => $turma->id
		));

		$this->assertInstanceOf('Aluno', $aluno);
		$this->assertNotNull(Aluno::find( $aluno->id ));

		static::$categoriaCurso->alunos()->delete();
		static::$categoriaCurso->turmas()->delete();
		static::$categoriaCurso->cursos()->delete();

		$this->assertNull(Aluno::find( $aluno->id ));
	}

	public function testRelacionamentohasManyCargasHorarias()
	{
		$tipoAtv = TipoAtividade::create(array(
			'abreviacao' => 'Estágio',
			'nome' => 'Estágio'
		));

		$cargaHoraria = static::$categoriaCurso->cargas_horarias()->insert(array(
			'min' => 20000,
			'tipo_atv_id' => $tipoAtv->id
		));

		$this->assertInstanceOf('CargaHoraria', $cargaHoraria);
		$this->assertNotNull(CargaHoraria::find( $cargaHoraria->id ));

		static::$categoriaCurso->cargas_horarias()->delete();
		$tipoAtv->delete();

		$this->assertNull(cargaHoraria::find( $cargaHoraria->id ));
	}

	public static function tearDownAfterClass()
	{
		if (static::$categoriaCurso) {
			static::$categoriaCurso->delete();
		}
	}
}