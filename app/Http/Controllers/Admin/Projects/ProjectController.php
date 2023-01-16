<?php

namespace App\Http\Controllers\Admin\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Termwind\Components\Span;

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
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
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
        //dd($val_data);
        $img_path = Storage::put('images', $val_data['img']);
        $val_data['img'] = $img_path;
        $project = $val_data;
        $val_data = Project::make($val_data)->getProjectWithSlug($val_data['title'])->save();
        return to_route('admin.projects.index')->with('storeMsg', $project['title']);
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
        //dd($project->type());
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
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
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
        //dd($val_data);
        $project->getProjectWithSlug($val_data['title'])->update($val_data);
        return to_route('admin.projects.index')->with('updateMsg', $project->title);
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
        return to_route('admin.projects.index')->with('deleteMsg', $project->title);
    }
}
