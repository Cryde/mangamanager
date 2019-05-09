<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190509060904 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX u_user_tome ON user_tome');
        $this->addSql('ALTER TABLE user_tome ADD book_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_tome ADD CONSTRAINT FK_1198A83E16A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('CREATE INDEX IDX_1198A83E16A2B381 ON user_tome (book_id)');
        $this->addSql('CREATE UNIQUE INDEX u_user_tome_book ON user_tome (user_id, tome_id, book_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_tome DROP FOREIGN KEY FK_1198A83E16A2B381');
        $this->addSql('DROP INDEX IDX_1198A83E16A2B381 ON user_tome');
        $this->addSql('DROP INDEX u_user_tome_book ON user_tome');
        $this->addSql('ALTER TABLE user_tome DROP book_id');
        $this->addSql('CREATE UNIQUE INDEX u_user_tome ON user_tome (user_id, tome_id)');
    }
}
