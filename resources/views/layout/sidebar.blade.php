<div class="content-section">
    <h3>Let's Meet Awesome People</h3>
    <p class='text-muted'>
      <ul class="list-group">
          @foreach ($user_info as $item)
          <li class="list-group-item list-group-item-light">{{ $item->name }}</li>
          @endforeach
      </ul>
    </p>
  </div>
