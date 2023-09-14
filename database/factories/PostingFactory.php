<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posting>
 */
class PostingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'title' => 'Aku Pergi',
            'content' => '<p> Sepi dan sangat sunyi. Senyuman itu sudah tidak lagi sama seperti terakhir bertemu. Dingin, kehangatan itu telah hilang sejak lama. Tajam, rasaku seperti ingin diterkam kesunyian diri. Aku kira sudah akan datang, dia yang membawa kencana hitam dari sana tidak kunjung datang juga. Terlintas apakah lebih baik aku yang kesana daripada harus menunggu kepastian yang tidak kunjung datang. Sebenarnya aku lebih suka ditemani mentari dibading rembulan, kalaupun terbakar maka itu akan lebih baik karena aku menyatu dengan kebahagiaan dibanding terlena dalam pelukan hangat yang sebenarnya semu. Datang dan pergi silih berganti. Mata ku hilang tak tau arah, kaki ku pun melarkan diri. Tersisa tangan yang masih setia dan kupukir akan mengelap tangis ku...atau setidaknya memberi belaian hangat. Tetapi yang itu malah membenturkan kepalaku ke dinding, sebuah dinding misterius yang dari tadi memanggil namaku.</p>',
            'cover' => 'lost_home.jpg',
            'status' => true,
            'like' => 30,
            'see' => 80 
        ];
    }
}
