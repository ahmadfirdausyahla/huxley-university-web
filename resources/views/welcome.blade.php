<section class="py-24 relative bg-cover bg-center" style="background-image: linear-gradient(rgba(15, 15, 15, 0.9), rgba(15, 15, 15, 0.95)), url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=2070');">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="mb-10" data-aos="fade-up">
            <h2 class="text-3xl font-bold flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-brand-blue inline-block"></span> News.</h2>
            <p class="text-xs text-gray-400 mt-2">Communication Center | For You Page</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 auto-rows-[250px]">
            
            @foreach($news as $index => $item)
                @php
                    // Berita pertama (index 0) otomatis besar (2 kolom, 2 baris). Berita ke-2 & ke-3 kecil.
                    $colSpan = $index === 0 ? 'col-span-1 md:col-span-2' : 'col-span-1';
                    $rowSpan = $index === 0 ? 'row-span-1 md:row-span-2' : 'row-span-1';
                    
                    // Deteksi apakah gambar dari URL eksternal atau upload lokal storage
                    $imageUrl = filter_var($item->image, FILTER_VALIDATE_URL) 
                        ? $item->image 
                        : asset('storage/' . $item->image);
                @endphp

                <div data-aos="fade-up" class="{{ $colSpan }} {{ $rowSpan }} relative rounded-2xl overflow-hidden group cursor-pointer">
                    <img src="{{ $imageUrl }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent p-6 flex flex-col justify-end">
                        <span class="text-[10px] text-gray-300 font-bold tracking-widest mb-2">{{ $item->label }}</span>
                        <h3 class="text-lg md:text-xl font-bold mb-4 line-clamp-3">{{ $item->title }}</h3>
                        <div>
                            <a href="#" class="bg-brand-blue text-white text-xs px-4 py-2 rounded-full font-bold inline-flex items-center gap-2 hover:bg-blue-600 transition">
                                READ NEWS <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            <div data-aos="fade-up" class="col-span-1 row-span-1 bg-brand-blue rounded-2xl p-6 flex flex-col justify-center relative overflow-hidden group">
                <div class="relative z-10">
                    <span class="text-[10px] text-blue-200 font-bold tracking-widest mb-2 block">INFO | AUGUST 2022</span>
                    <h3 class="text-xl font-bold mb-4">JOIN NOW! | Welcoming new members</h3>
                    <a href="#" class="bg-white text-brand-blue text-xs px-4 py-2 rounded-full font-bold inline-flex items-center gap-2 mt-auto w-max">
                        REGISTRATION <i class="fa-solid fa-angles-right"></i>
                    </a>
                </div>
                <div class="absolute -right-4 -bottom-4 w-32 h-32 bg-white opacity-10 rounded-full group-hover:scale-150 transition duration-500"></div>
            </div>

            <div data-aos="fade-up" class="col-span-1 row-span-1 bg-gray-100 text-black rounded-2xl p-4 flex flex-col justify-between">
                <div class="flex justify-between items-center mb-2 border-b pb-2">
                    <i class="fa-solid fa-chevron-left text-xs cursor-pointer"></i>
                    <span class="text-sm font-bold">August 2022</span>
                    <i class="fa-solid fa-chevron-right text-xs cursor-pointer"></i>
                </div>
                <div class="grid grid-cols-7 gap-1 text-center text-[10px] font-bold text-gray-500 mb-1">
                    <div>M</div><div>T</div><div>W</div><div>T</div><div>F</div><div>S</div><div>S</div>
                </div>
                <div class="grid grid-cols-7 gap-1 text-center text-xs">
                    <div class="text-gray-300">31</div>
                    @for ($i = 1; $i <= 20; $i++)
                        @if($i == 15) 
                            <div class="bg-brand-blue text-white rounded-full flex items-center justify-center w-6 h-6 mx-auto">{{ $i }}</div>
                        @else
                            <div class="py-0.5">{{ $i }}</div>
                        @endif
                    @endfor
                </div>
            </div>

        </div>
    </div>
</section>