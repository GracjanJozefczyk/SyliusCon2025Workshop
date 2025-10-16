<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Brand\Brand;
use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository as BaseProductRepository;

final class ProductRepository extends BaseProductRepository
{
    public function findBrandedProducts(Brand $brand): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.brand = :brand')
            ->setParameter('brand', $brand)
            ->getQuery()
            ->getResult()
        ;
    }
}
