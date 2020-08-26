@extends('layouts.admin_app')

@section('content')
<div class="container">
    <div class="row mb-40">
        <div class="col-md-6 margin-tb">
            <h2>{{ __('Lectures') }}</h2>
        </div>
        <div class="col-md-6">
            <div class="text-right">
                <div class="dropdown" style="display:inline-block;">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('Bulk Functions') }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        <a class="dropdown-item" href="javascript:void(0);" id="delete_chosen" data-removeelementsname="lectures" data-removeelementsurl="{{route('lectures.bulk_remove')}}">{{ __('Delete Lectures') }}</a>
                        <a class="dropdown-item" href="#" id="connect_chosen" data-connecturl="">{{ __('Connect Lectures') }}</a>

                    </div>
                </div>

                <a class="btn btn-success" href="{{ route('lectures.create') }}" data-toggle="modal" data-target="#universalModal" data-route="{{ route('lectures.create') }}" data-action="create" data-title="{{ __('Create Lecture') }}" data-elemid="" data-method="GET" data-submitroute="{{route('lectures.store')}}">{{ __('Create Lecture') }}</a>
            </div>
        </div>
    </div>

  @if (!empty($lectures))
    <div class="rows-list">
        <div class="row row-head">
            <div class="col-md-1"><strong>{{ __('No') }}</strong></div>
            <div class="col-md-3"><strong>{{ __('Name') }}</strong></div>
            <div class="col-md-3"><strong>{{ __('Description') }}</strong></div>
            <div class="col-md-2"><strong>{{ __('Duration') }}</strong></div>
            <div class="col-md-1"><input type="checkbox" id="bulk_all"/>&nbsp;&nbsp;<strong>{{ __('Bulk') }}</strong></div>
            <div class="col-md-2 text-center"><strong>{{ __('Actions') }}</strong></div>
        </div>
        @foreach ($lectures as $lecture)

            <div class="row r-actions mt-20">
                <div class="col-md-1"><strong>#{{ $lecture->id }}</strong></div>
                <div class="col-md-3">{{ $lecture->name }}</div>
                <div class="col-md-2">{{ \Illuminate\Support\Str::limit($lecture->description, 100, '...') }}</div>
                <div class="col-md-3 text-center">{{ $lecture->duration }}</div>
                <div class="col-md-1"><input class="bulk_check" type="checkbox" name="bulk[{{$lecture->id}}]" id="bulk_{{$lecture->id}}" value="1"/></div>
                <div class="col-md-2 m-actions text-center">

                    <form action="{{ route('lectures.destroy',$lecture->id) }}" method="POST" class="sbmt-delete-form">

                        <a class="btn prevent-default-link show-elem" href="{{ route('lectures.show',$lecture->id) }}" data-toggle="modal" data-target="#universalModal" data-route="{{route('lectures.show',$lecture->id)}}" data-action="show" data-title="{{ __('Lecture') }} {{ $lecture->name }}" data-elemid="{{$lecture->id}}" >
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>

                        <a class="btn prevent-default-link edit-elem" href="{{ route('lectures.edit',$lecture->id) }}" data-toggle="modal" data-target="#universalModal" data-route="{{route('lectures.edit',$lecture->id)}}" data-action="edit" data-title="{{ __('Edit Lecture') }} {{ $lecture->name }}" data-elemid="{{$lecture->id}}" data-method="GET" data-submitroute="{{route('lectures.store')}}">
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
        {{ __('No Lectures Yet') }}
  @endif
</div>

@include('universal_modal')

@endsection
