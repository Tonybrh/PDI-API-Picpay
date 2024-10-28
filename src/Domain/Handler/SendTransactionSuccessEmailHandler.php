<?php

namespace App\Domain\Handler;

use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
class SendTransactionSuccessEmailHandler
{
    public function __construct(
        private readonly MailerInterface $mailer
    ) {
    }

    public function __invoke($message)
    {
        $email = (new Email())
            ->from('pdi@example.com')
            ->to("antoniodias1106@gmail.com")
            ->text("Lindo demais");

        try {
            $this->mailer->send($email);
        } catch (TransportException $e) {
            // do something
        }
    }
}