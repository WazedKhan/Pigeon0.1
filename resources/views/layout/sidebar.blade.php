<div class="content-section">
    <h3>Our Sidebar</h3>
    <p class='text-muted'>You can put any information here you'd like.
      <ul class="list-group">
          @foreach ($user_info as $item)
          <li class="list-group-item list-group-item-light">{{ $item->name }}</li>
          @endforeach
      </ul>
    </p>
    <form class="d-flex">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit" class="p-lg-5">Search</button>
    </form>
  </div>
