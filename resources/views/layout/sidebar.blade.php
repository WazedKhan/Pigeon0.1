<div class="content-section">
    <h3>Let's Meet Awesome People</h3>
    <p class='text-muted'>
      <ul class="list-group">
        <div class="list-group">
          <a href="{{ route('create.group') }}" class="list-group-item list-group-item-action active text-center m-1"><i class="fas fa-users"> Goups</i></a>
        </div>
          @foreach ($user_info as $item)
          <li class="list-group-item list-group-item-light m-1">{{ $item->name }}</li>
          @endforeach
      </ul>
    </p>
</div>
