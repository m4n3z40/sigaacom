@layout('layouts.default')

@section('main-nav')
	<li class="active">{{ HTML::link('/', 'Home') }}</li>
@endsection

@section('content')
	<div id="LoginFormWrapper" class="form-wrapper span6">
		<div class="form-info">
			<h2>Login de Gerenciamento</h2>
		</div>
		{{ Form::open('login', 'POST', ['class' => 'form-horizontal']) }}

			<div class="control-group">
				{{ Form::label('login', 'Login', ['class' => 'control-label']) }}
				<div class="controls">
					{{ Form::input('text', 'login') }}
				</div>
			</div>

			<div class="control-group">
				{{ Form::label('senha', 'Senha', ['class' => 'control-label']) }}
				<div class="controls">
					{{ Form::password('senha') }}
				</div>
			</div>

			<div class="form-actions">
				{{ Form::button('Entrar', ['class' => 'btn btn-primary']) }}	
			</div>

		{{ Form::close() }}
	</div>
@endsection
