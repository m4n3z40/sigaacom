<?php

class Create_Cargas_Horarias_Table {    

	public function up()
    {
		Schema::create('cargas_horarias', function($table) {
			$table->increments('id');
			$table->float('min');
			$table->integer('cat_cursos_id');
			$table->integer('tipos_atv_id');
			$table->timestamps();
		});
    }    

	public function down()
    {
		Schema::drop('cargas_horarias');
    }

}