@extends('layouts.app')

@section('title', 'Layar Kasir - POS Es Teh')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900">Transaksi Kasir</h2>
    <p class="text-sm text-slate-500">Pilih menu minuman di sebelah kiri untuk menambahkan ke pesanan.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

    <section class="lg:col-span-7 space-y-4">
        <div class="bg-white border border-slate-200 rounded-xl p-4">
            <input type="text" id="inputCari" onkeyup="filterMenu()"
                   placeholder="Cari nama minuman..."
                   class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:outline-none focus:border-emerald-600">
        </div>

        <div id="daftarMenu" class="grid grid-cols-2 sm:grid-cols-3 gap-3.5">
            @if(isset($menus) && $menus->count() > 0)
                @foreach($menus as $menu)
                    @php
                        $idMenu = $menu->id_menu ?? $menu->id;
                    @endphp
                    <div onclick="tambahPesanan({{ $idMenu }}, '{{ addslashes($menu->nama_menu) }}', {{ $menu->harga }})"
                         data-nama="{{ strtolower($menu->nama_menu) }}"
                         class="kartu-menu bg-white border border-slate-200 hover:border-emerald-500 rounded-xl p-4 cursor-pointer transition flex flex-col justify-between">
                        <div>
                            <span class="inline-block text-[11px] font-medium px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 mb-2 capitalize">
                                {{ $menu->status_menu ?? 'Tersedia' }}
                            </span>
                            <h3 class="font-semibold text-slate-900 text-sm">{{ $menu->nama_menu }}</h3>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                            <span class="font-bold text-emerald-700 text-sm">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                            <span class="text-xs font-semibold text-slate-400">+ Pilih</span>
                        </div>
                    </div>
                @endforeach
            @else
                <div onclick="tambahPesanan(1, 'Es Teh Original', 5000)"
                     data-nama="es teh original"
                     class="kartu-menu bg-white border border-slate-200 hover:border-emerald-500 rounded-xl p-4 cursor-pointer transition flex flex-col justify-between">
                    <div>
                        <span class="inline-block text-[11px] font-medium px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 mb-2">Tersedia</span>
                        <h3 class="font-semibold text-slate-900 text-sm">Es Teh Original</h3>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                        <span class="font-bold text-emerald-700 text-sm">Rp 5.000</span>
                        <span class="text-xs font-semibold text-slate-400">+ Pilih</span>
                    </div>
                </div>

                <div onclick="tambahPesanan(2, 'Es Teh Lemon', 8000)"
                     data-nama="es teh lemon"
                     class="kartu-menu bg-white border border-slate-200 hover:border-emerald-500 rounded-xl p-4 cursor-pointer transition flex flex-col justify-between">
                    <div>
                        <span class="inline-block text-[11px] font-medium px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 mb-2">Tersedia</span>
                        <h3 class="font-semibold text-slate-900 text-sm">Es Teh Lemon</h3>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                        <span class="font-bold text-emerald-700 text-sm">Rp 8.000</span>
                        <span class="text-xs font-semibold text-slate-400">+ Pilih</span>
                    </div>
                </div>

                <div onclick="tambahPesanan(3, 'Es Teh Leci', 9000)"
                     data-nama="es teh leci"
                     class="kartu-menu bg-white border border-slate-200 hover:border-emerald-500 rounded-xl p-4 cursor-pointer transition flex flex-col justify-between">
                    <div>
                        <span class="inline-block text-[11px] font-medium px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 mb-2">Tersedia</span>
                        <h3 class="font-semibold text-slate-900 text-sm">Es Teh Leci</h3>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                        <span class="font-bold text-emerald-700 text-sm">Rp 9.000</span>
                        <span class="text-xs font-semibold text-slate-400">+ Pilih</span>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section class="lg:col-span-5 bg-white border border-slate-200 rounded-xl p-5 sticky top-6">
        <div class="flex items-center justify-between pb-3 border-b border-slate-200">
            <h3 class="font-bold text-slate-900 text-base">Detail Pesanan</h3>
            <button type="button" onclick="resetKeranjang()" class="text-xs text-red-600 hover:underline font-medium">
                Kosongkan
            </button>
        </div>

        <form action="{{ url('/kasir/bayar') }}" method="POST" class="mt-4 space-y-4">
            @csrf

            <div>
                <label for="nama_pelanggan" class="block text-xs font-medium text-slate-600 mb-1">
                    Nama Pelanggan (Opsional)
                </label>
                <input type="text" id="nama_pelanggan" name="nama_pelanggan"
                       placeholder="Pelanggan Umum"
                       class="w-full px-3 py-2 rounded-lg border border-slate-300 text-sm focus:outline-none focus:border-emerald-600">
            </div>

            <div class="border border-slate-200 rounded-lg overflow-hidden">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-slate-600 text-xs border-b border-slate-200">
                        <tr>
                            <th class="py-2.5 px-3 font-semibold">Menu</th>
                            <th class="py-2.5 px-2 font-semibold text-center">Qty</th>
                            <th class="py-2.5 px-3 font-semibold text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="tabelKeranjang" class="divide-y divide-slate-100">
                        <tr>
                            <td colspan="3" class="py-8 text-center text-xs text-slate-400">
                                Belum ada minuman yang dipilih.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1.5">Metode Pembayaran</label>
                <div class="grid grid-cols-2 gap-2 text-sm">
                    <label class="flex items-center justify-center gap-2 border border-slate-300 rounded-lg py-2 cursor-pointer has-[:checked]:border-emerald-600 has-[:checked]:bg-emerald-50 has-[:checked]:text-emerald-700 font-medium">
                        <input type="radio" name="metode_pembayaran" value="Tunai" checked class="accent-emerald-600">
                        <span>Tunai</span>
                    </label>
                    <label class="flex items-center justify-center gap-2 border border-slate-300 rounded-lg py-2 cursor-pointer has-[:checked]:border-emerald-600 has-[:checked]:bg-emerald-50 has-[:checked]:text-emerald-700 font-medium">
                        <input type="radio" name="metode_pembayaran" value="QRIS" class="accent-emerald-600">
                        <span>QRIS</span>
                    </label>
                </div>
            </div>

            <div class="bg-slate-50 border border-slate-200 rounded-lg p-4 space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-slate-600">Total Bayar</span>
                    <span id="tampilTotal" class="text-xl font-bold text-slate-900">Rp 0</span>
                </div>

                <div>
                    <label for="uangBayar" class="block text-xs font-medium text-slate-600 mb-1">Uang Diterima (Rp)</label>
                    <input type="number" id="uangBayar" name="uang_bayar" oninput="hitungKembalian()"
                           placeholder="0"
                           class="w-full px-3 py-2 rounded-lg bg-white border border-slate-300 text-sm font-semibold focus:outline-none focus:border-emerald-600">
                    <div class="grid grid-cols-4 gap-1.5 mt-2">
                        <button type="button" onclick="isiUangPas()" class="py-1.5 text-xs font-medium bg-white border border-slate-300 rounded-lg hover:bg-slate-100 text-slate-700">Uang Pas</button>
                        <button type="button" onclick="isiNominal(10000)" class="py-1.5 text-xs font-medium bg-white border border-slate-300 rounded-lg hover:bg-slate-100 text-slate-700">10.000</button>
                        <button type="button" onclick="isiNominal(20000)" class="py-1.5 text-xs font-medium bg-white border border-slate-300 rounded-lg hover:bg-slate-100 text-slate-700">20.000</button>
                        <button type="button" onclick="isiNominal(50000)" class="py-1.5 text-xs font-medium bg-white border border-slate-300 rounded-lg hover:bg-slate-100 text-slate-700">50.000</button>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-2 border-t border-slate-200">
                    <span class="text-sm font-medium text-slate-600">Kembalian</span>
                    <span id="tampilKembalian" class="text-base font-bold text-emerald-700">Rp 0</span>
                </div>
            </div>

            <input type="hidden" name="keranjang_json" id="keranjangJson">

            <button type="submit"
                    class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm rounded-xl transition cursor-pointer">
                Proses &amp; Cetak Struk
            </button>
        </form>
    </section>

