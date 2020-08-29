@extends('layouts.admin_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    <p>Here will be the admin statistics about modules, lectures, courses etc,.</p>
                    <p>Please go to <a href="{{route('connections.index')}}">Connections</a> page.</p>
                   {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.who')

                    @endcomponent--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
