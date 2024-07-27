<?php

namespace App\Enums\User;

use App\Enums\BaseEnum;

enum AccountTypeEnum: int
{
    case Customer = 1;
    case Admin = 2;
}
