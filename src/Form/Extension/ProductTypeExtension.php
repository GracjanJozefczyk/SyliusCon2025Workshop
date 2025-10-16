<?php

declare(strict_types=1);

namespace App\Form\Extension;

use App\Entity\Brand\Brand;
use Sylius\Bundle\AdminBundle\Form\Type\ProductType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('brand', EntityType::class, [
            'class' => Brand::class,
            'choice_label' => 'name',
            'label' => 'sylius.form.product.brand',
            'placeholder' => 'sylius.form.product.select_brand',
        ]);
    }

    public static function getExtendedTypes(): iterable
    {
        return [
            ProductType::class,
        ];
    }
}
