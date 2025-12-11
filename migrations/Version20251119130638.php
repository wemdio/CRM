<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251119130638 extends AbstractMigration
{
    public function up(Schema $schema): void
{
    // Удаляем только столбец ststus
    $this->addSql('ALTER TABLE project DROP ststus');
}

public function down(Schema $schema): void
{
    // Возвращаем столбец ststus
    $this->addSql('ALTER TABLE project ADD ststus VARCHAR(255)');
}
}
