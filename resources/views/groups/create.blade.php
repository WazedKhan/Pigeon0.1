@extends('layout.base')
@section('content')
    <form action="" method="post">
        <div class="form-group">
            <label >Group Name</label>
            <input type="name" name="name" class="form-control" placeholder="Group name">
        </div>
        <label >Choose Privacy</label>
        <select class="form-control" name="privacy" id="lang">
            <option value="public">Public</option>
            <option value="private">Private</option>
        </select>

        <div class="form-group">
          <label for="">About</label>
          <textarea class="form-control" name="about" id="" rows="5" placeholder="Write about your group"></textarea>
        </div>

        <div class="input-group">
            <div class="custom-file">
              <input type="file" name="image" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
              <label class="custom-file-label" for="inputGroupFile04"><p class="text-secondary" >Select a image</p></label>
            </div>
        </div>

          <button type="submit" class="btn btn-primary m-1">Submit</button>
    </form>

@endsection