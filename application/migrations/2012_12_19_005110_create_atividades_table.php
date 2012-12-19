<?php

class Create_Atividades_Table {    

	public function up()
    {
		Schema::create('atividades', function($table) {
			$table->increments('id');
			$table->string('descricao', 255);
			$table->float('tempo');
			$table->integer('tipos_atv_id');
			$table->integer('alunos_id');
			$table->timestamps();
		});

    }    

	public function down()
    {
		Schema::drop('atividades');
    }

}