<?php

class Curso_Test extends PHPUnit_Framework_TestCase 
{
	public static $categoria;

	public static $curso;

	public static function setUpBeforeClass()
	{
		static::$categoria = CategoriaCurso::create(array(
			'abreviacao' => 'Exatas',
			'nome' => 'Exatas'
		));

		static::$curso = static::$categoria->cursos()->insert(array(
			'abreviacao' => 'SisInfo',
			'nome' => 'Sistemas de Informação'
		));
	}

	public function testTudoEstaProntoParaInicioDosTestes()
	{
		$this->assertInstanceOf('CategoriaCurso', static::$categoria);
		$this->assertInstanceOf('Curso', static::$curso);
	}

	public function testRecuperaCursosUmPorUmComSucesso()
	{
		$actual = Curso::find( static::$curso->id );

		$this->assertInstanceOf('Curso', $actual);
		$this->assertEquals(static::$curso->id, $actual->id);
	}

	public function testRecuperaTodosCursosComSucesso()
	{
		$expected = 1;
		$actual = count( Curso::all() );

		$this->assertGreaterThanOrEqual($expected, $actual);
	}

	public function testRelacionamentoBelongsToCategoria()
	{
		$expected = static::$categoria;
		$actual = static::$curso->categoria;

		$this->assertInstanceOf('CategoriaCurso', $actual);
		$this->assertEquals($expected->id, $actual->id);
	}

	public function testRelacionamentoHasManyTurma()
	{
		$turma = static::$curso->turmas()->insert(array(
			'nome' => '1º Período de Sistemas de Informação',
			'abreviacao' => '201301sisinfo',
			'cat_curso_id' => static::$categoria->id
		));

		$this->assertInstanceOf('Turma', $turma);

		$actual = static::$curso->turmas()->first();

		$this->assertInstanceOf('Turma', $actual);

		$this->assertEquals($turma->id, $actual->id);

		static::$curso->turmas()->delete();

		$this->assertNull( Turma::find( $turma->id ) );
	}

	public function testRelacionamentoHasManyAluno()
	{
		$turma = static::$curso->turmas()->insert(array(
			'nome' => '1º Período de Sistemas de Informação',
			'abreviacao' => '201301sisinfo',
			'cat_curso_id' => static::$categoria->id
		));

		$aluno = static::$curso->alunos()->insert(array(
			'matricula' => '2013000001',
			'nome' => 'Zé Fulano da Silva',
			'senha' => Hash::make('123456'),
			'turma_id' => $turma->id,
			'cat_curso_id' => static::$categoria->id
		));

		$this->assertInstanceOf('Aluno', $aluno);

		$actual = static::$curso->alunos()->first();

		$this->assertInstanceOf('Aluno', $actual);

		$this->assertEquals($aluno->id, $actual->id);

		static::$curso->alunos()->delete();
		static::$curso->turmas()->delete();

		$this->assertNull( Aluno::find( $aluno->id ) );
	}

	public static function tearDownAfterClass()
	{
		if (static::$curso instanceof Curso) {
			static::$curso->delete();
		}

		if (static::$categoria instanceof CategoriaCurso) {
			static::$categoria->delete();
		}
	}
}