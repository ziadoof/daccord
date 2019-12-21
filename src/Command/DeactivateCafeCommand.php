<?php


namespace App\Command;

use App\Repository\Cafe\CafeRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\JobQueueBundle\Entity\Job;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class DeactivateCafeCommand  extends Command
{

    private $em;
    private $cafeRepository;

    public function __construct(EntityManagerInterface $entityManager, CafeRepository $cafeRepository)
    {
        $this->em = $entityManager;
        $this->cafeRepository = $cafeRepository;

        parent::__construct();
    }
    protected function configure()
    {
        $this
            ->setName('app:deactivate-cafe')
            ->setDescription('Start deactivate cafe')
            ->addArgument('cafeId', InputArgument::REQUIRED, 'The cafe id.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id =$input->getArgument('cafeId');
        $cafe = $this->cafeRepository->findOneById($id);
        if($cafe->getActive()){
            $cafe->setActive(false);
            $this->em->persist($cafe);
            $this->em->flush();
            $output->writeln([
                'Cafe deleted successfully',
            ]);
            return 0;
        }
        $output->writeln([
            'Cafe deleted by user',
        ]);
        return 0;
    }

    /**
     * @inheritDoc
     */
    public function createCronJob(\DateTime $lastRunAt): Job
    {
        return new Job('app:deactivate-cafe');
    }

    /**
     * @inheritDoc
     */
    public function shouldBeScheduled(\DateTime $lastRunAt): bool
    {
        return time() - $lastRunAt->getTimestamp() >= 60; // Executed at most every minute.
    }
}
