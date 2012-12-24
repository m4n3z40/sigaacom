<?php

class Add_Constraints_To_All_Tables {    

	public function up()
    {
    	Schema::table('alunos', function($table) {
    		$table->unique('matricula');

    		$table->foreign('cat_curso_id')
    			  ->references('id')
    			  ->on('cat_cursos');

    		$table->foreign('curso_id')
    			  ->references('id')
    			  ->on('cursos');

    		$table->foreign('turma_id')
    			  ->references('id')
    			  ->on('turmas')
    			  ->on_delete('cascade')
    			  ->on_update('cascade');
		});

		Schema::table('atividades', function($table) {
			$table->foreign('tipo_atv_id')
				  ->references('id')
				  ->on('tipos_atv')
				  ->on_delete('cascade')
				  ->on_update('cascade');

			$table->foreign('aluno_id')
				  ->references('id')
				  ->on('alunos')
				  ->on_delete('cascade')
				  ->on_update('cascade');
		});

		Schema::table('cargas_horarias', function($table) {
			$table->foreign('cat_curso_id')
				  ->references('id')
				  ->on('cat_cursos');

			$table->foreign('tipo_atv_id')
				  ->references('id')
				  ->on('tipos_atv');
		});

		Schema::table('cursos', function($table) {
			$table->foreign('cat_curso_id')
				  ->references('id')
				  ->on('cat_cursos')
				  ->on_delete('cascade')
				  ->on_update('cascade');
		});

		Schema::table('turmas', function($table) {
			$table->foreign('curso_id')
				  ->references('id')
				  ->on('cursos')
				  ->on_delete('cascade')
				  ->on_update('cascade');

			$table->foreign('cat_curso_id')
				  ->references('id')
				  ->on('cat_cursos');
		});
    }    

	public function down()
    {
		Schema::table('alunos', function($table) {
			$table->drop_foreign('alunos_cat_curso_id_foreign');
			$table->drop_foreign('alunos_curso_id_foreign');
			$table->drop_foreign('alunos_turma_id_foreign');
		});

		Schema::table('atividades', function($table) {
			$table->drop_foreign('atividades_tipo_atv_id_foreign');
			$table->drop_foreign('atividades_aluno_id_foreign');
		});

		Schema::table('cargas_horarias', function($table) {
			$table->drop_foreign('cargas_horarias_cat_curso_id_foreign');
			$table->drop_foreign('cargas_horarias_tipo_atv_id_foreign');
		});

		Schema::table('cursos', function($table) {
			$table->drop_foreign('cursos_cat_curso_id_foreign');
		});

		Schema::table('turmas', function($table) {
			$table->drop_foreign('turmas_curso_id_foreign');
			$table->drop_foreign('turmas_cat_curso_id_foreign');
		});
    }

}