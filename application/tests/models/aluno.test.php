<?php

class Aluno_Test extends PHPUnit_Framework_TestCase 
{
	public static $categoriaCurso;

	public static $curso;

	public static $turma;

	public static $alunos = array();

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

		static::$alunos[] = static::$turma->alunos()->insert(array(
			'matricula' => '2013000001',
			'nome' => 'Zé Fulano da Silva',
			'senha' => Hash::make('123456'),
			'curso_id' => static::$curso->id,
			'cat_curso_id' => static::$categoriaCurso->id
		));

		static::$alunos[] = static::$turma->alunos()->insert(array(
			'matricula' => '2013000002',
			'nome' => 'Romarinho Jorge',
			'senha' => Hash::make('123456'),
			'curso_id' => static::$curso->id,
			'cat_curso_id' => static::$categoriaCurso->id
		));

		static::$alunos[] = static::$turma->alunos()->insert(array(
			'matricula' => '2013000003',
			'nome' => 'Ciclano Jesus',
			'senha' => Hash::make('123456'),
			'curso_id' => static::$curso->id,
			'cat_curso_id' => static::$categoriaCurso->id
		));
	}

	public function testTudoEstaProntoParaOsTestes()
	{		
		$this->assertInstanceOf('CategoriaCurso', static::$categoriaCurso);		
		$this->assertInstanceOf('Curso', static::$curso);
		$this->assertInstanceOf('Turma', static::$turma);

		foreach (static::$alunos as $aluno) {
			$this->assertInstanceOf('Aluno', $aluno);
		}
	}

	public function testAlunosSaoRecuperadosUmPorUmComSucesso()
	{
		foreach (static::$alunos as $expectedAluno) {
			$actualAluno = Aluno::find( $expectedAluno->id );

			$this->assertInstanceOf('Aluno', $actualAluno);
			$this->assertEquals( $expectedAluno->id, $actualAluno->id );
		}
	}

	public function testTodosOsAlunosSaoRecuperadosComSucesso()
	{
		$expected = count( static::$alunos );
		$actual = count( Aluno::all() );

		$this->assertGreaterThanOrEqual( $expected, $actual );
	}

	public function testRelacionamentoBelongsToTurma()
	{
		foreach (static::$alunos as $aluno) {
			$actualTurma = $aluno->turma;

			$this->assertEquals(static::$turma->id, $actualTurma->id);
		}
	}

	public function testRelacionamentoBelongsToCurso()
	{
		foreach (static::$alunos as $aluno) {
			$actualCurso = $aluno->curso;

			$this->assertEquals(static::$curso->id, $actualCurso->id);
		}
	}

	public function testRelacionamentoBelongsToCategoriaCurso()
	{
		foreach (static::$alunos as $aluno) {
			$actualCatCurso = $aluno->categoria_curso;

			$this->assertEquals(static::$categoriaCurso->id, $actualCatCurso->id);
		}
	}

	public function testRelacionamentoHasManyAtividade()
	{
		$tipoAtv = TipoAtividade::create(array(
			'abreviacao' => 'Estágio',
			'nome' => 'Nome'
		));

		$atividadesIds = array();

		foreach (static::$alunos as $aluno) {
			$atividadesIds[] = $aluno->atividades()->insert(array(
				'descricao' => 'Atividade qualquer',
				'tempo' => 120,
				'tipo_atv_id' => $tipoAtv->id
			))->id;
		}

		foreach (static::$alunos as $aluno) {
			$atividade = $aluno->atividades()->first();

			$this->assertContains($atividade->id, $atividadesIds);

			$atividade->delete();
		}

		$tipoAtv->delete();
	}

	public static function tearDownAfterClass()
	{
		foreach (static::$alunos as $aluno) {

			if ($aluno) {
				$aluno->delete();
			}

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

		static::$alunos = array();
	}
}