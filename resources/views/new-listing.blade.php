@extends('layouts.app')

@section('content')
<div class="container">
    <div class="wrapper listingform">
        <h1>Hi, {{Auth::user()->name}}! Let's get started listing your space.</h1>
        <div class="row">
            {!! Form::open(['route' => ['listing.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
            @include('_listing-form')
            {!!Form::close()!!}
        </div>
    </div>
</div>
@endsection