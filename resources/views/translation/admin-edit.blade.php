@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
       
        <div dir="rtl" class="overflow-x-auto">
            <div class="min-w-screen min-h-screen bg-gray-100 flex justify-center bg-gray-100 font-sans overflow-hidden">
                <div class="w-full lg:w-5/6">
                    <div class=" bg-white shadow-md rounded my-6">
                        <table dir="rtl">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 text-sm">
                                    <th class="py-3 px-6 text-right">شماره آیه</th>
                                    <th class="py-3 px-6 text-center">متن آیه</th>
                                    <th class="py-3 px-6 text-center">ذخیره سازی</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-lg font-light">
                                @foreach ($Translations as $item)  
                                {{-- {{ dd($item) }} --}}
                               
                                <tr class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">
                                   <td class="py-3 px-6 text-left">
                                       <div class="flex items-center">
                                           <span class="font-medium"> {{ $item->trans_ayah_num }}</span>
                                       </div>
                                   </td>
                                   <td class="py-3 text-right text-black">
                                       <div class="flex">
                                           <span>{{ $item->translation }}</span>
                                       </div>
                                   </td>
                                   
                                   <td class="py-3 px-6 text-center">
                                       <span class="bg-red-200 text-green-600 py-1 px-3 rounded-full text-xs"> ویرایش</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="w-8/12 bg-white p-6 rounded-lg">
                        {{ $Translations->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection