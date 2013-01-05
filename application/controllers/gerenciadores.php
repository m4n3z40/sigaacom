<?php

class Gerenciadores_Controller extends Base_Controller {

	public $restful = true;

	public function get_home()
	{
		if (Auth::check()) {
			return 'Você está logado ' . Auth::user()->login;
		}

		return 'Você não está logado!';
	} 

	public function get_login()
    {
    	return View::make('gerenciadores.login');
    }

    public function post_login()
    {
    	$usuario = array(
    		'username' => Input::get('login'),
    		'password' => Input::get('senha')
    	);

    	if ( Auth::attempt($usuario) ) {

    		return Redirect::to_route('home');

    	}

    	return Redirect::to_route('login')
    					 ->with_input()
    					 ->with(
    					 	'flash_message', 
    					 	'<div class="error"><p>A combinação de login e senha informados está incorreta.</p><p>Por favor verifique e tente novamente.</p></div'
    					 );
    }

	public function get_logout()
    {
    	Auth::logout();

    	return Redirect::to_route('login')
    				 	 ->with('flash_message', '<div class="info"><p>Você saiu do sistema com sucesso.</p></div>');
    }

}