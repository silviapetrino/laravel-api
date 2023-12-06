<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Project;
use Illuminate\Support\Str;
use App\Http\Requests\TypeRequest;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::orderBy('id', 'desc')->get();
        return view('admin.types.index', compact('types'));
    }

    public function typeProject(){
        $types = Type::all();
        return view('admin.types.type-project', compact('types'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::orderBy('id', 'desc')->get();

        return view('admin.types.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeRequest $request)
    {
        // prima di creare una nuova categoria verifico se esiste già

        $exixts = Type::where('name', $request->name)->first();
        if($exixts){
            return redirect()->route('admin.types.index')->with('error', 'type exists');
        }else{
            $new_type = new Type();
            $new_type->name = $request->name;
            $new_type->slug = Type::generateSlug($request->name, Type::class);
            $new_type->save();
            return redirect()->route('admin.types.index')->with('success', 'Type added successfully');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view('admin.types.show', $type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypeRequest $request, Type $type)
    {
        $form_data = $request->all();

        $exixts = Type::where('name', $request->name)->first();
        if($exixts){
            return redirect()->route('admin.types.index')->with('error', 'Type exist');
        }

        $request['slug'] = Str::slug($request->name, '-');

        $type->update($form_data);

        return redirect()->route('admin.types.index', $type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $route = route('admin.projects.destroy', $type);
        $type->delete();
        return redirect()->route('admin.types.index')->with('success', 'the type was successfully deleted');
    }
}
