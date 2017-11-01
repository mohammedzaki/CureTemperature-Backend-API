<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $device->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $device->name !!}</p>
</div>

<!-- Hospital Field -->
<div class="form-group">
    {!! Form::label('hospital', 'Hospital:') !!}
    <p>{!! $device->hospital !!}</p>
</div>

<!-- Place Field -->
<div class="form-group">
    {!! Form::label('place', 'Place:') !!}
    <p>{!! $device->place !!}</p>
</div>

<!-- Serial Number Field -->
<div class="form-group">
    {!! Form::label('serial_number', 'Serial Number:') !!}
    <p>{!! $device->serial_number !!}</p>
</div>

<!-- Device Category Id Field -->
<div class="form-group">
    {!! Form::label('device_category_id', 'Device Category Id:') !!}
    <p>{!! $device->device_category_id !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $device->deleted_at !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $device->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $device->updated_at !!}</p>
</div>

