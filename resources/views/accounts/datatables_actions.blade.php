{!! Form::open(['route' => ['accounts.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a  class='btn btn-default btn-xs users-details-control'>
        users
    </a>
    <a  class='btn btn-default btn-xs devices-details-control'>
        devices
    </a>
    <a href="{{ route('accounts.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    <a href="{{ route('accounts.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('Are you sure?')"
    ]) !!}
</div>
{!! Form::close() !!}
