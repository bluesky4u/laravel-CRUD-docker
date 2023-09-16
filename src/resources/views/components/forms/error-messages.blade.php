@props(['errors', 'name'])

@if ($errors->has($name))
  <div class="alert alert-danger my-3 fs-5 fw-bold">
      <ul class="ps-0 mb-0">
          @foreach ($errors->get($name) as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
