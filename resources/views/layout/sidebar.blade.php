<div class="content-section">
    
    <p class='text-muted'>
      <ul class="list-group">
        <div class="list-group">
          <a href="{{ route('groups') }}" class="list-group-item list-group-item-action active text-center m-1"><i class="fas fa-users"> Goups</i></a>
        </div>
        <h3>Active Friends</h3>

          @foreach ($user_info as $item)
          @if ($item->user->is_active)
            <a href="{{ route('profile.show',$item->user->id) }}">
              <li class="list-group-item list-group-item-light m-1"> {{ $item->user->name }} <i class="fas fa-signal"></i></li>
            </a>
          @endif
          @endforeach
      </ul>
    </p>
</div>
