<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $deviceFeeds->id !!}</p>
</div>

<!-- Humidity Field -->
<div class="form-group">
    {!! Form::label('humidity', 'Humidity:') !!}
    <p>{!! $deviceFeeds->humidity !!}</p>
</div>

<!-- Temperature Field -->
<div class="form-group">
    {!! Form::label('temperature', 'Temperature:') !!}
    <p>{!! $deviceFeeds->temperature !!}</p>
</div>

<!-- Device Id Field -->
<div class="form-group">
    {!! Form::label('device_id', 'Device Id:') !!}
    <p>{!! $deviceFeeds->device_id !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $deviceFeeds->deleted_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $deviceFeeds->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $deviceFeeds->updated_at !!}</p>
</div>

