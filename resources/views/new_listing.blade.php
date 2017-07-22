@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">New listing</div>

                <div class="panel-body">
                    {!! Form::open(['route' => ['listing.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                    @if($errors->any())
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="alert alert-danger" role="alert">
                              @foreach($errors->all() as $error)
                              <p>{{$error}}</p>
                              @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        {!! Form::label('title', 'Title', ['class' => 'col-sm-3']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description', ['class' => 'col-sm-3']) !!}
                        <div class="col-sm-6">
                            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('address', 'Address', ['class' => 'col-sm-3']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'address']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('pictures', 'Pictures', ['class' => 'col-sm-3']) !!}
                        <div class="col-sm-6">
                            {!! Form::input('file', 'pictures[]', null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('no_people', 'No of people', ['class' => 'col-sm-3']) !!}
                        <div class="col-sm-6">
                            {!! Form::input('number', 'no_people', null, ['class' => 'form-control', 'min' => 1, 'max' => 2]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('no_beds', 'No of beds', ['class' => 'col-sm-3']) !!}
                        <div class="col-sm-6">
                            {!! Form::input('number', 'no_beds', null, ['class' => 'form-control', 'min' => 1, 'max' => 2]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('date_from', 'From', ['class' => 'col-sm-3']) !!}
                        <div class="col-sm-6">
                            {!! Form::input('date', 'date_from', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('date_to', 'To', ['class' => 'col-sm-3']) !!}
                        <div class="col-sm-6">
                            {!! Form::input('date', 'date_to', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('contact_email', 'Contact email', ['class' => 'col-sm-3']) !!}
                        <div class="col-sm-6">
                            {!! Form::input('email', 'contact_email', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('motiv', 'Why do you want to do this?', ['class' => 'col-sm-3']) !!}
                        <div class="col-sm-6">
                            {!! Form::textarea('motiv', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('terms_accepted', 'Terms and conditions', ['class' => 'col-sm-3']) !!}
                        <div class="col-sm-6">
                            {!! Form::input('checkbox', 'terms_accepted', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('additionalJs')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDn51pqaS1TiPFYgZAXBg-oetK6KQ6XnCY&libraries=places"></script>
<script>
    function initialize() {
        var options = {
            componentRestrictions: {country: "mk"}
        };

        var input = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(input, options);
    }    
    initialize();  
    $('#address').change(function() {
        console.log($(this).val());
        $.ajax({
            url: "https://maps.googleapis.com/maps/api/geocode/json?address="+$(this).val()+"&key=AIzaSyDn51pqaS1TiPFYgZAXBg-oetK6KQ6XnCY"
        }).done(function(msg) {
            console.log(msg.results[0]);
        });
    });
</script>
@endsection
