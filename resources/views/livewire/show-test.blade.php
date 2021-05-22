<div dir="rtl">
    <div>
        <input wire:model.lazy="term" type="text" name="" id="" placeholder="جستجو">
    </div>
    <div>
        @if(!is_null($data))
        @foreach ($data as $item)
        {{ $item->translation }} <br> <br>
        @endforeach
        {{ $data->links() }}
        @endif
    </div>
</div>