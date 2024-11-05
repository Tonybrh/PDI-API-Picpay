<?php

namespace App\Domain\Command;

use App\Domain\Handler\SendTransactionSuccessEmailHandler;
use App\Domain\Message\SendTransactionSuccessEmail;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

#[AsCommand(
    name: 'app:transaction:success',
    description: 'Send email to the user confirming the transaction',
)]
class SendTransactionSuccessEmailCommand extends Command
{
    public function __construct(
        private readonly SendTransactionSuccessEmailHandler $handler
    ) {
        parent::__construct();
    }

    #[\Override]
    protected function configure(): void
    {
        $this
            ->addOption('dry-run', null, InputOption::VALUE_NONE, 'Dry run')
        ;
    }

    /**
     * @throws TransportExceptionInterface
     */
    #[\Override]
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $message = new SendTransactionSuccessEmail('antoniodias1106@gmail.com');
        $this->handler->__invoke($message);

        $io->success('All emails was sent!');

        return Command::SUCCESS;
    }
}