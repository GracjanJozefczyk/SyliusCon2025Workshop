<?php

declare(strict_types=1);

namespace App\SM;

interface BrandStates
{
    public const STATE_NEW = 'new';

    public const STATE_APPROVED = 'approved';

    public const STATE_REJECTED = 'rejected';

    public const STATE_SUSPENDED = 'suspended';
}
