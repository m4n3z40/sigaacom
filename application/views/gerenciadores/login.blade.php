@layout('layouts.default')

@section('main-nav')
	<li class="active">{{ HTML::link('/', 'Home') }}</li>
@endsection

@section('content')
	<div id="LoginFormWrapper" class="form-wrapper span6">
		<h1>Logo da Instituição aqui.</h1>
		<div class="form-info">
			<h3>Login de Gerenciamento</h3>

			@if( Session::has('flash_message') )
				<div class="flash-message">
					{{ Session::get('flash_message') }}
				</div>
			@endif
		</div>
		{{ Form::open('login', 'POST', ['class' => 'form-horizontal']) }}

			{{ Form::token() }}

			<div class="control-group">
				{{ Form::label('login', 'Login', ['class' => 'control-label']) }}
				<div class="controls">
					{{ Form::input('text', 'login', Input::old('login')) }}
				</div>
			</div>

			<div class="control-group">
				{{ Form::label('senha', 'Senha', ['class' => 'control-label']) }}
				<div class="controls">
					{{ Form::password('senha') }}
				</div>
			</div>

			<div class="form-actions">
				{{ Form::submit('Entrar', ['class' => 'btn btn-primary']) }}	
			</div>

		{{ Form::close() }}
	</div>
@endsection
