<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241025192829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('UPDATE public."user" SET nu_seq_user_type = 1 WHERE nu_seq_user_type IS NULL');

        $this->addSql('ALTER TABLE public."user" DROP CONSTRAINT IF EXISTS FK_327C5DE761167FDF');
        $this->addSql('DROP TABLE IF EXISTS public.user_type');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE public.notification_nu_seq_notification_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.transaction_nu_seq_transaction_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.user_nu_seq_user_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.wallet_nu_seq_wallet_seq CASCADE');
        $this->addSql('CREATE SEQUENCE notification_nu_seq_notification_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE transaction_nu_seq_transaction_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_nu_seq_user_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_type_nu_seq_user_type_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE wallet_nu_seq_wallet_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE wallet (nu_seq_wallet INT NOT NULL, nu_seq_user BIGINT DEFAULT NULL, balance NUMERIC(10, 2) NOT NULL, PRIMARY KEY(nu_seq_wallet))');
        $this->addSql('CREATE UNIQUE INDEX uniq_3686e63ff915b6b3 ON wallet (nu_seq_user)');
        $this->addSql('CREATE TABLE transaction (nu_seq_transaction INT NOT NULL, valor NUMERIC(10, 2) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, status VARCHAR(20) NOT NULL, nu_seq_user_sender INT NOT NULL, nu_seq_user_receiver INT NOT NULL, PRIMARY KEY(nu_seq_transaction))');
        $this->addSql('CREATE TABLE notification (nu_seq_notification INT NOT NULL, nu_seq_user BIGINT DEFAULT NULL, nu_seq_transaction INT DEFAULT NULL, status VARCHAR(50) NOT NULL, message VARCHAR(255) NOT NULL, PRIMARY KEY(nu_seq_notification))');
        $this->addSql('CREATE INDEX idx_ff070bee60361de5 ON notification (nu_seq_transaction)');
        $this->addSql('CREATE INDEX idx_ff070beef915b6b3 ON notification (nu_seq_user)');
        $this->addSql('CREATE TABLE "user" (nu_seq_user BIGINT NOT NULL, nu_seq_wallet INT DEFAULT NULL, nu_seq_user_type INT NOT NULL, ds_name VARCHAR(255) NOT NULL, co_cpf_cnpj VARCHAR(20) NOT NULL, co_email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, json_roles JSON NOT NULL, PRIMARY KEY(nu_seq_user))');
        $this->addSql('CREATE INDEX idx_327c5de761167fdf ON "user" (nu_seq_user_type)');
        $this->addSql('CREATE UNIQUE INDEX uniq_327c5de7df898ef6 ON "user" (nu_seq_wallet)');
        $this->addSql('CREATE UNIQUE INDEX uniq_327c5de79ad07576 ON "user" (co_email)');
        $this->addSql('CREATE UNIQUE INDEX uniq_327c5de710d61cd6 ON "user" (co_cpf_cnpj)');
        $this->addSql('CREATE TABLE user_type (nu_seq_user_type INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(nu_seq_user_type))');
        $this->addSql('CREATE UNIQUE INDEX uniq_c2f32ec75e237e06 ON user_type (name)');
        $this->addSql('ALTER TABLE wallet ADD CONSTRAINT fk_3686e63ff915b6b3 FOREIGN KEY (nu_seq_user) REFERENCES "user" (nu_seq_user) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT fk_ff070beef915b6b3 FOREIGN KEY (nu_seq_user) REFERENCES "user" (nu_seq_user) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT fk_ff070bee60361de5 FOREIGN KEY (nu_seq_transaction) REFERENCES transaction (nu_seq_transaction) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT fk_327c5de7df898ef6 FOREIGN KEY (nu_seq_wallet) REFERENCES wallet (nu_seq_wallet) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT fk_327c5de761167fdf FOREIGN KEY (nu_seq_user_type) REFERENCES user_type (nu_seq_user_type) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE public.notification DROP CONSTRAINT FK_FF070BEEF915B6B3');
        $this->addSql('ALTER TABLE public.notification DROP CONSTRAINT FK_FF070BEE60361DE5');
        $this->addSql('ALTER TABLE public."user" DROP CONSTRAINT FK_327C5DE7DF898EF6');
        $this->addSql('ALTER TABLE public.wallet DROP CONSTRAINT FK_3686E63FF915B6B3');
        $this->addSql('DROP TABLE public.notification');
        $this->addSql('DROP TABLE public.transaction');
        $this->addSql('DROP TABLE public."user"');
        $this->addSql('DROP TABLE public.wallet');
    }
}
