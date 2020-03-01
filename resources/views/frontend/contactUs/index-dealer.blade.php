@extends('layouts.master-dealer')

@section('pageTitle', 'Форма обратной связи')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/dealer/css/contact-us/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/dealer/css/contact-us/contact-us.css') }}">
@endsection

@section('content')

<section id="contactus">
	<div v-if="!init">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					@component('components/placeholder')@endcomponent
				</div>
			</div>
		</div>
	</div>
	<contact-us-page v-else></contact-us-page>
</section>

@endsection

@section('scripts')
    <script src="{{ mix('/dealer/js/contact-us/libs.js') }}"></script>
	<script src="{{ mix('/dealer/js/contact-us/contact-us.js') }}"></script>
@endsection
