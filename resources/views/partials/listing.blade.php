<a href="{{ route('listing.show', $listing->id) }}" class="link-item">
    <div class="col-md-4 col-sm-6">
      <div class="gallery-section {{$listing->status ? 'booked' : ''}}" style="background-image: url({!! $listing->defaultImageSrc ? route('storage', $listing->defaultImageSrc) : '/images/imagena.jpeg' !!})">
          <span class="label label-booked">Booked</span>
      </div>
      <h3 class="listing-title">{{ $listing->title }}</h3>
      <h3 class="listing-author">by {!! $listing->user->name !!}</h3>
      <span class="distance">{!! $listing->distanceFormatted !!} from Stadium</span>
      <span>-</span>
      <span class="nr-of-beds">{!! $listing->no_beds !!} bed{{$listing->no_beds == 1 ? '' : 's'}}</span>
    </div>
</a>