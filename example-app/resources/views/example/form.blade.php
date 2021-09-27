@extends('layouts/base')

@section('content')
    <div class="row">
	<div class="col">
		<form id="example-form">
			<div class="form-group">
				<label for="example-code">Code</label>
				<input type="text" id="example-code" class="form-control" name="code" placeholder="Example code">
			</div>

			<div class="form-group">
				<label for="example-description">Description</label>
				<input type="text" id="example-description" class="form-control" name="description" placeholder="Example description">
			</div>

			<button type="submit" class="btn btn-primary">Create Example</button>
		</form>

		<div id="example-view"></div>

		<script>
			document.querySelector('#example-form').onsubmit = function(e) {
				e.preventDefault();

				const data = new FormData(e.target);

				// Ensure every input has a value
				for (var [key, value] of data.entries()) { 
					if (!value) {
						document.querySelector('#example-form input[name="' + key + '"]').focus();
						return;
					}
				}
				sendPost('example/create', data, view => document.querySelector('#example-view').innerHTML = view);
			};
		</script>
	</div>
</div>
@endsection