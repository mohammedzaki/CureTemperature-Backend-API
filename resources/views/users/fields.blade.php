<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- User Account -->
<div class="form-group col-sm-6">
    {!! Form::label('account_id', 'User Account:') !!}
    {{ Form::select('account_id', $accounts, null, ['class' => 'form-control', 'placeholder' => 'select user account']) }}
</div>

<!-- User Role -->
<div class="form-group col-sm-6">
    {!! Form::label('role', 'User Role:') !!}
    {{ Form::select('role', $roles, null, ['class' => 'form-control', 'placeholder' => 'select user role']) }}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
</div>