</div>

<script>
    let keranjang = [];
    let totalHarga = 0;

    function formatRupiah(angka) {
        return 'Rp ' + angka.toLocaleString('id-ID');
    }

    function tambahPesanan(id, nama, harga) {
        let itemAda = keranjang.find(item => item.id === id);

        if (itemAda) {
            itemAda.qty += 1;
        } else {
            keranjang.push({ id: id, nama: nama, harga: harga, qty: 1 });
        }
        renderKeranjang();
    }

    function ubahQty(index, perubahan) {
        keranjang[index].qty += perubahan;
        if (keranjang[index].qty <= 0) {
            keranjang.splice(index, 1);
        }
        renderKeranjang();
    }

    function resetKeranjang() {
        keranjang = [];
        document.getElementById('uangBayar').value = '';
        renderKeranjang();
    }

    function renderKeranjang() {
        const tbody = document.getElementById('tabelKeranjang');
        tbody.innerHTML = '';
        totalHarga = 0;

        if (keranjang.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="3" class="py-8 text-center text-xs text-slate-400">
                        Belum ada minuman yang dipilih.
                    </td>
                </tr>`;
            document.getElementById('tampilTotal').innerText = 'Rp 0';
            document.getElementById('keranjangJson').value = '';
            hitungKembalian();
            return;
        }

        keranjang.forEach((item, index) => {
            let subtotal = item.harga * item.qty;
            totalHarga += subtotal;

            tbody.innerHTML += `
                <tr>
                    <td class="py-2.5 px-3">
                        <p class="font-medium text-slate-800 text-xs">${item.nama}</p>
                        <p class="text-[11px] text-slate-500">${formatRupiah(item.harga)}</p>
                    </td>
                    <td class="py-2.5 px-2 text-center">
                        <div class="inline-flex items-center border border-slate-200 rounded">
                            <button type="button" onclick="ubahQty(${index}, -1)" class="px-2 py-0.5 text-slate-600 hover:bg-slate-100">-</button>
                            <span class="px-2 text-xs font-semibold">${item.qty}</span>
                            <button type="button" onclick="ubahQty(${index}, 1)" class="px-2 py-0.5 text-slate-600 hover:bg-slate-100">+</button>
                        </div>
                    </td>
                    <td class="py-2.5 px-3 text-right font-semibold text-xs text-slate-800">
                        ${formatRupiah(subtotal)}
                    </td>
                </tr>
            `;
        });

        document.getElementById('tampilTotal').innerText = formatRupiah(totalHarga);
        document.getElementById('keranjangJson').value = JSON.stringify(keranjang);
        hitungKembalian();
    }

    function hitungKembalian() {
        let bayar = parseInt(document.getElementById('uangBayar').value) || 0;
        let kembalian = bayar - totalHarga;
        const labelKembalian = document.getElementById('tampilKembalian');

        if (bayar === 0) {
            labelKembalian.innerText = 'Rp 0';
            labelKembalian.className = 'text-base font-bold text-emerald-700';
        } else if (kembalian < 0) {
            labelKembalian.innerText = 'Uang kurang ' + formatRupiah(Math.abs(kembalian));
            labelKembalian.className = 'text-sm font-bold text-red-600';
        } else {
            labelKembalian.innerText = formatRupiah(kembalian);
            labelKembalian.className = 'text-base font-bold text-emerald-700';
        }
    }

    function isiUangPas() {
        document.getElementById('uangBayar').value = totalHarga;
        hitungKembalian();
    }

    function isiNominal(nominal) {
        document.getElementById('uangBayar').value = nominal;
        hitungKembalian();
    }

    function filterMenu() {
        let kataKunci = document.getElementById('inputCari').value.toLowerCase();

        document.querySelectorAll('.kartu-menu').forEach(kartu => {
            let nama = kartu.getAttribute('data-nama');
            kartu.style.display = nama.includes(kataKunci) ? 'flex' : 'none';
        });
    }
</script>
@endsection