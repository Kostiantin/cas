@extends('layouts.admin_app')

@section('content')
<div class="container">
    <div class="row mb-40">
        <div class="col-md-6 margin-tb">
            <h2>{{ __('Modules Days') }}</h2>
        </div>
        <div class="col-md-6">
            <div class="text-right">
                <div class="dropdown" style="display:inline-block;">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('Bulk Functions') }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        <a class="dropdown-item" href="javascript:void(0);" id="delete_chosen" data-removeelementsname="days" data-removeelementsurl="{{route('days.bulk_remove')}}">{{ __('Delete Days') }}</a>
                        <a class="dropdown-item" href="#" id="connect_chosen" data-connecturl="">{{ __('Connect Days') }}</a>

                    </div>
                </div>

                <a class="btn btn-success" href="{{ route('days.create') }}" data-toggle="modal" data-target="#universalModal" data-route="{{ route('days.create') }}" data-action="create" data-title="{{ __('Create Day') }}" data-elemid="" data-method="GET" data-submitroute="{{route('days.store')}}">{{ __('Create Day') }}</a>
            </div>
        </div>
    </div>

  @if (!empty($days))
    <div class="rows-list">
        <div class="row row-head">
            <div class="col-md-1"><strong>{{ __('No') }}</strong></div>
            <div class="col-md-3"><strong>{{ __('Day Topic') }}</strong></div>
            <div class="col-md-3"><strong>{{ __('Connections') }}</strong></div>
            <div class="col-md-1"><input type="checkbox" id="bulk_all"/>&nbsp;&nbsp;<strong>{{ __('Bulk') }}</strong></div>
            <div class="col-md-2 text-center"><strong>{{ __('Actions') }}</strong></div>
        </div>
        @foreach ($days as $day)

            <div class="row r-actions mt-20">
                <div class="col-md-1"><strong>#{{ $day->id }}</strong></div>
                <div class="col-md-3">{{ $day->name }}</div>
                <div class="col-md-3"></div>
                <div class="col-md-1"><input class="bulk_check" type="checkbox" name="bulk[{{$day->id}}]" id="bulk_{{$day->id}}" value="1"/></div>
                <div class="col-md-2 m-actions text-center">

                    <form action="{{ route('days.destroy',$day->id) }}" method="POST" class="sbmt-delete-form">

                        <a class="btn prevent-default-link show-elem" href="{{ route('days.show',$day->id) }}" data-toggle="modal" data-target="#universalModal" data-route="{{route('days.show',$day->id)}}" data-action="show" data-title="{{ __('Day') }} {{ $day->name }}" data-elemid="{{$day->id}}" >
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>

                        <a class="btn prevent-default-link edit-elem" href="{{ route('days.edit',$day->id) }}" data-toggle="modal" data-target="#universalModal" data-route="{{route('days.edit',$day->id)}}" data-action="edit" data-title="{{ __('Edit Day') }} {{ $day->name }}" data-elemid="{{$day->id}}" data-method="GET" data-submitroute="{{route('days.store')}}">
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
        {{ __('No Days Yet') }}
  @endif
</div>

@include('universal_modal')

@endsection
