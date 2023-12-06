@extends('layouts.admin')


@section('content')

<div class="container text-white">


    <div class="card p-2 my-5">
        <p>un tipo di progetto front end...ecc</p>
    </div>
    <a class="btn btn-light" href="{{ route('admin.types.index')}}">
        <i class="fa-solid fa-left-long"></i>
    </a>
</div>
@endsection
