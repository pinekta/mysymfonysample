<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150908205026 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $sql[] = <<<SQL
CREATE TABLE IF NOT EXISTS "article" (
    "id"             SERIAL       NOT NULL,
    "title"          VARCHAR(128) NOT NULL,
    "description"    VARCHAR(256) NOT NULL,
    "url"            VARCHAR(512) NOT NULL,
    "thumbnail_path" VARCHAR(256) NULL CONSTRAINT unique_article_thumbnail_path UNIQUE,
    "created_at"     TIMESTAMP with time zone  NOT NULL DEFAULT NOW(),
    "updated_at"     TIMESTAMP with time zone  NOT NULL DEFAULT NOW(),
    PRIMARY KEY ("id")
);
SQL;
        $sql[] = <<<SQL
CREATE TABLE IF NOT EXISTS "category" (
    "id"             SERIAL       NOT NULL,
    "category_code"  VARCHAR(64)  NOT NULL CONSTRAINT unique_category_category_code UNIQUE,
    "name"           VARCHAR(128) NOT NULL,
    "created_at"     TIMESTAMP with time zone  NOT NULL DEFAULT NOW(),
    "updated_at"     TIMESTAMP with time zone  NOT NULL DEFAULT NOW(),
    PRIMARY KEY ("id")
);
SQL;
        $sql[] = <<<SQL
CREATE TABLE IF NOT EXISTS "article_category" (
    "id"             SERIAL       NOT NULL,
    "article_id"    INTEGER      NOT NULL CONSTRAINT foreign_article_category_article_id REFERENCES article ("id") ON DELETE CASCADE,
    "category_id"    INTEGER      NOT NULL CONSTRAINT foreign_article_category_category_id REFERENCES category ("id") ON DELETE CASCADE,
    "created_at"     TIMESTAMP with time zone  NOT NULL DEFAULT NOW(),
    "updated_at"     TIMESTAMP with time zone  NOT NULL DEFAULT NOW(),
    PRIMARY KEY ("id")
);
SQL;

        // index
        $sql[] = <<<SQL
-- 大文字小文字を区別しない
CREATE INDEX "idx_article_title" ON "article" (LOWER("title"));
SQL;
        $sql[] = <<<SQL
CREATE INDEX "idx_article_created_at" ON "article" ("created_at");
SQL;
        $sql[] = <<<SQL
CREATE INDEX "idx_article_category_article_id" ON "article_category" ("article_id");
SQL;
        $sql[] = <<<SQL
CREATE INDEX "idx_article_category_category_id" ON "article_category" ("category_id");
SQL;

        $this->addSql($sql);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $sql[] = 'DROP TABLE IF EXISTS "article_category";';
        $sql[] = 'DROP TABLE IF EXISTS "category";';
        $sql[] = 'DROP TABLE IF EXISTS "article";';
        $this->addSql($sql);
    }
}
