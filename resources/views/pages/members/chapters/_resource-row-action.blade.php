@if($cat && $cat['done'])
  <span class="resource-row-action is-done"><i class="bi bi-check-circle-fill"></i> Done</span>
@elseif($cat && $cat['watched'] > 0)
  <span class="resource-row-progress">{{ $cat['watched'] }}/{{ $cat['total'] }}</span>
  <span class="resource-row-action">Watch <i class="bi bi-arrow-right"></i></span>
@else
  <span class="resource-row-action">Watch <i class="bi bi-arrow-right"></i></span>
@endif
