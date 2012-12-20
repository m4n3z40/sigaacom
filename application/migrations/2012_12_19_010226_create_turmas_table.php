<?php

class Create_Turmas_Table {    

	public function up()
    {
		Schema::create('turmas', function($table) {
			$table->increments('id');
			$table->string('abreviacao', 20);
			$table->string('nome');
			$table->integer('curso_id')->unsigned();
			$table->integer('cat_curso_id')->unsigned();
			$table->timestamps();
		});
    }    

	public function down()
    {
		Schema::drop('turmas');
    }

}