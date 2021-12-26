@extends('layout.base')
@section('content')
<form action=" {{route('post.comment.make', $post->id)}} " method="POST">
    @csrf
    <div class="form-group">
      <label for="exampleInputText">Comment</label>
      <input type="text" name="comment" class="form-control" id="exampleInputComment" aria-describedby="textHelp" placeholder="Enter Your Comment">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection
