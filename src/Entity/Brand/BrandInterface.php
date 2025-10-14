<?php

declare(strict_types=1);

namespace App\Entity\Brand;

use Sylius\Resource\Model\CodeAwareInterface;
use Sylius\Resource\Model\ResourceInterface;

interface BrandInterface extends ResourceInterface, CodeAwareInterface
{
    public function getName(): ?string;

    public function setName(?string $name): void;
}
