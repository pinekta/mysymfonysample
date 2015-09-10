<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150910220608 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $sql[] = <<<SQL
ALTER TABLE "category"
    ADD COLUMN "prefecture" VARCHAR(2) NULL,
    ADD COLUMN "sex" INTEGER NULL,
    ADD COLUMN "enabled" INTEGER NOT NULL DEFAULT 1;
SQL;

        $this->addSql($sql);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $sql[] = <<<SQL
ALTER TABLE "category"
    DROP COLUMN "prefecture",
    DROP COLUMN "sex",
    DROP COLUMN "enabled";
SQL;

        $this->addSql($sql);
    }
}
