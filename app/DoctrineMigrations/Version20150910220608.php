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
ALTER TABLE "article"
    ADD COLUMN "type" INTEGER NULL,
    ADD COLUMN "commentable" INTEGER NULL,
    ADD COLUMN "display_ad" INTEGER NOT NULL DEFAULT 1;
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
ALTER TABLE "article"
    DROP COLUMN "type",
    DROP COLUMN "commentable",
    DROP COLUMN "display_ad";
SQL;

        $this->addSql($sql);
    }
}
