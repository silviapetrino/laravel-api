@extends('layouts.admin')

@section('content')


<div class="container">
    <h1>Projects by type</h1>


<table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Type</th>
        <th scope="col">Related project</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($types as $type)
        <tr>
             <td>{{ $type->id }}</td>
             <td>{{ $type->name }}</td>
             <td>
                <ul class="list-group">
                    @foreach ($type->projects as $project)
                        <li class="list-group-item bg-black">
                            <a class="text-decoration-none" href="{{ route('admin.projects.show', $project) }}">
                                <span>{{ $project->title }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
             </td>

        </tr>
        @endforeach
    </tbody>
  </table>

</div>


@endsection
