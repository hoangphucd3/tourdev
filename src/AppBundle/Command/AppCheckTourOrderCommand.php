<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;

class AppCheckTourOrderCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:check-tour-order')
            ->setDescription('Check Tour Orders')
            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
//        $argument = $input->getArgument('argument');
        $progress = new ProgressBar($output);

        $progress->setFormat('debug_nomax');

        $progress->start();

        if ($input->getOption('option')) {
            // ...
        }

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $tourOrders = $em->getRepository('AppBundle:TourOrder')->findAll();

        foreach ($tourOrders as $tourOrder) {
            $orderTime = $tourOrder->getCreatedAt()->modify('+24 hours');
            $now = new \DateTime();

            $tourOrder->setStatus('pending');
            $tourOrder->setUpdatedAt(new \DateTime());

            $em->flush();

            $progress->advance();
        }

        $progress->finish();

//        $output->writeln('Success');
    }

}
