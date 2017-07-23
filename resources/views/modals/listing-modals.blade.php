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
<div class="modal fade" tabindex="-1" role="dialog" id="share-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thank you for listing your place</h4>
      </div>
      <div class="modal-body">
        <p>Your place is successfully listed. Help us spread the word?</p>
        <div class="text-center">
          <div class="fb-share-button" data-href="{{route('listing.show', $listing->id)}}" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="{{route('listing.show', $listing->id)}}">Share</a></div>
          <a class="twitter-share-button"
          href="{{route('listing.show', $listing->id)}}"
          data-size="large">
        Tweet</a>
        </div>
      </div>
    </div>
  </div>
</div>