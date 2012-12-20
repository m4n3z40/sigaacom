<?php

class Aluno_Test extends PHPUnit_Framework_TestCase 
{
	public $categoriaCurso;

	public $curso;

	public $turma;

	public $alunos = array();

	public function setUp()
	{
		$this->categoriaCurso = CategoriaCurso::create(array(
			'nome' => 'Cursos de Exatas',
			'abreviacao' => 'Exatas'
		));

		$this->curso = $this->categoriaCurso->cursos()->insert(array(
			'nome' => 'Sistemas de Informação',
			'abreviacao' => 'SisInfo'
		));

		$this->turma = $this->curso->turmas()->insert(array(
			'nome' => '1º Período de Sistemas de Informação',
			'abreviacao' => '201301sisinfo',
			'cat_curso_id' => $this->categoriaCurso->id
		));

		$this->alunos[] = $this->turma->alunos()->insert(array(
			'matricula' => '2013000001',
			'nome' => 'Zé Fulano da Silva',
			'senha' => Hash::make('123456'),
			'curso_id' => $this->curso->id,
			'cat_curso_id' => $this->categoriaCurso->id
		));

		$this->alunos[] = $this->turma->alunos()->insert(array(
			'matricula' => '2013000002',
			'nome' => 'Romarinho Jorge',
			'senha' => Hash::make('123456'),
			'curso_id' => $this->curso->id,
			'cat_curso_id' => $this->categoriaCurso->id
		));

		$this->alunos[] = $this->turma->alunos()->insert(array(
			'matricula' => '2013000003',
			'nome' => 'Ciclano Jesus',
			'senha' => Hash::make('123456'),
			'curso_id' => $this->curso->id,
			'cat_curso_id' => $this->categoriaCurso->id
		));
	}

	public function testTudoEstaProntoParaOsTestes()
	{		
		$this->assertNotEmpty($this->categoriaCurso);		
		$this->assertNotEmpty($this->curso);
		$this->assertNotEmpty($this->turma);

		foreach ($this->alunos as $aluno) {
			$this->assertNotEmpty($aluno);
		}
	}

	public function testAlunosSaoRecuperadosUmPorUmComSucesso()
	{
		foreach ($this->alunos as $expectedAluno) {
			$actualAluno = Aluno::find( $expectedAluno->id );

			$this->assertEquals( $actualAluno->id, $expectedAluno->id );
		}
	}

	public function testTodosOsAlunosSaoRecuperadosComSucesso()
	{
		$expected = count( $this->alunos );
		$actual = count( Aluno::all() );

		$this->assertGreaterThanOrEqual( $expected, $actual );
	}

	public function tearDown()
	{
		foreach ($this->alunos as $aluno) {

			if ($aluno) {
				$aluno->delete();
			}

		}

		if ($this->turma) {
			$this->turma->delete();
		}

		if ($this->curso) {
			$this->curso->delete();
		}

		if ($this->categoriaCurso) {
			$this->categoriaCurso->delete();						
		}

		$this->alunos = array();
	}
}