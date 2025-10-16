<?php

declare(strict_types=1);

namespace App\Cli;

use App\Entity\Brand\BrandInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Resource\Doctrine\Persistence\RepositoryInterface;
use Sylius\Resource\Factory\FactoryInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:test', description: 'Test Sylius Resource')]
class TestCommand extends Command
{
    public function __construct(
        private RepositoryInterface $brandRepository,
        private FactoryInterface $brandFactory,
        private EntityManagerInterface $brandManager,
    ) {
        parent::__construct('app:test');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $brand = $this->brandRepository->findOneBy(['code' => 'adidas']);
        if (!$brand instanceof BrandInterface) {
            $brand = $this->brandFactory->createNew();
            $brand->setCode('adidas');
            $brand->setName('Adidas');
            $this->brandManager->persist($brand);
            $this->brandManager->flush();
            $output->writeln('Brand created: ' . $brand->getName());
        } else {
            $output->writeln('Brand found: ' . $brand->getName());
        }

        return Command::SUCCESS;
    }
}
