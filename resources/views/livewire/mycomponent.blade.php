<div dir="rtl">

    <div class="flex">
        <div>
            <label id="listbox-label" class="flex text-sm font-medium text-gray-700">
                انتخاب سوره
            </label>

            <select wire:model="selectedSurah"
                class="flex w-auto bg-white shadow-lg max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
                tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">
                <option value=""> لیست سوره ها</option>

                @foreach ($surahs as $surah)
                <option value="{{ $surah->id }}">{{ $loop->iteration }}.{{ $surah->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="pr-6">
            <label id="listbox-label" class="flex text-sm font-medium text-gray-700">
                انتخاب آیه
            </label>
            @if (!is_null($ayah_count))
            <select wire:model="selectedAyah"
                class="flex w-auto bg-white shadow-lg max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
                tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">
                <option value=""> نمایش کل سوره</option>
                @for ($i = 1; $i <= $ayah_count; $i++) <option value="{{ $i }}"> {{ $i }}</option>
                    @endfor
            </select>
            @endif
        </div>

        <div class="pr-6">
            <label id="listbox-label" class="flex text-sm font-medium text-gray-700">
                انتخاب ریشه
            </label>
            @if (!is_null($roots_word))
            <select wire:model="selectedroot"
                class="flex w-auto bg-white shadow-lg max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
                tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">
                <option value=""> ریشه ها</option>
                @foreach ($roots_word as $item) 
                <option value="{{ $loop->index }}"> {{ $item->word }}</option>
               @endforeach
            </select>
            {{-- {{ dump($selectedroot) }} --}}
            {{-- {{ dd($roots) }} --}}
            @endif
        </div>

        <div class=" flex pr-6 mt-5">
            <div>
                <input wire:model="language" id="farsi" name="selector" type="radio" value="Farsi" /> ترجمه
            </div>
            <div>
                <input wire:model="language" id="arabic" name="selector" type="radio" value="Arabic" /> قرآن
            </div>
        </div>

        <div class="pr-6 mt-5">
            <input wire:model.lazy="term" type="text" placeholder="جستجوی {{  $language  }}"
                class="flex object-leftw-auto bg-white shadow-lg max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
        </div>
    </div>
    
    <div>
        <div x-data="{ openTab: 1 }">
            <ul class="flex border-b mt-3">
                <li @click="openTab = 1" :class="{ '-mb-px': openTab === 1 }" class="-mb-px mr-1">
                    <a :class="openTab === 1 ? 'border-l border-t border-r rounded-t text-blue-700' : 'text-blue-500 hover:text-blue-800'"
                        class="bg-white inline-block py-2 px-4 font-semibold" href="#">قرآن</a>
                </li>
                <li @click="openTab = 2" :class="{ '-mb-px': openTab === 2 }" class="mr-1">
                    <a :class="openTab === 2 ? 'border-l border-t border-r rounded-t text-blue-700' : 'text-blue-500 hover:text-blue-800'"
                        class="bg-white inline-block py-2 px-4 font-semibold" href="#">ترجمه</a>
                </li>
                
                <li @click="openTab = 3" :class="{ '-mb-px': openTab === 3 }" class="mr-1">
                    <a :class="openTab === 3 ? 'border-l border-t border-r rounded-t text-blue-700' : 'text-blue-500 hover:text-blue-800'"
                        class="bg-white inline-block py-2 px-4 font-semibold" href="#">
                         جستجوی ترجمه: @if (!is_null($result_fa))   {{ $term }} {{'('.$result_fa->total().')' }}    @endif        
                    </a>
                </li>
                
                
                <li @click="openTab = 4" :class="{ '-mb-px': openTab === 3 }" class="mr-1">
                    <a :class="openTab === 4 ? 'border-l border-t border-r rounded-t text-blue-700' : 'text-blue-500 hover:text-blue-800'"
                        class="bg-white inline-block py-2 px-4 font-semibold" href="#">
                        جستجوی قرآن: @if (!is_null($result_ar)) {{ $term }} {{'('.$result_ar->total().')' }}@endif    
                    </a>
                </li>

                <li @click="openTab = 5" :class="{ '-mb-px': openTab === 3 }" class="mr-1">
                    <a :class="openTab === 5 ? 'border-l border-t border-r rounded-t text-blue-700' : 'text-blue-500 hover:text-blue-800'"
                        class="bg-white inline-block py-2 px-4 font-semibold" href="#">
                        جستجوی ریشه: @if (!is_null($selectedroot)) {{ $roots_word[$selectedroot]->word }} {{'('.$roots_result->total().')' }}@endif    
                    </a>
                </li>
                
                <li class="pt-2 mr-48">
                    <div>
                        <button wire:click="back">
                            <<</button> ص: {{  $this->page }} <button wire:click="next">>>
                        </button>
                    </div>
                </li>
            </ul>
        
            <div class="w-full">
                <div x-show="openTab === 1">
                    <div class="pt-1" id="ar_verse">
                        <div
                            class="decoration-clone bg-gradient-to-b from-gray-100 to-white-50  text-xl leading-9 font-semibold px-8 text-justify justify-center">
                            @if (!is_null($ar_verse))
                            <div wire:model="selectedText" class="mt-5">
                                @foreach ($ar_verse as $item)
                                <span x-data="{ hover: false }" class="relative absolute">
                                    <span x-on:mouseover="hover = true" x-on:mouseout="hover = false"
                                        class="hover:text-blue-500">
                                        {{ $item['ayah_ar_content'] }} ({{ $item['ayah_num'] }} :
                                        {{ $item['surah_id'] }})
                                    </span>

                                    <span x-show="hover"
                                        class="fixed z-0 w-64 p-2 -mt-1 text-sm leading-tight text-white transform translate-x-1/2 -translate-y-full bg-green-600 rounded-lg shadow-lg pointer-events-none">
                                    {{ $fa_verse[$loop->index]['translation'] }} : {{ $fa_verse[$loop->index]['trans_ayah_num'] }}
                                    </span>
                                
                                </span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        
            <div x-show=" openTab===2">
                <div class="pt-1" id="fa_verse">
                    <div class="decoration-clone bg-gradient-to-b from-gray-100 to-blue-50  text-xl leading-8 font-semibold px-8 text-justify justify-center">
                        @if (!is_null($fa_verse))
                        <div wire:model="selectedText" class="mt-5">
                            @foreach ($fa_verse as $item)
                            {{ $item['translation'] }} ({{ $item['trans_ayah_num'] }} :
                            {{ $item['surah_id'] }})
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div x-show=" openTab===3">
                @if (!is_null($result_fa))
                    @foreach ($result_fa as $item)
                    {{ (($result_fa->currentPage() * 15) - 15) + $loop->iteration }}. {{ $item->translation }}
                   <br><br>
                   <hr> 
                    @endforeach
                    {{ $result_fa->links() }}
                @endif
            </div>

            <div x-show=" openTab===4">
                @if (!is_null($result_ar))
                    @foreach ($result_ar as $item)
                    {{ (($result_ar->currentPage() * 15) - 15) + $loop->iteration  }}. {{ $item->ayah_ar_content }}
                   <br><br>
                   <hr> 
                    @endforeach
                    {{ $result_ar->links() }}
                @endif
            </div>

            <div x-show=" openTab===5">
                @if (!is_null($roots_result))
                <div>
                    @foreach ($roots_result as $item)
                    {{ (($roots_result->currentPage() * 15) - 15) + $loop->iteration  }}. {{ $item->ayah_ar_content }} ({{ $item->ayah_num }} :
                        {{ $item->surah_id }})
                        <br> <br>
                        @endforeach
                        {{ $roots_result->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>