@extends('layouts.admin_app')

@section('content')
<div class="container">
    <div class="row mb-40">
        <div class="col-md-6 margin-tb">
            <h2>Modules</h2>
        </div>
        <div class="col-md-6">
            <div class="text-right">
                <div class="dropdown" style="display:inline-block;">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Bulk Functions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>

                <a class="btn btn-success" href="{{ route('module.create') }}"> Create Module</a>
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
            <div class="col-md-1"><strong>No</strong></div>
            <div class="col-md-3"><strong>Name</strong></div>
            <div class="col-md-2"><strong>Code</strong></div>
            <div class="col-md-3"><strong>Description</strong></div>
            <div class="col-md-1"><strong>Bulk</strong></div>
            <div class="col-md-2 text-center"><strong>Actions</strong></div>
        </div>
        @foreach ($modules as $module)

            <div class="row r-actions mt-20">
                <div class="col-md-1">#{{ $module->id }}</div>
                <div class="col-md-3">{{ $module->name }}</div>
                <div class="col-md-2">{{ $module->code }}</div>
                <div class="col-md-3">{{ $module->description }}</div>
                <div class="col-md-1"><input type="checkbox" name="bulk[{{$module->id}}]" id="bulk_{{$module->id}}" value="1"/></div>
                <div class="col-md-2 m-actions text-center">

                    <form action="{{ route('module.destroy',$module->id) }}" method="POST" class="sbmt-delete-form">

                        <a class="btn btn-info" href="{{ route('module.show',$module->id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a>

                        <a class="btn btn-primary" href="{{ route('module.edit',$module->id) }}"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i></button>
                    </form>

                </div>
            </div>

        @endforeach
    </div>
</div>
@endsection
