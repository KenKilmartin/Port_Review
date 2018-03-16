<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180316205231 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6A33D40DB');
        $this->addSql('DROP INDEX IDX_794381C6A33D40DB ON review');
        $this->addSql('ALTER TABLE review ADD port_review VARCHAR(255) NOT NULL, DROP port_name_id');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE review ADD port_name_id INT DEFAULT NULL, DROP port_review');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6A33D40DB FOREIGN KEY (port_name_id) REFERENCES port (id)');
        $this->addSql('CREATE INDEX IDX_794381C6A33D40DB ON review (port_name_id)');
    }
}
