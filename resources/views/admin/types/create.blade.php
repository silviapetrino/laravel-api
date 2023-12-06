@extends('layouts.admin')

@section('content')

{{-- Creazione di un nuovo tipo --}}

<div class="container py-5">
    <form action="{{ route('admin.types.store') }}" method="POST" class="text-white" style="width: 500px;">
        @csrf
        @method('POST')
        <h2>Add new type</h2>

        {{-- Stampa tutti gli errori --}}
        @if($errors->any())
            <div class="alert" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-warning">Reset</button>
    </form>
</div>

@endsection

