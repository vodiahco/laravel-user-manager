

{{ Form::open(array('route'=>'post-login', 'class'=>'form-signin')) }}
    <h2 class="form-signin-heading">Please Login</h2>
 
    @if (Session::has('flash_error'))
        <div class="alert alert-danger">{{ Session::get('flash_error') }}</div>
    @endif
    @include('layout.fragments.error', ['errors' => $errors])
    
    {{ Form::text('email', null, array('class'=>'form-control margin-bottom', 'placeholder'=>'Email Address')) }}
    {{ Form::password('password', array('class'=>'form-control margin-bottom', 'placeholder'=>'Password')) }}
 
    {{ Form::submit('Login', array('class'=>'btn btn-lg btn-success margin-top'))}}
{{ Form::close() }}