<?php

namespace App\Domain\Handler;

use App\Domain\Message\SendTransactionSuccessEmail;
use Exception;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
readonly class SendTransactionSuccessEmailHandler
{
    public function __construct(
        private MailerInterface $mailer
    ) {
    }

    /**
     * @throws Exception|TransportExceptionInterface
     */
    public function __invoke(SendTransactionSuccessEmail $message): void
    {
        $email = (new Email())
            ->from('pdi@example.com')
            ->to("antoniodias1106@gmail.com")
            ->text("Transação realizada com sucesso!!");

        try {
            $this->mailer->send($email);
        } catch (TransportException $e) {
            dump($e->getMessage());
            exit();

            throw new Exception("Erro ao enviar email");
        }
    }
}