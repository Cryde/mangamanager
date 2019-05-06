<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190506055656 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_tome (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, tome_id INT NOT NULL, creation_datetime DATETIME NOT NULL, INDEX IDX_1198A83EA76ED395 (user_id), INDEX IDX_1198A83E88B33E26 (tome_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_tome ADD CONSTRAINT FK_1198A83EA76ED395 FOREIGN KEY (user_id) REFERENCES tome (id)');
        $this->addSql('ALTER TABLE user_tome ADD CONSTRAINT FK_1198A83E88B33E26 FOREIGN KEY (tome_id) REFERENCES tome (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_tome');
    }
}
