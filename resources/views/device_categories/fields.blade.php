<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Min Temperature Field -->
<div class="form-group col-sm-6">
    {!! Form::label('min_temperature', 'Min Temperature:') !!}
    {!! Form::number('min_temperature', null, ['class' => 'form-control', 'step' => '0.01']) !!}
</div>

<!-- Max Temperature Field -->
<div class="form-group col-sm-6">
    {!! Form::label('max_temperature', 'Max Temperature:') !!}
    {!! Form::number('max_temperature', null, ['class' => 'form-control', 'step' => '0.01']) !!}
</div>

{{-- <!-- Alarm Times Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alarm_times', 'Alarm Times:') !!}
    {!! Form::number('alarm_times', null, ['class' => 'form-control']) !!}
</div>

<!-- Alarm Frequency Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alarm_frequency', 'Alarm Frequency:') !!}
    {!! Form::number('alarm_frequency', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('deviceCategories.index') !!}" class="btn btn-default">Cancel</a>
</div>
