<?php

namespace Database\Factories;
// database/factories/ShareFactory.php

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Share;

class ShareFactory extends Factory
{
    protected $model = Share::class;

    public function definition()
    {
        return [
            'share' => $this->faker->randomElement(['my_library', 'company_library', 'social_library']),
            // 다른 필드도 필요에 따라 추가할 수 있습니다.
        ];
    }
}
