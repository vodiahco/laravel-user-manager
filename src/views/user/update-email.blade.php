

{{ Form::open(array('route'=>'post-email-update', 'class'=>'form-signin')) }}
    <h2 class="form-signin-heading">Update account email</h2>
 
    @if (Session::has('flash_error'))
        <div class="alert alert-danger">{{ Session::get('flash_error') }}</div>
    @endif
    @include('layout.fragments.error', ['errors' => $errors])
    
    {{ Form::text('email', null, array('class'=>'form-control margin-bottom', 'placeholder'=>'Enter account email')) }}
    
    {{ Form::submit('OK', array('class'=>'btn btn-lg btn-success margin-top'))}}
{{ Form::close() }}