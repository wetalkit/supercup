<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('address', 'What is your approximate location?') !!}
        {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'address']) !!}
        {!! Form::input('hidden', 'lat') !!}
        {!! Form::input('hidden', 'lng') !!}
        @foreach($errors->get('address') as $error)
        <p class="form-error">{{$error}}</p>
        @endforeach
    </div>
    <div class="form-group">
        {!! Form::label('no_people', 'How many guests can you accomodate?') !!}
        {!! Form::input('number', 'no_people', null, ['class' => 'form-control', 'min' => 1, 'max' => 2]) !!}
        @foreach($errors->get('no_people') as $error)
        <p class="form-error">{{$error}}</p>
        @endforeach
    </div>
    <div class="form-group">
        {!! Form::label('no_beds', 'How many beds are available?') !!}
        {!! Form::input('number', 'no_beds', null, ['class' => 'form-control', 'min' => 1, 'max' => 2]) !!}
        @foreach($errors->get('no_beds') as $error)
        <p class="form-error">{{$error}}</p>
        @endforeach
    </div>
    <div class="form-group">
        {!! Form::label('daterange', 'For which period are you offering your space?') !!}
        {!! Form::input('text', 'daterange', null, ['class' => 'form-control']) !!}
        @foreach($errors->get('daterange') as $error)
        <p class="form-error">{{$error}}</p>
        @endforeach
    </div>
    <div class="form-group">
        {!! Form::label('pictures', 'Upload Photo') !!}
        {!! Form::input('file', 'pictures[]', null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
        @foreach($errors->get('pictures') as $error)
        <p class="form-error">{{$error}}</p>
        @endforeach
        <div class="listing-images">
            @if(@$listing->pictures)
            @foreach($listing->pictures as $picture)
                <div class="img-wrap">
                    <div class="overlay"></div>
                    <a href="#" class="delete-img" data-image="{{$picture->id}}"><i class="glyphicon glyphicon-trash"></i></a>
                    <img src="{{route('storage', $picture->picture)}}" alt="Listing image">
                </div>
            @endforeach
            @endif
        </div>
        {!! Form::input('hidden', 'imgs_delete') !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        @foreach($errors->get('title') as $error)
        <p class="form-error">{{$error}}</p>
        @endforeach
    </div>
    <div class="form-group">
        {!! Form::label('description', 'Summary') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Brief overview of your place.', 'rows' => 8]) !!}
        @foreach($errors->get('description') as $error)
        <p class="form-error">{{$error}}</p>
        @endforeach
    </div>
    <div class="form-group">
        {!! Form::label('contact_email', 'Contact email') !!}
        {!! Form::input('email', 'contact_email', Auth::user()->email, ['class' => 'form-control']) !!}
        @foreach($errors->get('contact_email') as $error)
        <p class="form-error">{{$error}}</p>
        @endforeach
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        {!! Form::checkbox('terms_accepted', 1, @$listing->terms_accepted == '1', ['id' => 'terms_accepted']) !!}
        {!! Form::label('terms_accepted', 'I accept the terms and conditions') !!}
        @foreach($errors->get('terms_accepted') as $error)
        <p class="form-error">{{$error}}</p>
        @endforeach
    </div>
    <div class="form-group">
        <div class="text-center">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</div>
@section('additionalJs')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDn51pqaS1TiPFYgZAXBg-oetK6KQ6XnCY&libraries=places"></script>
<script>
    $(document).ready(function() {
        function initialize() {
            var options = {
                componentRestrictions: {country: "mk"}
            };
            var input = document.getElementById('address');
            var autocomplete = new google.maps.places.Autocomplete(input, options);
            var searchBox = new google.maps.places.SearchBox(input, options);
            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();
                $('input[name="lat"]').val(places[0].geometry.location.lat());
                $('input[name="lng"]').val(places[0].geometry.location.lng());
            });
        }  
        initialize();  
        $('.delete-img').click(function(e) {
            e.preventDefault();
            $('input[name="imgs_delete"]').val($('input[name="imgs_delete"]').val()+$(this).data('image')+',')
            $(this).parent().remove();
        });
        $('.close-listing').click(function(e) {
            e.preventDefault();
            $('#delete-modal form').attr('action', $(this).data('href'));
            $('#delete-modal').modal('show');
        });
        $('.mark-booked').click(function(e) {
            e.preventDefault();
            $('#book-modal form').attr('action', $(this).data('href'));
            $('#book-modal').modal('show');
        });
    });
</script>
@endsection
