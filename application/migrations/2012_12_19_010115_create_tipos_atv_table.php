<?php

class Create_Tipos_Atv_Table {    

	public function up()
    {
		Schema::create('tipos_atv', function($table) {
			$table->increments('id');
			$table->string('abreviacao', 20);
			$table->string('nome');
			$table->timestamps();
		});
    }    

	public function down()
    {
		Schema::drop('tipos_atv');
    }

}