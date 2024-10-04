<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static SYSTEM_ADMIN_USER()
 * @method static GROUP_ADMIN_USER()
 * @method static GENERAL_USER()
 */
final class Role extends Enum
{
    public const SYSTEM_ADMIN_USER = 0;
    public const GROUP_ADMIN_USER = 1;
    public const GENERAL_USER = 2;
}
