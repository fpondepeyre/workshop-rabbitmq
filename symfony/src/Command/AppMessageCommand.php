<?php

namespace App\Command;

use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class AppMessageCommand
 */
class AppMessageCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'app:message';

    /**
     * AppPublishMessageCommand constructor.
     *
     * @param ProducerInterface $producer
     */
    public function __construct(ProducerInterface $producer)
    {
        parent::__construct();

        $this->producer = $producer;
    }

    protected function configure()
    {
        $this
            ->setDescription('Publish message to rabbitmq')
            ->addArgument('messages', InputArgument::OPTIONAL, 'Total message to publish', 10000)
            ->addOption('invalid', 'i', InputOption::VALUE_NONE, 'Create invalid message ')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $messages = $input->getArgument('messages');
        $invalid = $input->getOption('invalid');

        for ($i = 0; $i < $messages; $i++) {
            $key = ($invalid) ? 'invalid_message' : 'message';
            $this->producer->publish(json_encode([$key => uniqid()]));
        }

        $io->success('Publish done !');
    }
}
