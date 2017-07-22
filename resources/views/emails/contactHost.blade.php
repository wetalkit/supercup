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
              				<img src="{{ url('images/email-logo.png') }}" />
						</td>
					</tr>
				</table>

                <p>Hi {{ $listing->user->name }},</p>

                <p>{{ $guest->name }} is interested in being your host for the upcomming UEFA Super Cup in Skopje.</p>

                <p>Here is the message sent by {{ $guest->name }}:</p>

                <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                  <tbody>
                    <tr>
                      <td align="left">
                        <table border="0" cellpadding="0" cellspacing="0">
                          <tbody>
                            <tr>
                              <td><a href="#" target="_blank">Be {{ $guest->name }}'s host</a> </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>

                <p>Thanks for making Skopje great again!</p>
                <br/>
                <i>
                	<p>{{ config('app.name') }} is a volunteering project from the WeTalkIT developers community. We are not responsible for the interactions that you have with others, so please use good judgment and keep safety in mind when you use our Services.</p>
                </i>
              </td>
            </tr>
          	</table>
        </td>
  	</tr>
    </table>

    @include('emails.templates.footer')
            
@endsection