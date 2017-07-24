<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'How do you want your listing to appear in search?', 'required' => true]) !!}
            @foreach($errors->get('title') as $error)
            <p class="form-error">{{$error}}</p>
            @endforeach
        </div>
        <div class="form-group">
            {!! Form::label('description', 'Summary') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Brief overview of your place.', 'rows' => 8, 'required' => true]) !!}
            @foreach($errors->get('description') as $error)
            <p class="form-error">{{$error}}</p>
            @endforeach
        </div>
        <div class="form-group">
            {!! Form::label('pictures', 'Upload Photo') !!}
            {!! Form::input('file', 'pictures[]', null, ['class' => 'form-control', 'multiple' => true, 'required' => @$listing->id ? false : true]) !!}
            <p class="small">You can upload multiple photos at once, just hold your ctrl/cmd key while selecting.</p>
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
            {!! Form::label('address', 'What is your approximate location?') !!}
            {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'address', 'required' => true]) !!}
            {!! Form::input('hidden', 'lat') !!}
            {!! Form::input('hidden', 'lng') !!}
            @foreach($errors->get('address') as $error)
            <p class="form-error">{{$error}}</p>
            @endforeach
            @foreach($errors->get('lat') as $error)
            <p class="form-error">{{$error}}</p>
            @endforeach
        </div>
        <div class="form-group">
            {!! Form::label('daterange', 'For which period are you offering your space?') !!}
            {!! Form::input('text', 'daterange', null, ['class' => 'form-control', 'required' => true, 'date-from'=>@$listing->dateFromFormatted, 'date-to' => @$listing->dateToFormatted]) !!}
            @foreach($errors->get('daterange') as $error)
            <p class="form-error">{{$error}}</p>
            @endforeach
        </div>
        <div class="form-group dropdown-holder transparent">
            <div>
                {!! Form::label('no_people', 'How many guests can you accomodate?') !!}
            </div>
            <div class="col-sm-3">
                <p>Guests<br/>
                    <span class="small">Max 2 guests</span>
                </p>
            </div>
            <div class="col-sm-2">
            {!! Form::select('no_people', [1 => 1, 2 => 2], null, ['class' => 'selectpicker', 'required' => true]) !!}
            </div>
            @foreach($errors->get('no_people') as $error)
            <p class="form-error">{{$error}}</p>
            @endforeach
        </div>
        <div class="form-group dropdown-holder transparent">
            <div>
                {!! Form::label('no_beds', 'How many beds are available?') !!}
            </div>
            <div class="col-sm-3">
                <p>Beds<br/>
                    <span class="small">Max 2 guests</span>
                </p>
            </div>
            <div class="col-sm-2">
            {!! Form::select('no_beds', [1 => 1, 2 => 2], null, ['class' => 'selectpicker', 'required' => true]) !!}
            </div>
            @foreach($errors->get('no_beds') as $error)
            <p class="form-error">{{$error}}</p>
            @endforeach
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('contact_email', 'Contact email') !!}
            <p class="small">Please change this with your prefered email address for contact.</p>
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
                {!! Form::submit('Submit', ['class' => 'btn btn-orange']) !!}
            </div>
        </div>
    </div>
</div>
@section('additionalJs')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDn51pqaS1TiPFYgZAXBg-oetK6KQ6XnCY&libraries=places"></script>
<script>
    $(document).ready(function() {
        function initialize() {
            var options = {
                componentRestrictions: {country: "MK"}
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
        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
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
        
        if(getParameterByName('share') == 'y') {
            $('#share-modal').modal('show');
        }
    });
</script>
<script>
    window.twttr = (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
      if (d.getElementById(id)) return t;
      js = d.createElement(s);
      js.id = id;
      js.src = "https://platform.twitter.com/widgets.js";
      fjs.parentNode.insertBefore(js, fjs);

      t._e = [];
      t.ready = function(f) {
        t._e.push(f);
      };

      return t;
    }(document, "script", "twitter-wjs"));
</script>
@endsection
