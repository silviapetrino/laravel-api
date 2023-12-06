@extends('layouts.admin')

@section('content')


    <div class="container">
        @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
         @endif
        <div class="top d-flex align-items-center justify-content-between my-4">
            <h1 class="text-white">Projects List</h1>
            <a class="btn btn-light" href="{{ route('admin.projects.create') }}">
                <i class="fa-solid fa-plus fa-beat-fade"></i>
                <span>Add new project</span>
            </a>

        </div>

        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Type</th>
                    <th scope="col">Technologies</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

             @foreach ($projects as $project)
                <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->type?->name ?? '-'}}</td>
                    <td>
                        @forelse ($project->technologies as $technology)
                           <a href="{{ route('admin.project-technology', $technology)}}"><span class="badge bg-primary">{{ $technology->name }} </span></a>
                        @empty
                            -
                        @endforelse
                    </td>
                    <td>
                        <a class="btn btn-light" href="{{ route('admin.projects.show' , $project)}}"><i class="fa-solid fa-eye"></i></a>
                        <a class="btn btn-warning mt-1" href="{{ route('admin.projects.edit', $project) }}"><i class="fa-solid fa-pencil"></i></a>
                        @include('admin.partials.delete-form', [
                            'route' => route('admin.projects.destroy', $project),
                            'message' => 'Are you sure you want to delete this project?',
                        ])
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        {{ $projects->links()}}
    </div>





@endsection
