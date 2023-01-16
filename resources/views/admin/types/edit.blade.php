@extends('layouts.admin')

@section('name')
Edit Type
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
<div class="container ms-2">
    <div class="row">
        <form action="{{route('admin.types.update', $type->slug)}}" method="post" class="col-12 col-xl-6 p-4 rounded-2 bg-dark text-white">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('name', $type->name)}}">
                <small id=" helpId" class="text-muted">*name is mandatory, must be unique and the max length is 100 chars</small>
            </div>
            <div class="mt-3 d-flex justify-content-between">
                <button type="submit" class="btn btn-secondary">Edit</button>
                <a class="btn btn-secondary text-white" href="{{route('admin.types.index')}}">Back to types</a>
            </div>

        </form>
    </div>
</div>



@endsection