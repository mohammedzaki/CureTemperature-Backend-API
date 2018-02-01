<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'Select User:') !!}
    {{ Form::select('user_id', $users, null, ['class' => 'form-control', 'placeholder' => 'select user']) }}
</div>

<!-- Device Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('device_id', 'Select Device:') !!}
    {{ Form::select('device_id', $devices, null, ['class' => 'form-control', 'placeholder' => 'select device']) }}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('userDevices.index') !!}" class="btn btn-default">Cancel</a>
</div>
