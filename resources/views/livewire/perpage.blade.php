<div>
    <div dir="rtl" class="flex justify-center mb-3">
        <div class="w-8/12 bg-white p-6 rounded-lg ">
          
            @foreach ($ayahs as $item)
                @foreach ($data1 as $divider)
                    @if ($item->ayah_num == $divider->page_ayah)
                        <div class="text-center">{{ $divider->id - 1 }}</div>
                    @endif
                @endforeach
            {{ $item->ayah_ar_content }} ({{ $item->ayah_num }})
            @endforeach

        </div>
    </div>
</div>