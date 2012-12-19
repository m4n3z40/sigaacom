<?php

class Add_Constraints_To_All_Tables {    

	public function up()
    {
    	//@TODO: ADD CONSTRAINTS TO ALL TABLES REFERING TO DE OLD SQL FILE
		Schema::table('all', function($table) {

		});
    }    

	public function down()
    {
    	//@TODO: REMOVE CONSTRAINTS OF ALL TABLES
		Schema::table('all', function($table) {

		});
    }

}