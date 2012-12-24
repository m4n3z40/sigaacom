<?php

class Turma_Test extends PHPUnit_Framework_TestCase 
{
	public static $categoriaCurso;

	public static $curso;

	public static $turma;

	public static function setUpBeforeClass()
	{
		static::$categoriaCurso = CategoriaCurso::create(array(
			'abreviacao' => 'Exatas',
			'nome' => 'Exatas'
		));

		static::$curso = Curso::create(array(
			'abreviacao' => 'SisInfo',
			'nome' => 'Sistemas de Informação',
			'cat_curso_id' => static::$categoriaCurso->id
		));

		static::$turma = Turma::create(array(
			'abreviacao' => 'SisInfo001',
			'nome' => 'Sistemas de Informação - 1º Período',
			'curso_id' => static::$curso->id,
			'cat_curso_id' => static::$categoriaCurso->id
		));
	}

	public function testEstaTudoCertoParaInicioDosTestes()
	{
		$this->assertInstanceOf('CategoriaCurso', static::$categoriaCurso);
		$this->assertInstanceOf('Curso', static::$curso);
		$this->assertInstanceOf('Turma', static::$turma);
	}

	public function testRecuperaTurmaUmPorUmComSucesso()
	{
		$actual = Turma::find( static::$turma->id );

		$this->assertInstanceOf('Turma', $actual);
		$this->assertEquals(static::$turma->id, $actual->id);
	}

	public function testRecuperaTodasTurmasComSucesso()
	{
		$expected = 1;
		$actual = count( Turma::all() );

		$this->assertGreaterThanOrEqual($expected, $actual);
	}

	public function testRelacionamentoBelongsToCategoriaCurso()
	{
		$actual = static::$turma->categoria_curso;

		$this->assertInstanceOf('CategoriaCurso', $actual);
		$this->assertEquals(static::$categoriaCurso->id, $actual->id);
	}

	public function testRelacionamentoBelongsToCurso()
	{
		$actual = static::$turma->curso;

		$this->assertInstanceOf('Curso', $actual);
		$this->assertEquals(static::$curso->id, $actual->id);
	}

	public function testRelacionamentoHasManyAluno()
	{
		$aluno = static::$turma->alunos()->insert(array(
			'matricula' => '2013000001',
			'nome' => 'Zé Fulano da Silva',
			'senha' => Hash::make('123456'),
			'curso_id' => static::$curso->id,
			'cat_curso_id' => static::$categoriaCurso->id
		));

		$this->assertInstanceOf('Aluno', $aluno);

		$actual = static::$turma->alunos()->first();

		$this->assertInstanceOf('Aluno', $actual);

		$this->assertEquals($aluno->id, $actual->id);

		static::$turma->alunos()->delete();

		$this->assertNull( Aluno::find( $aluno->id ) );
	}

	public static function tearDownAfterClass()
	{
		if (static::$turma instanceof Turma) {
			static::$turma->delete();
		}

		if (static::$curso instanceof Curso) {
			static::$curso->delete();
		}

		if (static::$categoriaCurso instanceof CategoriaCurso) {
			static::$categoriaCurso->delete();
		}
	}
}