@component('mail::message')
# Konfirmasi Reservasi

Halo, **{{ $pesanan->nama_pemesan }}**!

Reservasi Anda di **Aurevia Hotel** telah kami terima dan sedang diproses.

---

@component('mail::table')
| Detail | Informasi |
|:-------|:----------|
| Kamar | {{ $pesanan->kamar->nama_kamar }} |
| Tamu | {{ $pesanan->nama_tamu }} |
| Check-in | {{ \Carbon\Carbon::parse($pesanan->cek_in)->format('d M Y') }} |
| Check-out | {{ \Carbon\Carbon::parse($pesanan->cek_out)->format('d M Y') }} |
| Jumlah Kamar | {{ $pesanan->jml_kamar }} kamar |
| Total Estimasi | Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }} |
| Status | Pending – menunggu konfirmasi |
@endcomponent

Tim kami akan menghubungi Anda melalui nomor **{{ $pesanan->hp_pemesan }}** untuk konfirmasi lebih lanjut.

@component('mail::button', ['url' => config('app.url'), 'color' => 'dark'])
Kembali ke Website
@endcomponent

Terima kasih telah memilih Aurevia Hotel.

Salam hangat,
**Aurevia Hotel**
@endcomponent