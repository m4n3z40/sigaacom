<?php

class Create_Cat_Cursos_Table {    

	public function up()
    {
		Schema::create('cat_cursos', function($table) {
			$table->increments('id');
			$table->string('abreviacao', 20);
			$table->string('nome');
			$table->timestamps();
		});

    }    

	public function down()
    {
		Schema::drop('cat_cursos');
    }

}