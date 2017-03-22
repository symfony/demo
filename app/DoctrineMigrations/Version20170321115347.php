<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Example of a database migration using the DoctrineMigrationsBundle.
 * Here we add a new column to the symfony_demo_user table to match the fullName User property.
 * Note that this migration has already been applied, use `php bin/console doctrine:migrations:status`
 * to see this by yourself.
 *
 * @see http://symfony.com/doc/master/bundles/DoctrineMigrationsBundle/index.html
 *
 * @author Arnaud PETITPAS <arnaudpetitpas@protonmail.ch>
 */
class Version20170321115347 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('ALTER TABLE symfony_demo_user ADD fullName VARCHAR(255) DEFAULT NULL');
        $this->addSql('UPDATE symfony_demo_user SET fullName = username');
        $this->addSql('ALTER TABLE symfony_demo_user CHANGE fullName fullName VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE symfony_demo_user DROP fullName');
    }
}
