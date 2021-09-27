@extends('layouts/error')

@section('content')
    <div class="container main">
		<div class="text-center">
			<h1>Status Code: {{ $status }}</h1>
			<h1>Message: {{ $message }}</h1>
		</div>
	</div>
@endsection