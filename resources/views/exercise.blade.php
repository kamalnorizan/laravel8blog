<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>My Exercise</h1>
    {{-- {{$hobby ?? 'Hobby is undefined'}} --}}
    {{-- @if (isset($hobbies))
        @foreach ($hobbies as $hobi)
            {{$hobi}} <br>
        @endforeach
    @else
        Hobbies is undefined
    @endif --}}

    @isset($hobbies)
        @foreach ($hobbies as $hobi)
            {{$hobi}} <br>
        @endforeach
    @else
        Hobbies is undefined
    @endisset

    {{-- @forelse ($hobbies as $hobi)
        {{$hobi}} <br>
    @empty
        Hobbies is undefined
    @endforelse --}}

</body>
</html>
