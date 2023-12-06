@extends('layouts.admin')


@section('content')

<div class="container text-white">


    <div class="card p-2 my-5">
        <p>This technology is..</p>
    </div>
    <a class="btn btn-light" href="{{ route('admin.technologies.index')}}">
        <i class="fa-solid fa-left-long"></i>
    </a>
</div>
@endsection
