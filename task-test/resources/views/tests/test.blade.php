test

@foreach ($values as $value)
    <p>{{ $value->id }}</p>
    <p>{{ $value->text }}</p>
@endforeach
