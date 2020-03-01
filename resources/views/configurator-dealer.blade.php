@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{ mix('/dealer/css/configurator/libs.css') }}">
    <link rel="stylesheet" href="{{ mix('/dealer/css/configurator/configurator.css') }}">
@endsection

@section('content')
	
	@component('components/plugin-map')@endcomponent

    <div id="app">
        <div class="configurator-holder">
            <configurator></configurator>
            <div id="dbm"></div>
        </div>
	</div>
	
	<div id="forms">
		<sign-up-test-drive-form-popup page="isConfiguratorPage" v-if="isVisible"></sign-up-test-drive-form-popup>
	</div>
@endsection

@section('scripts')
    <script src="{{ mix('/dealer/js/configurator/libs.js') }}"></script>
    <script src="{{ mix('/dealer/js/configurator/configurator.js') }}"></script>
    <script src="{{ mix('/dealer/js/configurator/forms.js') }}"></script>
@endsection