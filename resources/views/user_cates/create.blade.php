@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Cate
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'userCates.store']) !!}

                        @include('user_cates.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection