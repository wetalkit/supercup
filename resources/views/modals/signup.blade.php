@if(!$user)

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModallabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header login_modal_header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        		<h3 class="modal-title">Login/Sign up to your account</h3>
      		</div>
      		<div class="modal-body login-modal">
      			<br/>
      			<div class="clearfix"></div>
				<div class="modal-social-icons">
    				<a href='/login' class="btn facebook"> <i class="fa fa-facebook modal-icons"></i> Sign In with Facebook </a>
    			</div> 
      		</div>
      		<div class="clearfix"></div>
      		<div class="modal-footer login_modal_footer">
      		</div>
    	</div>
  	</div>
</div>

@endif