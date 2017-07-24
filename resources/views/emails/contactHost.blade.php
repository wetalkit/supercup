@extends('emails.templates.layout')

@section('content')

    <span class="preheader">{{ $guest->name }} is interested in being your host for the upcomming UEFA Super Cup in Skopje.</span>
    
    <table class="main">
  	<tr>
        <td class="wrapper">
          	<table border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td>
				<table>
					<tr>
						<td align="center">
      				<img src="{{ url('images/logo.png') }}" width="250px" />
						</td>
					</tr>
				</table>

        <p>Hi {{ $listing->user->name }},</p>

        <p>{{ $guest->name }} is interested in being your guest for the upcoming UEFA Super Cup 2017 in Skopje.</p>

        <p><b>Here is the message sent by {{ $guest->name }}:</b></p>

        <p>"{{ $messageContent }}"</p>

        <p>Let {{ $guest->name }} know that you saw this message by <b style="color:#e25626">replying directly on this email. </b></p>
        <p>If you agree to host {{ $guest->name }}, please let us know by <a href="{{ route('listing.edit', $listing->id) }}" target="_blank">marking your listing as Booked</a>.</p>

        <p><b>Thanks for making Skopje great again! 🇲🇰</b></p>
        <br/>
        <i>
        	<p><b>{{ config('app.name') }}</b> is a volunteering project from the WeTalkIT developers community. We are not responsible for the interactions that you have with others, so please use good judgment and keep safety in mind when you use our Services.</p>
        </i>
      </td>
    </tr>
      	</table>
    </td>
</tr>
</table>

    @include('emails.templates.footer')
            
@endsection