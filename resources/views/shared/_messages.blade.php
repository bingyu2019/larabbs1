@foreach(['danger', 'warning', 'success', 'info'] as $msg)
  @if(session()->has($msg))
        <div class="flash-message">
          <p class="alert alert-{{ $msg }}">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session()->get($msg) }}
          </p>
        </div>
  @endif
@endforeach


