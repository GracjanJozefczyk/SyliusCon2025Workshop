<?php

declare(strict_types=1);

namespace App\Cli;

use App\Entity\Brand\BrandInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Resource\Factory\FactoryInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:test', description: 'Sylius Resource')]
final class TestCommand extends Command
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
        $brand = $this->brandRepository->findOneBy(['code' => 'yamaha']);
        if (!$brand instanceof BrandInterface) {
            $brand = $this->brandFactory->createNew();
            $brand->setCode('yamaha');
            $brand->setName('Yamaha');
            $this->brandManager->persist($brand);
            $this->brandManager->flush();
            $output->writeln('Brand created');
        } else {
            $output->writeln('Brand already exists');
        }

        return Command::SUCCESS;
    }
}
