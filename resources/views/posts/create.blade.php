@extends('posts.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Post</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('posts.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('posts.store') }}" method="POST">
    @csrf

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Title:</strong>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title" >
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <strong>Body:</strong>
            <textarea class="form-control @error('body') is-invalid @enderror" name="body" placeholder="Write here..."></textarea>
            <input type="hidden" name="publish_at" />
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection