
{{ Form::model($user, array('route'=>array('get-signup'), 'class'=>'form-signup')) }}
<h2 class="form-signup-heading inp">Signup <small>Create your app, its free</small></h2>
 
    @include('layout.fragments.error', ['errors' => $errors])
    <div>
        {{ Form::text('first_name', null, array('class'=>'form-control margin-bottom', 'placeholder'=>'First Name')) }}
    </div>
    
    <div>
        {{ Form::text('last_name', null, array('class'=>'form-control margin-bottom', 'placeholder'=>'Last Name')) }}
    </div>
    
    <p>
        Please ensure email is correct
        <small class='label label-info'>a confirmation email will be sent.</small>
    </p>
    <div>
        {{ Form::text('email', null, array('class'=>'form-control margin-bottom', 'placeholder'=>'Email Address')) }}
    </div>
    <div>
        {{ Form::password('password', array('class'=>'form-control margin-bottom', 'placeholder'=>'Password')) }}
    </div>
    
    <div>
        {{ Form::password('password_confirmation', array('class'=>'form-control margin-bottom', 'placeholder'=>'Confirm Password')) }}
    </div>
    
    

    
    <hr/>
    {{ Form::submit('Signup', array('class'=>'btn btn-lg btn-success margin-top'))}}
    
{{ Form::close() }}