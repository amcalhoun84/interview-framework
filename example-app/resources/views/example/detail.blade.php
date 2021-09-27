@extends('layouts/base')

@section('content')
    <p>ID: <span class="bold">{{ $data[0]->id }}</span></p>
    <p>Created On: <span class="bold">{{ $data[0]->created_at }}</span></p>
    <p>Code: <span class="bold">{{ $data[0]->code }}</span></p>
    <p>Description: <span class="bold">{{ $data[0]->description }} </span></p>
@endsection