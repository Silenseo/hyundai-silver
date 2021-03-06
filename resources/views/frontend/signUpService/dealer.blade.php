@extends('layouts.master-dealer')

@section('pageTitle', 'Запись на сервис')

@section('styles')
    <link rel="stylesheet" href="/dealer/css/sign-up-form/libs.css">
    <link rel="stylesheet" href="/dealer/css/sign-up-form/signUpForm.css">
@endsection

@section('content')

@component('components/plugin-map')@endcomponent
<section id="signup" class="form">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="form__wrap">
					<div v-if="!init">
						@component('components/placeholder')@endcomponent
					</div>
					<signup-forms v-else v-bind:form="'service'" :no-default-car="true"></signup-forms>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@section('scripts')
    <script src="/dealer/js/sign-up-form/libs.js"></script>
    <script src="/dealer/js/sign-up-form/sign-up-form.js"></script>
@endsection
