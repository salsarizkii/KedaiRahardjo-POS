<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Menu Minuman</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 text-gray-800 pb-20 overflow-hidden">

<div class="fixed inset-0 m-auto max-w-md w-full bg-white min-h-screen shadow-md relative" x-data="menuData()" x-init="init()">
  
  <!-- Header -->
  <div class="flex justify-between items-center p-4 border-b">
    <button onclick="window.history.back()">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
    </button>
    <h1 class="text-lg font-semibold">Minuman</h1>
    <button>
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
  </div>

  <!-- Search -->
  <div class="px-4 pt-3">
    <div class="relative">
      <input type="text" placeholder="Cari Menu" class="w-full border border-gray-300 rounded-md px-4 py-2 pl-10 text-sm focus:outline-none focus:ring-2 focus:ring-red-500" />
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 absolute top-3 left-3 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
      </svg>
    </div>
  </div>

  <!-- Menu List -->
  <div class="overflow-y-auto px-4 pt-4 pb-28 max-h-[calc(100vh-160px)]">
    <div class="grid grid-cols-2 gap-4">
      <template x-for="item in menu" :key="item.id">
        <div class="bg-white rounded-xl shadow-sm overflow-hidden flex flex-col">
          <img :src="item.gambar" alt="" class="w-full h-24 object-cover">
          <div class="p-2 flex-1">
            <p class="text-xs text-gray-500">Minuman</p>
            <h3 class="font-semibold text-sm leading-tight" x-text="item.nama"></h3>
            <p class="text-sm font-semibold text-gray-700 mt-1" x-text="`Rp ${item.harga.toLocaleString()}`"></p>
          </div>
          <div class="flex items-center justify-center gap-3 pb-2">
            <button @click="kurang(item.id)" class="bg-red-500 text-white px-2 rounded-md text-sm font-bold">-</button>
            <span class="text-sm font-medium" x-text="cart[item.id] || 0"></span>
            <button @click="tambah(item.id)" class="bg-red-500 text-white px-2 rounded-md text-sm font-bold">+</button>
          </div>
        </div>
      </template>
    </div>
  </div>

  <!-- Bottom Cart -->
  <div class="absolute bottom-0 left-0 right-0 max-w-md w-full bg-white border-t border-gray-200 px-4 py-3 flex justify-between items-center shadow-inner">
    <div class="bg-gray-100 px-4 py-1 rounded-full text-red-600 font-bold" x-text="totalQty()"></div>
    <button @click="showCart = true" class="bg-red-500 text-white px-6 py-2 rounded-lg font-semibold text-sm w-full ml-3">Lihat Keranjang</button>
  </div>

  <!-- Modal Cart -->
  <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center" x-show="showCart" x-transition>
    <div class="bg-white w-11/12 max-w-md rounded-lg shadow-lg p-4 relative max-h-[90vh] overflow-y-auto">
      <button @click="showCart = false" class="absolute top-2 right-3 text-gray-500 hover:text-black text-xl">&times;</button>
      <h2 class="text-lg font-semibold mb-4">Keranjang Saya</h2>

      <template x-for="item in menu.filter(m => cart[m.id])" :key="item.id">
        <div class="flex justify-between items-center mb-3 border-b pb-2">
          <div>
            <h3 class="font-semibold text-sm" x-text="item.nama"></h3>
            <p class="text-sm text-gray-600" x-text="`Rp ${item.harga.toLocaleString()} x ${cart[item.id]}`"></p>
          </div>
          <div class="flex items-center gap-2">
            <button @click="kurang(item.id)" class="px-2 py-1 text-sm bg-gray-200 rounded">-</button>
            <span class="text-sm font-medium" x-text="cart[item.id]"></span>
            <button @click="tambah(item.id)" class="px-2 py-1 text-sm bg-gray-200 rounded">+</button>
          </div>
        </div>
      </template>

      <div class="mt-4 font-semibold text-right">
        Total: Rp <span x-text="totalHarga().toLocaleString()"></span>
      </div>

      <div class="mt-4">
        <button @click="checkout()" class="bg-green-500 text-white px-4 py-2 rounded-lg w-full">Checkout</button>
      </div>
    </div>
  </div>
</div>

<!-- Alpine Script -->
<script>
  function menuData() {
    return {
      menu: [
        { id: 1, nama: 'Acai Bowl', harga: 35000, gambar: 'https://source.unsplash.com/400x300/?fruit,bowl' },
        { id: 2, nama: 'Burger', harga: 25000, gambar: 'https://source.unsplash.com/400x300/?burger' },
        { id: 3, nama: 'Aglio e Olio', harga: 45000, gambar: 'https://source.unsplash.com/400x300/?pasta' },
        { id: 4, nama: 'Dimsum Kuah', harga: 20000, gambar: 'https://source.unsplash.com/400x300/?dimsum' },
        { id: 5, nama: 'Sate Ayam', harga: 30000, gambar: 'https://source.unsplash.com/400x300/?sate' },
        { id: 6, nama: 'Nasi Goreng', harga: 28000, gambar: 'https://source.unsplash.com/400x300/?friedrice' }
      ],
      cart: {},
      showCart: false,

      init() {
        // bisa ditambah load dari localStorage di sini
      },
      tambah(id) {
        this.cart[id] = (this.cart[id] || 0) + 1;
      },
      kurang(id) {
        if (this.cart[id]) this.cart[id] = Math.max(this.cart[id] - 1, 0);
      },
      totalQty() {
        return Object.values(this.cart).reduce((a, b) => a + b, 0);
      },
      totalHarga() {
        return this.menu.reduce((total, item) => {
          return total + (this.cart[item.id] || 0) * item.harga;
        }, 0);
      },
      checkout() {
        alert('Checkout berhasil! Total: Rp ' + this.totalHarga().toLocaleString());
        this.cart = {};
        this.showCart = false;
      }
    }
  }
</script>

</body>
</html>
