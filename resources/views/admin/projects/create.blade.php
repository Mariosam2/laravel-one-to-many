@extends('layouts.admin')

@section('name')
Add Project
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger mx-5">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{route('admin.projects.store')}}" method="post" class="p-5 mx-5 rounded-2 bg-dark text-white" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('title')}}">
        <small id=" helpId" class="text-muted">*title is mandatory, must be unique and the max length is 50 chars</small>
    </div>
    <div class="mb-3">
        <label for="img" class="form-label">Choose file</label>
        <input type="file" class="form-control" name="img" id="img" placeholder="" aria-describedby="fileHelpId" value="{{old('img')}}">
        <div id="fileHelpId" class="form-text">*max size 300KB</div>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" name="description" id="description" rows="3">{{old('description')}}</textarea>
    </div>
    <div class="mb-3">
        <label for="creation_date" class="form-label">Date</label>
        <input type="date" class="form-control" name="creation_date" id="creation_date" value="{{old('creation_date')}}">
    </div>
    <div class="mt-3 d-flex justify-content-between">
        <button type="submit" class="btn btn-secondary">Add</button>
        <a class="btn btn-secondary text-white" href="{{route('admin.projects.index')}}">Back to projects</a>
    </div>

</form>


@endsection