<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241116101043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE option_vehicle (option_id INT NOT NULL, vehicle_id INT NOT NULL, INDEX IDX_374F3F3A7C41D6F (option_id), INDEX IDX_374F3F3545317D1 (vehicle_id), PRIMARY KEY(option_id, vehicle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE option_vehicle ADD CONSTRAINT FK_374F3F3A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE option_vehicle ADD CONSTRAINT FK_374F3F3545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model ADD brand_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_D79572D944F5D008 ON model (brand_id)');
        $this->addSql('ALTER TABLE reservation ADD customer_id INT DEFAULT NULL, ADD state_id INT NOT NULL, ADD vehicle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849555D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('CREATE INDEX IDX_42C849559395C3F3 ON reservation (customer_id)');
        $this->addSql('CREATE INDEX IDX_42C849555D83CC1 ON reservation (state_id)');
        $this->addSql('CREATE INDEX IDX_42C84955545317D1 ON reservation (vehicle_id)');
        $this->addSql('ALTER TABLE vehicle ADD type_id INT DEFAULT NULL, ADD model_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E486C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E4867975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('CREATE INDEX IDX_1B80E486C54C8C93 ON vehicle (type_id)');
        $this->addSql('CREATE INDEX IDX_1B80E4867975B7E7 ON vehicle (model_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE option_vehicle DROP FOREIGN KEY FK_374F3F3A7C41D6F');
        $this->addSql('ALTER TABLE option_vehicle DROP FOREIGN KEY FK_374F3F3545317D1');
        $this->addSql('DROP TABLE option_vehicle');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559395C3F3');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849555D83CC1');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955545317D1');
        $this->addSql('DROP INDEX IDX_42C849559395C3F3 ON reservation');
        $this->addSql('DROP INDEX IDX_42C849555D83CC1 ON reservation');
        $this->addSql('DROP INDEX IDX_42C84955545317D1 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP customer_id, DROP state_id, DROP vehicle_id');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E486C54C8C93');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E4867975B7E7');
        $this->addSql('DROP INDEX IDX_1B80E486C54C8C93 ON vehicle');
        $this->addSql('DROP INDEX IDX_1B80E4867975B7E7 ON vehicle');
        $this->addSql('ALTER TABLE vehicle DROP type_id, DROP model_id');
        $this->addSql('ALTER TABLE model DROP FOREIGN KEY FK_D79572D944F5D008');
        $this->addSql('DROP INDEX IDX_D79572D944F5D008 ON model');
        $this->addSql('ALTER TABLE model DROP brand_id');
    }
}
