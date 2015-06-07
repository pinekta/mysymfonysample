<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150603222910 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $sql[] = <<<SQL
-- -----------------------------------------------------
-- Table "test" 
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS "test" (
  "id"             SERIAL           NOT NULL,  -- ID
  "title"          VARCHAR(512)     NOT NULL,  -- 概要
  "url"            VARCHAR(512)         NULL,  -- リンクURL
  "created_at"     TIMESTAMP        NOT NULL,  -- 登録日時
  "updated_at"     TIMESTAMP        NOT NULL,  -- 最終更新日時
  PRIMARY KEY ("id")
);
SQL;

        $this->addSql($sql);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $sql[] = 'DROP TABLE "test";';
        $this->addSql($sql);
    }
}
