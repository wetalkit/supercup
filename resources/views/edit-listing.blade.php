@extends('layouts.app')

@section('content')
<div class="container">
    <div class="wrapper listingform">
        <div class="row">
            <div class="col-md-12">
                @if($errors->get('booker_id'))
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->get('booker_id') as $error)
                    <p>{{$error}}</p>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <h1>{{$listing->title}}</h1>
            </div>
            <div class="col-md-3" style="text-align:right">
                @if($listing->status)
                <span class="label label-success">Booked</span>
                @else
                <a href="#" data-href="{{route('listing.destroy', $listing->id)}}" class="close-listing"><i class="glyphicon glyphicon-trash"></i></a>
                <a href="#" data-href="{{route('listing.book', $listing->id)}}" class="btn btn-default mark-booked">Mark as booked</a>
                @endif
            </div>
        </div>
        <div class="row">
            {!! Form::model($listing, ['method' => 'PUT', 'route' => ['listing.update', $listing->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
            @include('_listing-form')
            {!!Form::close()!!}
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="delete-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Are you sure you want to remove your listing?</h4>
      </div>
      {{Form::open()}}
      <input type="hidden" name="_method" value="DELETE"/>
      <div class="modal-body">
        <p>This action can not be undone.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        {!! Form::submit('Confirm', ['class' => 'btn btn-primary']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="book-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Mark listing booked</h4>
      </div>
      {{Form::open()}}
      <div class="modal-body">
        <div class="form-group">
            {!! Form::label('booker_id', 'Who booked your listing?') !!}
            {!! Form::select('booker_id', $bookers, null, ['class' => 'form-control']) !!}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        {!! Form::submit('Confirm', ['class' => 'btn btn-primary']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection