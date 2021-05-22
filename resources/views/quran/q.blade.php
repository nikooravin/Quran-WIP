@extends('layouts.app')

@section('content')
    <div dir="rtl" class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg ">
            <div class="bg-gray-50 rounded-lg text-lg font-semibold">
                سوره : {{ $surah }}
                آیه : {{ $ayah }}
            
            </div>
            <div class="bg-purple-50 rounded-lg text-lg font-semibold
            mb-4 mt-4">
                {{  $data_ar }}
                ({{ $ayah }})
            </div>
            <div class="bg-yellow-100 rounded-lg text-lg font-semibold">
                {{  $data_fa }}
                ({{ $ayah }})
            
            </div>
            
        </div>
    </div>
@endsection

