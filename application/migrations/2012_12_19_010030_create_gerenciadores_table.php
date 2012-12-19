<?php

class Create_Gerenciadores_Table {    

	public function up()
    {
		Schema::create('gerenciadores', function($table) {
			$table->increments('id');
			$table->string('nome');
			$table->string('login', 65);
			$table->string('senha', 65);
			$table->integer('nivel_acesso');
			$table->timestamps();
		});
    }    

	public function down()
    {
		Schema::drop('gerenciadores');
    }

}