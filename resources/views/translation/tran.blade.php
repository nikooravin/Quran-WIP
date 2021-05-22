@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
       @foreach ($surahs as $item)
           سوره: {{ ($item->name) }}
           /
           تعداد آیات: {{ ($item->ayah_count) }}
           <br>
       @endforeach
    </div>
</div>
@endsection