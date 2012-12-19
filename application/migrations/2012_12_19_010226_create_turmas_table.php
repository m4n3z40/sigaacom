<?php

class Create_Turmas_Table {    

	public function up()
    {
		Schema::create('turmas', function($table) {
			$table->increments('id');
			$table->string('abreviacao', 20);
			$table->string('nome');
			$table->integer('cursos_id');
			$table->integer('cat_cursos_id');
			$table->timestamps();
		});
    }    

	public function down()
    {
		Schema::drop('turmas');
    }

}