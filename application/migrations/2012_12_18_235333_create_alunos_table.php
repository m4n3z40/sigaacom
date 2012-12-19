<?php

class Create_Alunos_Table {

	public function up()
    {
		Schema::create('alunos', function($table) {
			$table->increments('id');
			$table->string('matricula', 12);
			$table->string('nome');
			$table->string('senha', 65);
			$table->integer('turmas_id');
			$table->integer('cursos_id');
			$table->integer('cat_cursos_id');
			$table->timestamps();
		});
    }

	public function down()
    {
		Schema::drop('alunos');
    }

}