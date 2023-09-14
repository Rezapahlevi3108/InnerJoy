@extends('posting.layout.main')

@section('contents')
    <div class="container my-5">
        <div class="row">
            {{-- <h3>halaman posting</h3> --}}

        </div>
        <div class="row">
            <div class="col-md-9">
                <h3 class="text-center font-fredoka">Yang Terdalam</h3>
                <br />
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-start gap-3">
                        <div>
                            <i class="fa-solid fa-eye"></i>
                            <span class="font-size-12">200</span>
                        </div>
                        <div>
                            <i class="fa-solid fa-heart" style="color: #e64c4c;"></i>
                            <span class="font-size-12">35</span>
                        </div>
                    </div>
                    <span>12 September 2023</span>
                </div>
                <br>
                <img src="{{ asset('assets/user/img/cover.jpg') }}" class="img-fluid" style="object-fit: cover;height:400px;width:100%;" alt="cover-img">
                <br>
                <p class="mt-5">
                    Sepi dan sangat sunyi. Senyuman itu sudah tidak lagi sama seperti terakhir bertemu. Dingin, kehangatan itu telah hilang sejak lama. Tajam, rasaku seperti ingin diterkam kesunyian diri. Aku kira sudah akan datang, dia yang membawa kencana hitam dari sana tidak kunjung datang juga. Terlintas apakah lebih baik aku yang kesana daripada harus menunggu kepastian yang tidak kunjung datang. Sebenarnya aku lebih suka ditemani mentari dibading rembulan, kalaupun terbakar maka itu akan lebih baik karena aku menyatu dengan kebahagiaan dibanding terlena dalam pelukan hangat yang sebenarnya semu. Datang dan pergi silih berganti. Mata ku hilang tak tau arah, kaki ku pun melarkan diri. Tersisa tangan yang masih setia dan kupukir akan mengelap tangis ku...atau setidaknya memberi belaian hangat. Tetapi yang itu malah membenturkan kepalaku ke dinding, sebuah dinding misterius yang dari tadi memanggil namaku.
                </p>
                <p class="mt-5">
                    Sepi dan sangat sunyi. Senyuman itu sudah tidak lagi sama seperti terakhir bertemu. Dingin, kehangatan itu telah hilang sejak lama. Tajam, rasaku seperti ingin diterkam kesunyian diri. Aku kira sudah akan datang, dia yang membawa kencana hitam dari sana tidak kunjung datang juga. Terlintas apakah lebih baik aku yang kesana daripada harus menunggu kepastian yang tidak kunjung datang. Sebenarnya aku lebih suka ditemani mentari dibading rembulan, kalaupun terbakar maka itu akan lebih baik karena aku menyatu dengan kebahagiaan dibanding terlena dalam pelukan hangat yang sebenarnya semu. Datang dan pergi silih berganti. Mata ku hilang tak tau arah, kaki ku pun melarkan diri. Tersisa tangan yang masih setia dan kupukir akan mengelap tangis ku...atau setidaknya memberi belaian hangat. Tetapi yang itu malah membenturkan kepalaku ke dinding, sebuah dinding misterius yang dari tadi memanggil namaku.
                </p>
                <p class="mt-5">
                    Sepi dan sangat sunyi. Senyuman itu sudah tidak lagi sama seperti terakhir bertemu. Dingin, kehangatan itu telah hilang sejak lama. Tajam, rasaku seperti ingin diterkam kesunyian diri. Aku kira sudah akan datang, dia yang membawa kencana hitam dari sana tidak kunjung datang juga. Terlintas apakah lebih baik aku yang kesana daripada harus menunggu kepastian yang tidak kunjung datang. Sebenarnya aku lebih suka ditemani mentari dibading rembulan, kalaupun terbakar maka itu akan lebih baik karena aku menyatu dengan kebahagiaan dibanding terlena dalam pelukan hangat yang sebenarnya semu. Datang dan pergi silih berganti. Mata ku hilang tak tau arah, kaki ku pun melarkan diri. Tersisa tangan yang masih setia dan kupukir akan mengelap tangis ku...atau setidaknya memberi belaian hangat. Tetapi yang itu malah membenturkan kepalaku ke dinding, sebuah dinding misterius yang dari tadi memanggil namaku.
                </p>
                <div id="disqus_thread"></div>
            </div>
            <div class="col-md-3 border-start py-5 text-center">
                <img src="{{ asset('assets/admin/img/profile.svg') }}" class="rounded-circle" height="120" width="120"
                    alt="profile-img">
                <p class="font-fredoka font-size-18">Nisrina Pahlevi</p>
                <p class="text-center font-size-14">
                    Salam kenal semua, saya adalah seorang Pekerja Malam di Jakarta. Saya
                    menderita bipolar sejak kecil dan sampai saat ini masih brejuang untuk bisa berdamai dengan diri saya
                </p>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://innerjoy.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
@endpush
