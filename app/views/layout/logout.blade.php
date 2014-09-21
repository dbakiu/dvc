{{ Form::open( ['route' => 'logout', 'method' => 'get' ] ) }}
{{ Form::submit('Log out', ['class' => 'btn btn-large btn-primary openbutton']) }}
{{ Form::close() }}
