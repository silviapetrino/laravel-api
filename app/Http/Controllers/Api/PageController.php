<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class PageController extends Controller
{
    public function index(){
        $projects = Project::with('type', 'technologies')->get();
        return response()->json($projects);
    }

    public function getProjectBySlug($slug){

        // query che mi prende il project con lo slug passato con first(),  se mettessimo get() ci restituisce un array
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();
        if($project) $success = true;
        else $success = false;
        return response()->json(compact('project', 'success'));

    }

}

