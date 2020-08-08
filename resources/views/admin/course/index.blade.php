@extends('layouts.admin_app')

@section('content')
<div class="container">
    <div class="row mb-40">
        <div class="col-md-6 margin-tb">
            <h2>Courses</h2>
        </div>
        <div class="col-md-6">
            <div class="text-right">
                <div class="dropdown" style="display:inline-block;">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Bulk Functions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        <a class="dropdown-item" href="javascript:void(0);" id="delete_chosen" data-removeelementsname="courses" data-removeelementsurl="{{route('courses.bulk_remove')}}">Delete Courses</a>
                        <a class="dropdown-item" href="#" id="connect_chosen" data-connecturl="">Connect Courses</a>

                    </div>
                </div>

                <a class="btn btn-success" href="{{ route('courses.create') }}" data-toggle="modal" data-target="#universalModal" data-route="{{ route('courses.create') }}" data-action="create" data-title="Create Course" data-elemid="" data-method="GET" data-submitroute="{{route('courses.store')}}"> Create Course</a>
            </div>
        </div>
    </div>

  @if (!empty($courses))
    <div class="rows-list">
        <div class="row row-head">
            <div class="col-md-1"><strong>No</strong></div>
            <div class="col-md-4"><strong>Title</strong></div>
            <div class="col-md-4"><strong>Description</strong></div>
            <div class="col-md-1"><input type="checkbox" id="bulk_all"/>&nbsp;&nbsp;<strong>Bulk</strong></div>
            <div class="col-md-2 text-center"><strong>Actions</strong></div>
        </div>
        @foreach ($courses as $course)

            <div class="row r-actions mt-20">
                <div class="col-md-1"><strong>#{{ $course->id }}</strong></div>
                <div class="col-md-4">{{ $course->title }}</div>
                <div class="col-md-4">{{ \Illuminate\Support\Str::limit($course->description, 100, '...') }}</div>
                <div class="col-md-1"><input class="bulk_check" type="checkbox" name="bulk[{{$course->id}}]" id="bulk_{{$course->id}}" value="1"/></div>
                <div class="col-md-2 m-actions text-center">

                    <form action="{{ route('courses.destroy',$course->id) }}" method="POST" class="sbmt-delete-form">

                        <a class="btn prevent-default-link show-elem" href="{{ route('courses.show',$course->id) }}" data-toggle="modal" data-target="#universalModal" data-route="{{route('courses.show',$course->id)}}" data-action="show" data-title="Course {{ $course->title }}" data-elemid="{{$course->id}}" >
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>

                        <a class="btn prevent-default-link edit-elem" href="{{ route('courses.edit',$course->id) }}" data-toggle="modal" data-target="#universalModal" data-route="{{route('courses.edit',$course->id)}}" data-action="edit" data-title="Edit Course {{ $course->title }}" data-elemid="{{$course->id}}" data-method="GET" data-submitroute="{{route('courses.store')}}">
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
    No Courses Yet
  @endif
</div>

@include('universal_modal')

@endsection
