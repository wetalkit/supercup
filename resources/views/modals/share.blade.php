<div class="modal fade" tabindex="-1" role="dialog" id="shareModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thank you for your support</h4>
      </div>
      <div class="modal-body">
        <p>You are amazing! ❤ Thank you for your support.</p>
        <p>Let’s call your friends to join the initiative?</p>
        <div class="text-center">
          <div class="fb-share-button" data-href="{{url('/')}}" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="{{url('/')}}">Share</a></div>
          <a class="twitter-share-button"
          href="{{route('listing.show', $listing->id)}}"
          data-size="large"
          data-text="I just supported #SuperCup Free Accommodation initiative from @WeTalkIT. 🇲🇰🛏 Let’s share the love:"
          data-url="{{url('/')}}">
        Tweet</a>
        </div>
      </div>
    </div>
  </div>
</div> 