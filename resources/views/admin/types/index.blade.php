@extends('layouts.admin')


@section('content')

    <div class="container my-5">

        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
         @endif

         @if ($errors->any())
         <div class="alert alert-danger" role="alert">
              <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
             </ul>
         </div>
         @endif

         @if (session('error'))
             <div class="alert alert-danger" role="alert">
                 {{ session('error') }}
             </div>
         @endif

        <a class="btn btn-light" href="{{ route('admin.types.create') }}">Add new type +</i></a>

        <table class="table table-dark table-hover types" width="50%">
            <thead>
              <tr>
                <th class="text-danger" scope="col">Name</th>
                <th scope="col">actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($types as $type)
                    <tr>
                        <td>
                         {{$type->name}}
                        </td>


                        <td scope="row">
                            {{-- actions --}}
                            <a class="btn btn-light" href="{{ route('admin.types.show', $type) }}"><i class="fa-solid fa-file-lines"></i></i></a>

                            @include('admin.partials.delete-form', [
                            'route' => route('admin.types.destroy', $type),
                            'message' => 'Are you sure you want to delete this type?',
                            ])

                            

                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>




@endsection
