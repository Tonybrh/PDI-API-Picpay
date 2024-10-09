<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241007203345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wallet DROP CONSTRAINT fk_7c68921ff915b6b3');
        $this->addSql('ALTER TABLE transaction DROP CONSTRAINT fk_723705d1285349c6');
        $this->addSql('ALTER TABLE transaction DROP CONSTRAINT fk_723705d175731136');
        $this->addSql('ALTER TABLE notification DROP CONSTRAINT fk_bf5476caf915b6b3');
        $this->addSql('DROP SEQUENCE user_nu_seq_user_seq CASCADE');
        $this->addSql('CREATE SEQUENCE public.user_nu_seq_user_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE public."user" (nu_seq_user BIGINT NOT NULL, nu_seq_user_type INT NOT NULL, ds_name VARCHAR(255) NOT NULL, co_cpf_cnpj VARCHAR(20) NOT NULL, co_email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(nu_seq_user))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_327C5DE710D61CD6 ON public."user" (co_cpf_cnpj)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_327C5DE79AD07576 ON public."user" (co_email)');
        $this->addSql('CREATE INDEX IDX_327C5DE761167FDF ON public."user" (nu_seq_user_type)');
        $this->addSql('ALTER TABLE public."user" ADD CONSTRAINT FK_327C5DE761167FDF FOREIGN KEY (nu_seq_user_type) REFERENCES user_type (nu_seq_user_type) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT fk_8d93d64961167fdf');
        $this->addSql('DROP TABLE "user"');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE notification DROP CONSTRAINT FK_BF5476CAF915B6B3');
        $this->addSql('ALTER TABLE transaction DROP CONSTRAINT FK_723705D1285349C6');
        $this->addSql('ALTER TABLE transaction DROP CONSTRAINT FK_723705D175731136');
        $this->addSql('ALTER TABLE wallet DROP CONSTRAINT FK_7C68921FF915B6B3');
        $this->addSql('DROP SEQUENCE public.user_nu_seq_user_seq CASCADE');
        $this->addSql('CREATE SEQUENCE user_nu_seq_user_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (nu_seq_user BIGINT NOT NULL, nu_seq_user_type INT NOT NULL, ds_name VARCHAR(255) NOT NULL, co_cpf_cnpj VARCHAR(20) NOT NULL, co_email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(nu_seq_user))');
        $this->addSql('CREATE INDEX idx_8d93d64961167fdf ON "user" (nu_seq_user_type)');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d6499ad07576 ON "user" (co_email)');
        $this->addSql('CREATE UNIQUE INDEX uniq_8d93d64910d61cd6 ON "user" (co_cpf_cnpj)');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT fk_8d93d64961167fdf FOREIGN KEY (nu_seq_user_type) REFERENCES user_type (nu_seq_user_type) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE public."user" DROP CONSTRAINT FK_327C5DE761167FDF');
        $this->addSql('DROP TABLE public."user"');
    }
}
