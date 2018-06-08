@extends('layouts.template')
@section('title','Add New Post')
@section('content')
<h1>Add New Post</h1>
<div class="col-sm-8 col-sm-offset-2">
<form action="{{route('postrs.store')}}" method="post" enctype="multipart/form-data">
{{csrf_field()}}
<div class="form-group">
<label for="title">Title:</label>
<input name="title" type="text" class="form-control">

</div>

<div class="form-group">
<label for="body">Body:</label>
<textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
</div>

<div class="form-group">
<lable for="image">File input </lable>
<input type="file" name="image" id="image">
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<a href="{{route('postrs.index')}}" class="btn btn-default pull-right">Go Back</a>
</form>
</div>

@endsection