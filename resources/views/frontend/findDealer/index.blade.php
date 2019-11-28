@extends('layouts.master')

@section('pageTitle', 'Найти дилера')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/css/find-dealer/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/find-dealer/find-dealer.css') }}">
@endsection

@section('content')

@component('components/plugin-map')@endcomponent

<section id="finddealer">
	<div v-if="!init">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					@component('components/placeholder')@endcomponent
				</div>
			</div>
		</div>
	</div>
	<find-dealer-page v-else></find-dealer-page>
</section>

@endsection

@section('scripts')
    <script src="{{ mix('/js/find-dealer/libs.js') }}"></script>
	<script src="{{ mix('/js/find-dealer/find-dealer.js') }}"></script>
@endsection
