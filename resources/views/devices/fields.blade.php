<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Serial Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('serial_number', 'Serial Number:') !!}
    {!! Form::text('serial_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Device Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('device_category_id', 'Device Category Id:') !!}
    {{ Form::select('device_category_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'select device category']) }}
</div>

<!-- User Account -->
<div class="form-group col-sm-6">
    {!! Form::label('account_id', 'User Account:') !!}
    {{ Form::select('account_id', $accounts, null, ['class' => 'form-control', 'placeholder' => 'select user account']) }}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('devices.index') !!}" class="btn btn-default">Cancel</a>
</div>
