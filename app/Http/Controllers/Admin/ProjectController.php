<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use App\Models\Type;
use App\Models\Technology;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('id', 'desc')->paginate(5);

        return view('admin.projects.index', compact('projects'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Add new project';
        $method = 'POST';
        $route = route('admin.projects.store');
        $project = null;
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create-edit', compact('title','method', 'route', 'project', 'types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $data = $request->all();
        $new_project = new Project();
        $new_project->fill($data);
        $new_project->slug = Project::generateSlug($request->title, '-');
         // se esiste la chiave image salvo l'immagine nel file system e nel database
         if(array_key_exists('image', $data)) {

            // prima di salvare il file prendo il nome del file per salvarlo nel db
            $data['image_original_name'] = $request->file('image')->getClientOriginalName();
            // salvo il file nello storage rinominandolo
            $data['image'] = Storage::put('uploads', $data['image']);

        }


        $new_project->save();
        
        if(array_key_exists('technologies', $data)){
            $new_project->technologies()->attach($data['technologies']);
        }

        return redirect()->route('admin.projects.show' , $new_project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $title = 'Edit project';
        $method = 'PUT';
        $route = route('admin.projects.update', $project);
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create-edit', compact('title','method', 'route', 'project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
     {
        $data = $request->all();

            if($data['title'] != $project->title){
                $data['slug'] = Str::slug($request->title, '-');
            }else{
                $data['slug'] = $project->slug;
            }

        $project->update($data);

        if(array_key_exists('technologies',$data)){
            $project->technologies()->sync($data['technologies']);
        }else{
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $route = route('admin.projects.destroy', $project);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'the project was successfully deleted');
    }
}
