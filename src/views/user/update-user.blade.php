
{{ Form::model($user, array('route'=>array('post-user-update'), 'class'=>'form-signup')) }}
<h2 class="form-signup-heading inp">Update account </h2>
 
    @include('layout.fragments.error', ['errors' => $errors])
    <div>
        {{ Form::text('first_name', null, array('class'=>'form-control margin-bottom', 'placeholder'=>'First Name')) }}
    </div>
    
    <div>
        {{ Form::text('last_name', null, array('class'=>'form-control margin-bottom', 'placeholder'=>'Last Name')) }}
    </div>
    
    <hr/>
    {{ Form::submit('Update', array('class'=>'btn btn-lg btn-success margin-top'))}}
    
{{ Form::close() }}