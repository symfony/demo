<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use App\Service\MigrationInitialImport;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\Type;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180412141456 extends AbstractMigration implements ContainerAwareInterface
{

    use ContainerAwareTrait;

    public function up(Schema $schema): void
    {
        $userTable = $schema->createTable('symfony_demo_user');
        self::createIdentifier($userTable);
        self::createVarchar($userTable, 'full_name');
        self::createVarchar($userTable, 'username');
        self::createVarchar($userTable, 'email');
        self::createVarchar($userTable, 'password');
        $userTable->addColumn('roles', Type::JSON);
        $userTable->addUniqueIndex(['username'], 'UNIQ_8FB094A1F85E0677');
        $userTable->addUniqueIndex(['email'], 'UNIQ_8FB094A1E7927C74');

        $tagTable = $schema->createTable('symfony_demo_tag');
        self::createIdentifier($tagTable);
        self::createVarchar($tagTable, 'name');
        $tagTable->addUniqueIndex(['name'], 'UNIQ_4D5855405E237E06');

        $postTable = $schema->createTable('symfony_demo_post');
        self::createIdentifier($postTable);
        self::createVarchar($postTable, 'title');
        self::createVarchar($postTable, 'slug');
        self::createVarchar($postTable, 'summary');
        $postTable->addColumn('content', Type::TEXT);
        $postTable->addColumn('published_at', Type::DATETIME);
        $postTable->addColumn('author_id', Type::INTEGER)->setNotnull(true);
        $postTable->addForeignKeyConstraint($userTable, ['author_id'], ['id'], [], 'FK_58A92E65F675F31B');

        $commentTable = $schema->createTable('symfony_demo_comment');
        self::createIdentifier($commentTable);
        $commentTable->addColumn('post_id', Type::INTEGER)->setNotnull(true);
        $commentTable->addColumn('author_id', Type::INTEGER)->setNotnull(true);
        $commentTable->addColumn('content', Type::TEXT)->setNotnull(true);
        $commentTable->addColumn('published_at', Type::DATETIME)->setNotnull(true);
        $commentTable->addForeignKeyConstraint($postTable, ['post_id'], ['id'], [], 'FK_53AD8F834B89032C');
        $commentTable->addForeignKeyConstraint($userTable, ['author_id'], ['id'], [], 'FK_53AD8F83F675F31B');

        $postTagTable = $schema->createTable('symfony_demo_post_tag');
        $postTagTable->addColumn('post_id', Type::INTEGER)->setNotnull(true);
        $postTagTable->addColumn('tag_id', Type::INTEGER)->setNotnull(true);
        $postTagTable->setPrimaryKey(['post_id', 'tag_id']);
        $postTagTable->addForeignKeyConstraint($postTable, ['post_id'], ['id'], ['onDelete' => 'CASCADE'], 'FK_6ABC1CC44B89032C');
        $postTagTable->addForeignKeyConstraint($tagTable, ['tag_id'], ['id'], ['onDelete' => 'CASCADE'], 'FK_6ABC1CC4BAD26311');
    }

    public function down(Schema $schema): void
    {
        $postTable = $schema->getTable('symfony_demo_post');
        $postTable->dropIndex('FK_58A92E65F675F31B');

        $commentTable = $schema->getTable('symfony_demo_comment');
        $commentTable->dropIndex('FK_53AD8F834B89032C');
        $commentTable->dropIndex('FK_53AD8F83F675F31B');

        $postTagTable = $schema->getTable('symfony_demo_post_tag');
        $postTagTable->dropIndex('FK_6ABC1CC44B89032C');
        $postTagTable->dropIndex('FK_6ABC1CC4BAD26311');

        $schema->dropTable('symfony_demo_user');
        $schema->dropTable('symfony_demo_tag');
        $schema->dropTable('symfony_demo_post');
        $schema->dropTable('symfony_demo_comment');
        $schema->dropTable('symfony_demo_post_tag');
    }

    public function postUp(Schema $schema): void
    {
        $this->container->get(MigrationInitialImport::class)->importInitialData();
    }

    private static function createVarchar(Table $table, string $field, int $length = 255, bool $notNull = true): void
    {
        $table
            ->addColumn($field, Type::STRING)
            ->setLength($length)
            ->setNotnull($notNull)
        ;
    }

    private static function createIdentifier(Table $table, string $fieldName = 'id', string $type = Type::INTEGER, int $length = 11): void
    {
        $table
            ->addColumn($fieldName, $type)
            ->setLength($length)
            ->setNotnull(true)
            ->setAutoincrement(true)
        ;
        $table->setPrimaryKey(['id']);
    }
}
