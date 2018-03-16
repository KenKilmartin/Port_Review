<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180316203825 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, port_name_id INT DEFAULT NULL, review VARCHAR(255) NOT NULL, place_of_purchase VARCHAR(255) NOT NULL, price_paid DOUBLE PRECISION NOT NULL, num_of_stars INT NOT NULL, user VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_794381C6A33D40DB (port_name_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6A33D40DB FOREIGN KEY (port_name_id) REFERENCES port (id)');
        $this->addSql('ALTER TABLE port ADD ingredients VARCHAR(255) NOT NULL, DROP port_name, DROP ingrediants');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE review');
        $this->addSql('ALTER TABLE port ADD ingrediants VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE ingredients port_name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
