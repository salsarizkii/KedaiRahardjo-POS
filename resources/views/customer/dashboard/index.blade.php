@extends('customer.dashboard.body.main')

@section('container')
    <div class="h-screeno mx-4 pb-32">
        <h1 class="text-2xl font-bold mb-4">Welcome to Kedai Rahardjo!</h1>
    <!-- Sliding Carousel -->
    <div x-data="{ 
        activeSlide: 0, 
        slides: [
          '{{ asset('assets/images/carousel1.jpg') }}',
          '{{ asset('assets/images/carousel2.jpg') }}',
          '{{ asset('assets/images/carousel3.jpg') }}'
        ],
        interval: null,
        init() {
          this.autoSlide();
        },
        autoSlide() {
          this.interval = setInterval(() => {
            this.nextSlide();
          }, 3000);
        },
        stopAutoSlide() {
          clearInterval(this.interval);
        },
        prevSlide() {
          this.activeSlide = this.activeSlide === 0 ? this.slides.length - 1 : this.activeSlide - 1;
        },
        nextSlide() {
          this.activeSlide = (this.activeSlide + 1) % this.slides.length;
        }
      }" 
      class="w-full mt-2"
      @mouseenter="stopAutoSlide()"
      @mouseleave="autoSlide()">
      
      <!-- Carousel Container -->
      <div class="relative w-full mx-auto rounded-xl overflow-hidden" style="aspect-ratio: 16/9;">
        <!-- Sliding Images Container -->
        <div 
          class="flex transition-transform duration-500 h-full"
          :style="`transform: translateX(-${activeSlide * 100}%);`">
          
          <!-- Individual Slides -->
          <template x-for="(slide, index) in slides" :key="index">
            <div class="w-full h-full flex-shrink-0">
              <img 
                :src="slide" 
                class="w-full h-full object-cover"
                alt="Promo Image"
              />
            </div>
          </template>
        </div>

        <!-- Navigation Arrows -->
        <button @click.prevent="prevSlide()" class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white/60 rounded-full p-1 shadow-md z-10">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </button>
        <button @click.prevent="nextSlide()" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white/60 rounded-full p-1 shadow-md z-10">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>

        <!-- Dots -->
        <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 flex space-x-1 z-10">
          <template x-for="(slide, index) in slides" :key="index">
            <button
              @click="activeSlide = index"
              class="w-2 h-2 rounded-full transition-colors"
              :class="activeSlide === index ? 'bg-red-600' : 'bg-gray-300'"
            ></button>
          </template>
        </div>
      </div>
    </div>

   <div class="bg-gradient-to-r from-amber-100 to-yellow-50 p-6 rounded-xl shadow-lg my-6 text-center">
  <p class="text-xl font-bold text-gray-800 tracking-wide">
    Order now and <span class="text-yellow-600">savor your favorite dishes</span><br>
    from <span class="text-yellow-700">Kedai Rahardjo</span> 🍜
  </p>
</div>



     <!-- Menu Kategori -->
    <div class="mt-6 mb-4">
      <h2 class="text-lg font-bold">Menu Kategori</h2>
      <div class="grid grid-cols-2 gap-4 mt-4">

        <!-- Makanan -->
        <a href="/menu/makanan" class="flex flex-col items-center justify-center bg-red-50 p-4 rounded-xl shadow-sm hover:bg-red-100 transition">
          <img src="https://img.icons8.com/ios/50/FA5252/rice-bowl.png" class="w-10 h-10" />
          <p class="text-red-600 mt-2 font-medium">Makanan</p>
        </a>

        <!-- Minuman -->
        <a href="/menu/minuman" div class="flex flex-col items-center justify-center bg-red-50 p-4 rounded-xl shadow-sm hover:bg-red-100 transition">
          <img src="https://img.icons8.com/ios/50/FA5252/soda-cup.png" class="w-10 h-10" />
          <p class="text-red-600 mt-2 font-medium">Minuman</p>
        </a>

        <!-- Snack -->
        <a href="/menu/snack" class="flex flex-col items-center justify-center bg-red-50 p-4 rounded-xl shadow-sm hover:bg-red-100 transition">
          <img src="https://img.icons8.com/ios/50/FA5252/french-fries.png" class="w-10 h-10" />
          <p class="text-red-600 mt-2 font-medium">Snack</p>
        </a>

        <!-- Paket -->
        <a href="/menu/paket" class="flex flex-col items-center justify-center bg-red-50 p-4 rounded-xl shadow-sm hover:bg-red-100 transition">
          <img src="https://img.icons8.com/external-konkapp-detailed-outline-konkapp/64/FA5252/external-takeaway-cafe-konkapp-detailed-outline-konkapp.png" class="w-10 h-10" />
          <p class="text-red-600 mt-2 font-medium">Paket</p>
        </a>

      </div>
    </div>
    </div>
@endsection