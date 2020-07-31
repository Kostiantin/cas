@extends('layouts.admin_app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modules</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('module.create') }}"> Create New Module</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="module-list">
        <div class="row">
            <div class="col-md-1">No</div>
            <div class="col-md-3">Name</div>
            <div class="col-md-2">Code</div>
            <div class="col-md-4">Description</div>
            <div class="col-md-2">Actions</div>
        </div>
        @foreach ($modules as $module)

            <div class="row">
                <div class="col-md-1">{{ $module->id }}</div>
                <div class="col-md-3">{{ $module->name }}</div>
                <div class="col-md-2">{{ $module->code }}</div>
                <div class="col-md-4">{{ $module->description }}</div>
                <div class="col-md-2">

                    <form action="{{ route('module.destroy',$module->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('module.show',$module->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('module.edit',$module->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>

                </div>
            </div>

        @endforeach
    </div>
</div>
@endsection
