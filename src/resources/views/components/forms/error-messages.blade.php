@props(['errors', 'name'])

@if ($errors->has($name))
  <div class="alert alert-danger my-1 p-1" style="font-size: 12px">
      <ul class="ps-0 mb-0" style="list-style: none">
          @foreach ($errors->get($name) as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
