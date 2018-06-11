<?php

namespace App\DataFixtures\ORM;

use Nelmio\Alice\Loader\NativeLoader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FixtureLoader extends Command
{    
    /**
     * @var EntityManagerInterface 
     */
    private $entityManager;
    
    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($name = null);
        
        $this->entityManager = $entityManager;
    }
    
    protected function configure()
    {
        $this->setName('fixtures:load')
            ->setDescription('Load fixtures in database.')
            ->setHelp('This command loads course fixtures in database');
    }    
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $loader = new NativeLoader();
        $courseSet = $loader->loadFile(__DIR__.'/fixtures.yml');        
        
        foreach($courseSet->getObjects() as $course) {
            $this->entityManager->persist($course);
        }
        
        $this->entityManager->flush();
    }
}