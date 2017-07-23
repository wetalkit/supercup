@extends('layouts.app')

@section('content')
<div class="container">
    <div class="wrapper listingform">
        <div class="row heading">
            <div class="col-md-9">
                <h1>{{$listing->title}}</h1>
            </div>
            <div class="col-md-3" style="text-align:right">
                @if($listing->status)
                <span class="label label-success booked">Booked</span>
                @else
                <a href="#" data-href="{{route('listing.book', $listing->id)}}" class="btn btn-orange btn-orange-inverse mark-booked">Mark as booked</a>
                <a href="#" data-href="{{route('listing.destroy', $listing->id)}}" title="Remove listing" class="btn close-listing"><i class="glyphicon glyphicon-trash"></i></a>
                @endif
            </div>
        </div>
        <div class="row status-row">
            <div class="col-md-12">
                @if($errors->get('booker_id'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('booker_id') as $error)
                    <p>{{$error}}</p>
                    @endforeach
                </div>
                @endif
                @if(session('success'))
                <div class="alert alert-success" role="alert">
                  {{session('success')}}
                </div>
                @endif
            </div>
        </div>
        {!! Form::model($listing, ['method' => 'PUT', 'route' => ['listing.update', $listing->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
        @include('_listing-form')
        {!!Form::close()!!}
    </div>
</div>
@include('modals/listing-modals')
@endsection