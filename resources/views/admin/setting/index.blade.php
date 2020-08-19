@extends('layouts.admin_app')

@section('content')
<div class="container">
    <div class="row mb-40">
        <div class="col-md-6 margin-tb">
            <h2>{{ __('Settings') }}</h2>
        </div>
        <div class="col-md-6">
            <div class="text-right">
                <div class="dropdown" style="display:inline-block;">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('Bulk Functions') }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        <a class="dropdown-item" href="javascript:void(0);" id="delete_chosen" data-removeelementsname="settings" data-removeelementsurl="{{route('settings.bulk_remove')}}">{{ __('Delete Settings') }}</a>
                        <a class="dropdown-item" href="#" id="connect_chosen" data-connecturl="">{{ __('Connect Settings') }}</a>

                    </div>
                </div>

                <a class="btn btn-success" href="{{ route('settings.create') }}" data-toggle="modal" data-target="#universalModal" data-route="{{ route('settings.create') }}" data-action="create" data-title="{{ __('Create Setting') }}" data-elemid="" data-method="GET" data-submitroute="{{route('settings.store')}}">{{ __('Create Setting') }}</a>
            </div>
        </div>
    </div>

  @if (!empty($settings))
    <div class="rows-list">
        <div class="row row-head">
            <div class="col-md-1"><strong>{{ __('No') }}</strong></div>
            <div class="col-md-3"><strong>{{ __('Name') }}</strong></div>
            <div class="col-md-3"><strong>{{ __('Description') }}</strong></div>
            <div class="col-md-2"><strong>{{ __('Value') }}</strong></div>
            <div class="col-md-1"><input type="checkbox" id="bulk_all"/>&nbsp;&nbsp;<strong>{{ __('Bulk') }}</strong></div>
            <div class="col-md-2 text-center"><strong>{{ __('Actions') }}</strong></div>
        </div>
        @foreach ($settings as $setting)

            <div class="row r-actions mt-20">
                <div class="col-md-1"><strong>#{{ $setting->id }}</strong></div>
                <div class="col-md-3">{{ $setting->name }}</div>
                <div class="col-md-2">{{ \Illuminate\Support\Str::limit($setting->description, 100, '...') }}</div>
                <div class="col-md-3">{{ $setting->value }}</div>
                <div class="col-md-1"><input class="bulk_check" type="checkbox" name="bulk[{{$setting->id}}]" id="bulk_{{$setting->id}}" value="1"/></div>
                <div class="col-md-2 m-actions text-center">

                    <form action="{{ route('settings.destroy',$setting->id) }}" method="POST" class="sbmt-delete-form">

                        <a class="btn prevent-default-link show-elem" href="{{ route('settings.show',$setting->id) }}" data-toggle="modal" data-target="#universalModal" data-route="{{route('settings.show',$setting->id)}}" data-action="show" data-title="{{ __('Setting') }} {{ $setting->name }}" data-elemid="{{$setting->id}}" >
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>

                        <a class="btn prevent-default-link edit-elem" href="{{ route('settings.edit',$setting->id) }}" data-toggle="modal" data-target="#universalModal" data-route="{{route('settings.edit',$setting->id)}}" data-action="edit" data-title="{{ __('Edit Setting') }} {{ $setting->name }}" data-elemid="{{$setting->id}}" data-method="GET" data-submitroute="{{route('settings.store')}}">
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
        {{ __('No Settings Yet') }}
  @endif
</div>

@include('universal_modal')

@endsection
