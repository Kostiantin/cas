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

                        <a class="dropdown-item" href="javascript:void(0);" id="delete_chosen" data-removeelementsname="modules" data-removeelementsurl="{{route('modules.bulk_remove')}}">Delete Modules</a>
                        <a class="dropdown-item" href="#" id="connect_chosen" data-connecturl="">Connect Modules</a>

                    </div>
                </div>

                <a class="btn btn-success" href="{{ route('modules.create') }}" data-toggle="modal" data-target="#universalModal" data-route="{{ route('modules.create') }}" data-action="create" data-title="Create Module" data-elemid="" data-method="GET" data-submitroute="{{route('modules.store')}}"> Create Module</a>
            </div>
        </div>
    </div>

  @if (!empty($modules))
    <div class="rows-list">
        <div class="row row-head">
            <div class="col-md-1"><strong>No</strong></div>
            <div class="col-md-3"><strong>Name</strong></div>
            <div class="col-md-2"><strong>Code</strong></div>
            <div class="col-md-3"><strong>Description</strong></div>
            <div class="col-md-1"><input type="checkbox" id="bulk_all"/>&nbsp;&nbsp;<strong>Bulk</strong></div>
            <div class="col-md-2 text-center"><strong>Actions</strong></div>
        </div>
        @foreach ($modules as $module)

            <div class="row r-actions mt-20">
                <div class="col-md-1"><strong>#{{ $module->id }}</strong></div>
                <div class="col-md-3">{{ $module->name }}</div>
                <div class="col-md-2">{{ $module->code }}</div>
                <div class="col-md-3">{{ \Illuminate\Support\Str::limit($module->description, 100, '...') }}</div>
                <div class="col-md-1"><input class="bulk_check" type="checkbox" name="bulk[{{$module->id}}]" id="bulk_{{$module->id}}" value="1"/></div>
                <div class="col-md-2 m-actions text-center">

                    <form action="{{ route('modules.destroy',$module->id) }}" method="POST" class="sbmt-delete-form">

                        <a class="btn prevent-default-link show-elem" href="{{ route('modules.show',$module->id) }}" data-toggle="modal" data-target="#universalModal" data-route="{{route('modules.show',$module->id)}}" data-action="show" data-title="Module {{ $module->name }}" data-elemid="{{$module->id}}" >
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>

                        <a class="btn prevent-default-link edit-elem" href="{{ route('modules.edit',$module->id) }}" data-toggle="modal" data-target="#universalModal" data-route="{{route('modules.edit',$module->id)}}" data-action="edit" data-title="Edit Module {{ $module->name }}" data-elemid="{{$module->id}}" data-method="GET" data-submitroute="{{route('modules.store')}}">
                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn "><i class="fa fa-times" aria-hidden="true"></i></button>

                    </form>

                </div>
            </div>

        @endforeach
    </div>
  @else
    No Modules Yet
  @endif
</div>

@include('universal_modal')

@endsection
