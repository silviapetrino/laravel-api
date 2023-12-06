@extends('layouts.admin')

@section('content')


<div class="container">
    <h1 class="text-white">Projects made with {{ $technology->name }} technology</h1>


<table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">project title</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($technology->projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->title }}</td>
            </tr>
        @endforeach

    </tbody>
  </table>

</div>


@endsection
