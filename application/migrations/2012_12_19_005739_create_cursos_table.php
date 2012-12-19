<?php

class Create_Cursos_Table {    

	public function up()
    {
		Schema::create('cursos', function($table) {
			$table->increments('id');
			$table->string('abreviacao', 20);
			$table->string('nome');
			$table->integer('cat_cursos_id');
			$table->timestamps();
		});
    }    

	public function down()
    {
		Schema::drop('cursos');
    }

}