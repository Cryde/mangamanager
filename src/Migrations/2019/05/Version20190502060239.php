<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190502060239 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_book (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, book_id INT NOT NULL, creation_datetime DATETIME NOT NULL, INDEX IDX_B164EFF8A76ED395 (user_id), INDEX IDX_B164EFF816A2B381 (book_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tome (id INT AUTO_INCREMENT NOT NULL, book_id INT NOT NULL, number INT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, creation_datetime DATETIME NOT NULL, edition_datetime DATETIME DEFAULT NULL, publication_datetime DATETIME NOT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_6B19E4F716A2B381 (book_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_status (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, status_id INT NOT NULL, type_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, creation_datetime DATETIME NOT NULL, edition_datetime DATETIME DEFAULT NULL, publication_datetime DATETIME NOT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_CBE5A331989D9B62 (slug), INDEX IDX_CBE5A3316BF700BD (status_id), INDEX IDX_CBE5A331C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE map_book_author (book_id INT NOT NULL, book_author_id INT NOT NULL, INDEX IDX_73D5810716A2B381 (book_id), INDEX IDX_73D58107E4DBE55D (book_author_id), PRIMARY KEY(book_id, book_author_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_author (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, birth_date DATE DEFAULT NULL, biography LONGTEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_book ADD CONSTRAINT FK_B164EFF8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_book ADD CONSTRAINT FK_B164EFF816A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE tome ADD CONSTRAINT FK_6B19E4F716A2B381 FOREIGN KEY (book_id) REFERENCES book (id)');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3316BF700BD FOREIGN KEY (status_id) REFERENCES book_status (id)');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331C54C8C93 FOREIGN KEY (type_id) REFERENCES book_type (id)');
        $this->addSql('ALTER TABLE map_book_author ADD CONSTRAINT FK_73D5810716A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE map_book_author ADD CONSTRAINT FK_73D58107E4DBE55D FOREIGN KEY (book_author_id) REFERENCES book_author (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_book DROP FOREIGN KEY FK_B164EFF8A76ED395');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331C54C8C93');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3316BF700BD');
        $this->addSql('ALTER TABLE user_book DROP FOREIGN KEY FK_B164EFF816A2B381');
        $this->addSql('ALTER TABLE tome DROP FOREIGN KEY FK_6B19E4F716A2B381');
        $this->addSql('ALTER TABLE map_book_author DROP FOREIGN KEY FK_73D5810716A2B381');
        $this->addSql('ALTER TABLE map_book_author DROP FOREIGN KEY FK_73D58107E4DBE55D');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_book');
        $this->addSql('DROP TABLE tome');
        $this->addSql('DROP TABLE book_type');
        $this->addSql('DROP TABLE book_status');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE map_book_author');
        $this->addSql('DROP TABLE book_author');
    }
}
