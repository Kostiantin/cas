@extends('layouts.admin_app')

@section('content')
<div class="container">
    <div class="row mb-40">
        <div class="col-md-6 margin-tb">
            <h2>Certificates</h2>
        </div>
        <div class="col-md-6">
            <div class="text-right">
                <div class="dropdown" style="display:inline-block;">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Bulk Functions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        <a class="dropdown-item" href="javascript:void(0);" id="delete_chosen" data-removeelementsname="certificates" data-removeelementsurl="{{route('certificates.bulk_remove')}}">Delete Certificates</a>
                        <a class="dropdown-item" href="#" id="connect_chosen" data-connecturl="">Connect Certificates</a>

                    </div>
                </div>

                <a class="btn btn-success" href="{{ route('certificates.create') }}" data-toggle="modal" data-target="#universalModal" data-route="{{ route('certificates.create') }}" data-action="create" data-title="Create Certificate" data-elemid="" data-method="GET" data-submitroute="{{route('certificates.store')}}"> Create Certificate</a>
            </div>
        </div>
    </div>

  @if (!empty($certificates))
    <div class="rows-list">
        <div class="row row-head">
            <div class="col-md-1"><strong>No</strong></div>
            <div class="col-md-2"><strong>Title</strong></div>
            <div class="col-md-3"><strong>Sub-Title</strong></div>
            <div class="col-md-3"><strong>Description</strong></div>
            <div class="col-md-1"><input type="checkbox" id="bulk_all"/>&nbsp;&nbsp;<strong>Bulk</strong></div>
            <div class="col-md-2 text-center"><strong>Actions</strong></div>
        </div>
        @foreach ($certificates as $certificate)

            <div class="row r-actions mt-20">
                <div class="col-md-1"><strong>#{{ $certificate->id }}</strong></div>
                <div class="col-md-2">{{ $certificate->title }}</div>
                <div class="col-md-3">{{ \Illuminate\Support\Str::limit($certificate->sub_title, 100, '...') }}</div>
                <div class="col-md-3">{{ \Illuminate\Support\Str::limit($certificate->description, 100, '...') }}</div>
                <div class="col-md-1"><input class="bulk_check" type="checkbox" name="bulk[{{$certificate->id}}]" id="bulk_{{$certificate->id}}" value="1"/></div>
                <div class="col-md-2 m-actions text-center">

                    <form action="{{ route('certificates.destroy',$certificate->id) }}" method="POST" class="sbmt-delete-form">

                        <a class="btn prevent-default-link show-elem" href="{{ route('certificates.show',$certificate->id) }}" data-toggle="modal" data-target="#universalModal" data-route="{{route('certificates.show',$certificate->id)}}" data-action="show" data-title="Certificate {{ $certificate->title }}" data-elemid="{{$certificate->id}}" >
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>

                        <a class="btn prevent-default-link edit-elem" href="{{ route('certificates.edit',$certificate->id) }}" data-toggle="modal" data-target="#universalModal" data-route="{{route('certificates.edit',$certificate->id)}}" data-action="edit" data-title="Edit Certificate {{ $certificate->title }}" data-elemid="{{$certificate->id}}" data-method="GET" data-submitroute="{{route('certificates.store')}}">
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
    No Certificates Yet
  @endif
</div>

@include('universal_modal')

@endsection
