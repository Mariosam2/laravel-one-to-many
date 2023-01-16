@extends('layouts.admin')

@section('name')
{{$type->name}}

@endsection


@section('content')
<div class="container ms-2">
    <div class="row">
        <div class="col-12 col-xxl-4">
            <div class="card">
                <div class="card-body">
                    <div class="my-2"><strong>Name: </strong>{{$type->name}}</div>
                    <div class="my-2"><strong>Slug: </strong>{{$type->slug}}</div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="my-2"><strong>Id: </strong>{{$type->id}}</div>
                        <a class="btn btn-secondary text-white" href="{{route('admin.types.index')}}">Back to types</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection