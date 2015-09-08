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
CREATE TABLE IF NOT EXISTS "articles" (
    "id"             SERIAL       NOT NULL,
    "title"          VARCHAR(128) NOT NULL,
    "description"    VARCHAR(256) NOT NULL,
    "url"            VARCHAR(512) NOT NULL,
    "thumbnail_path" VARCHAR(256) NULL CONSTRAINT unique_articles_thumbnail_path UNIQUE,
    "created_at"     TIMESTAMP with time zone  NOT NULL DEFAULT NOW(),
    "updated_at"     TIMESTAMP with time zone  NOT NULL DEFAULT NOW(),
    PRIMARY KEY ("id")
);
SQL;
        $sql[] = <<<SQL
CREATE TABLE IF NOT EXISTS "categories" (
    "id"             SERIAL       NOT NULL,
    "category_code"  VARCHAR(64)  NOT NULL CONSTRAINT unique_categories_category_code UNIQUE,
    "name"           VARCHAR(128) NOT NULL,
    "created_at"     TIMESTAMP with time zone  NOT NULL DEFAULT NOW(),
    "updated_at"     TIMESTAMP with time zone  NOT NULL DEFAULT NOW(),
    PRIMARY KEY ("id")
);
SQL;
        $sql[] = <<<SQL
CREATE TABLE IF NOT EXISTS "article_categories" (
    "id"             SERIAL       NOT NULL,
    "article_id"    INTEGER      NOT NULL CONSTRAINT foreign_article_categories_article_id REFERENCES articles ("id") ON DELETE CASCADE,
    "category_id"    INTEGER      NOT NULL CONSTRAINT foreign_article_categories_category_id REFERENCES categories ("id") ON DELETE CASCADE,
    "created_at"     TIMESTAMP with time zone  NOT NULL DEFAULT NOW(),
    "updated_at"     TIMESTAMP with time zone  NOT NULL DEFAULT NOW(),
    PRIMARY KEY ("id")
);
SQL;

        // index
        $sql[] = <<<SQL
-- 大文字小文字を区別しない
CREATE INDEX "idx_articles_title" ON "articles" (LOWER("title"));
SQL;
        $sql[] = <<<SQL
CREATE INDEX "idx_articles_created_at" ON "articles" ("created_at");
SQL;
        $sql[] = <<<SQL
CREATE INDEX "idx_article_categories_article_id" ON "article_categories" ("article_id");
SQL;
        $sql[] = <<<SQL
CREATE INDEX "idx_article_categories_category_id" ON "article_categories" ("category_id");
SQL;

        $this->addSql($sql);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $sql[] = 'DROP TABLE IF EXISTS "article_categories";';
        $sql[] = 'DROP TABLE IF EXISTS "categories";';
        $sql[] = 'DROP TABLE IF EXISTS "articles";';
        $this->addSql($sql);
    }
}
