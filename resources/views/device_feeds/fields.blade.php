<!-- Humidity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('humidity', 'Humidity:') !!}
    {!! Form::number('humidity', null, ['class' => 'form-control']) !!}
</div>

<!-- Temperature Field -->
<div class="form-group col-sm-6">
    {!! Form::label('temperature', 'Temperature:') !!}
    {!! Form::number('temperature', null, ['class' => 'form-control']) !!}
</div>

<!-- Device Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('device_id', 'Device Id:') !!}
    {!! Form::number('device_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('deviceFeeds.index') !!}" class="btn btn-default">Cancel</a>
</div>
