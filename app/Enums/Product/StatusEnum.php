<?php

namespace App\Enums\Product;

use App\Enums\BaseEnum;



enum StatusEnum: int
{
    use BaseEnum;
    case Published = 1;
    case Drafted = 2;

    public function badgesArray(): array
    {
        return [
            self::Published->value => ['class' => 'badge-success', 'name' => __('main.published')],
            self::Drafted->value => ['class' => 'badge-secondary', 'name' => __('main.drafted')],
        ];

    }
}
