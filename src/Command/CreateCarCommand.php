<?php

namespace App\Command;

use App\Entity\Car;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-car';
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->setName(self::$defaultName); 
    }

    protected function configure()
    {
        $this
            ->setDescription('Creates a new car.')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the car.')
            ->addArgument('price', InputArgument::REQUIRED, 'The price of the car.')
            ->addArgument('description', InputArgument::REQUIRED, 'The description of the car.')
            ->addArgument('kilometrage', InputArgument::REQUIRED, 'The kilometrage of the car.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $price = $input->getArgument('price');
        $description = $input->getArgument('description');
        $kilometrage = $input->getArgument('kilometrage');

        $car = new Car();
        $car->setName($name);
        $car->setPrice($price);
        $car->setDescription($description);
        $car->setKilometrage($kilometrage);

        $this->entityManager->persist($car);
        $this->entityManager->flush();

        $output->writeln('Car created successfully!');

        return Command::SUCCESS;
    }
}