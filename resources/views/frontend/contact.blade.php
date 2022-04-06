<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
    <meta name="site-url" content="{{ url('/') }}">
    <meta name="success-title" content="{{ session('success-title') }}">
    <meta name="success-message" content="{{ session('success-message') }}">
	<title>iDentSoft a Dental/Clinic Management Software | @lang('Contact') :: ambitiousit.net</title>
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.css') }}">
	<!-- Template CSS -->
	<link rel="stylesheet" href="assets/css/style-starter.css">
	<link rel="stylesheet" href="{{ asset('assets/css/frontend.css') }}">
    @if(session('locale') == 'ar')
        <link href="{{ asset('assets/css/bootstrap-rtl.min.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('assets/plugins/alertifyjs/css/themes/bootstrap.min.css') }}" rel="stylesheet">
    @endif
    <!-- sweetalert2 CSS -->
	<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
	<!-- Template CSS -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i,500,600,700&display=swap" rel="stylesheet">
	<!-- flag -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/flag-icons-3.1.0/css/flag-icon.css') }}">
</head>

<body>
	@include('frontend.common.header')
	<!-- /contact-form -->
	<section class="w3l-contact-main">
		<div class="contant11-top-bg py-5">
			<div class="container py-md-5">
				<div class="row contact-info-left text-center">
					<div class="col-lg-4 col-md-6 contact-info">
						<div class="contact-gd">
							<span class="fas fa-location-arrow" aria-hidden="true"></span>
							<h4>@lang('Address')</h4>
							<p>{{ nl2br(str_replace(["script"], ["noscript"], $contents->contactAddress)) }}</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 contact-info">
						<div class="contact-gd">
							<span class="fas fa-phone" aria-hidden="true"></span>
							<h4>@lang('Phone')</h4>
							<p>{{ nl2br(str_replace(["script"], ["noscript"], $contents->contactPhone)) }}</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 contact-info">
						<div class="contact-gd">
							<span class="fas fa-envelope-open" aria-hidden="true"></span>
							<h4>@lang('Mail')</h4>
							<p>{{ nl2br(str_replace(["script"], ["noscript"], $contents->contactMail)) }}</p>
						</div>
					</div>
				</div>
			</div>
	</section>
	<!-- //contact-form -->
	<!-- /contact-form -->
	<section class="w3l-contact-main">
		<div class="contact-infhny py-5">
			<div class="container py-lg-5">
				<div class="title-content text-left mb-lg-5 mt-4">
					<h6 class="sub-title">@lang('Contact Us')</h6>
					<h3 class="hny-title">@lang('Drop your message for any info') <br>@lang('or question.')</h3>
				</div>
				<div class="row align-form-map">
					<div class="col-lg-6 form-inner-cont">
						<form action="{{ route('contact-form.store') }}" method="post" class="signin-form">
							@csrf
							<div class="form-input">
								<label for="Name">@lang('Name')*</label>
								<input type="text" name="name" id="Name" placeholder="" required>
							</div>
							<div class="form-input">
								<label for="Sender">@lang('Email')*</label>
								<input type="email" name="email" id="Sender" placeholder="" required>
							</div>

							<div class="form-input">
								<label for="Message">@lang('Message')*</label>
								<textarea placeholder="" name="message" id="Message" required></textarea>
							</div>

							<button type="submit" class="btn btn-contact">@lang('Submit')</button>
						</form>
					</div>
					<div class="map col-lg-6 pl-lg-4">
                        <iframe id="custom-contact-b" src="{{ str_replace(["script"], ["noscript"], $contents->contactGoogleMap) }}" width="100%" height="450" allowfullscreen="" loading="lazy"></iframe>
					</div>
				</div>
			</div>
	</section>
	<!-- //contact-form -->

	@include('frontend.common.footer')
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    @if(session('locale') == 'ar')
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    @else
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    @endif
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/frontend/contact.js') }}"></script>
</body>

</html>
