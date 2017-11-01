<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $deviceCategory->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $deviceCategory->name !!}</p>
</div>

<!-- Min Temperature Field -->
<div class="form-group">
    {!! Form::label('min_temperature', 'Min Temperature:') !!}
    <p>{!! $deviceCategory->min_temperature !!}</p>
</div>

<!-- Max Temperature Field -->
<div class="form-group">
    {!! Form::label('max_temperature', 'Max Temperature:') !!}
    <p>{!! $deviceCategory->max_temperature !!}</p>
</div>

<!-- Alarm Times Field -->
<div class="form-group">
    {!! Form::label('alarm_times', 'Alarm Times:') !!}
    <p>{!! $deviceCategory->alarm_times !!}</p>
</div>

<!-- Alarm Frequency Field -->
<div class="form-group">
    {!! Form::label('alarm_frequency', 'Alarm Frequency:') !!}
    <p>{!! $deviceCategory->alarm_frequency !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $deviceCategory->deleted_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $deviceCategory->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $deviceCategory->updated_at !!}</p>
</div>

