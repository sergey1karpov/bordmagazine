@extends('layouts.app')

@section('content')

<div class="row text-center" style="margin-right: 0; margin-left: 0;">
<section class="content">
	<div class="col-lg-12 ml">
		<h3>Contact form</h3>
		<hr>
		<address>
		<strong>USA address:</strong> eNest LLC 666, E Thistle Landing, Dr. Suit 100 AZ 85044 USA ,<br>
		<strong>Phone:</strong> +8-800-555-3535
		</address>

		<address>
		<strong>Mars Address:</strong>  (Haftungsbeschraenkt/Limited-Liability), Morsering 2, Munich 80937 Msrs , <br>
		<strong>Phone:</strong> +8-800-555-3535
		</address>
	</div>

	<div class="col-lg-12 contact-form">
	<form id="contact" method="post" class="" role="form" action="{{url('/contacts/send')}}">
		@csrf
		<div class="row">
			<div class="col-xs-6 col-md-6 form-group">
				<input class="form-control" id="name" name="name" placeholder="Name" type="text" required autofocus />
			</div>
			<div class="col-xs-6 col-md-6 form-group">
				<input class="form-control" id="email" name="email" placeholder="Email" type="email" required />
			</div>
		</div>
		<textarea class="form-control" id="message" name="message" placeholder="Message" rows="5"></textarea>
		<br />
		<div class="row">
			<div class="col-xs-12 col-md-12 form-group">
		<button class="btn btn-primary pull-right" type="submit">Submit</button>
	</form>
</section>
</div>


@endsection
