<?php

namespace App\Http\Controllers\Admin\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ProjectStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectStoreRequest $request)
    {
        $val_data = $request->validated();
        $img_path = Storage::put('images', $val_data['img']);
        $val_data['img'] = $img_path;
        $val_data = Project::make($val_data)->getProjectWithSlug()->save();
        return to_route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //dd($project);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ProjectUpdateRequest;  $request
     * @param   Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $val_data = $request->validated();
        /* dd($val_data); */
        if ($request->hasFile('img')) {
            if ($project->img) {
                Storage::delete($project->img);
            }
            $img_path = Storage::put('images', $val_data['img']);
            $val_data['img'] = $img_path;
        }

        $project->getProjectWithSlug()->update($val_data);
        return to_route('admin.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->img) {
            Storage::delete($project->img);
        }

        $project->delete();
        return to_route('admin.projects.index');
    }
}
