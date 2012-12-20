<?php

class Create_Alunos_Table {

	public function up()
    {
		Schema::create('alunos', function($table) {
			$table->increments('id');
			$table->string('matricula', 12);
			$table->string('nome');
			$table->string('senha', 65);
			$table->integer('turma_id')->unsigned();
			$table->integer('curso_id')->unsigned();
			$table->integer('cat_curso_id')->unsigned();
			$table->timestamps();
		});
    }

	public function down()
    {
		Schema::drop('alunos');
    }

}