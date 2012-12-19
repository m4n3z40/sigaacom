<?php

class Create_Atividades_Table {    

	public function up()
    {
		Schema::create('atividades', function($table) {
			$table->increments('id');
			$table->string('descricao', 255);
			$table->float('tempo');
			$table->integer('tipos_atv_id')->unsigned();
			$table->integer('alunos_id')->unsigned();
			$table->timestamps();
		});

    }    

	public function down()
    {
		Schema::drop('atividades');
    }

}