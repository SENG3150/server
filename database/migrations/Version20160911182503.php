<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20160911182503 extends AbstractMigration
{
	/**
	 * @param Schema $schema
	 */
	public function up(Schema $schema)
	{
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
		
		$this->addSql('SET FOREIGN_KEY_CHECKS=0');
		
		$this->addSql(file_get_contents(database_path('sql/insert.sql')));
		
		$this->addSql('SET FOREIGN_KEY_CHECKS=1');
	}
	
	/**
	 * @param Schema $schema
	 */
	public function down(Schema $schema)
	{
		$this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
		
		$this->addSql('SET FOREIGN_KEY_CHECKS=0');
		
		$this->addSql('TRUNCATE `action_items`');
		$this->addSql('TRUNCATE `administrators`');
		$this->addSql('TRUNCATE `comments`');
		$this->addSql('TRUNCATE `domain_experts`');
		$this->addSql('TRUNCATE `downtime_data`');
		$this->addSql('TRUNCATE `inspections`');
		$this->addSql('TRUNCATE `inspection_major_assemblies`');
		$this->addSql('TRUNCATE `inspection_schedules`');
		$this->addSql('TRUNCATE `inspection_sub_assemblies`');
		$this->addSql('TRUNCATE `machines`');
		$this->addSql('TRUNCATE `major_assemblies`');
		$this->addSql('TRUNCATE `models`');
		$this->addSql('TRUNCATE `photos`');
		$this->addSql('TRUNCATE `sub_assemblies`');
		$this->addSql('TRUNCATE `technicians`');
		$this->addSql('TRUNCATE `tests_machine_general`');
		$this->addSql('TRUNCATE `tests_oil`');
		$this->addSql('TRUNCATE `tests_wear`');
		$this->addSql('ALTER TABLE `action_items` auto_increment = 1');
		$this->addSql('ALTER TABLE `administrators` auto_increment = 1');
		$this->addSql('ALTER TABLE `comments` auto_increment = 1');
		$this->addSql('ALTER TABLE `domain_experts` auto_increment = 1');
		$this->addSql('ALTER TABLE `downtime_data` auto_increment = 1');
		$this->addSql('ALTER TABLE `inspections` auto_increment = 1');
		$this->addSql('ALTER TABLE `inspection_major_assemblies` auto_increment = 1');
		$this->addSql('ALTER TABLE `inspection_schedules` auto_increment = 1');
		$this->addSql('ALTER TABLE `inspection_sub_assemblies` auto_increment = 1');
		$this->addSql('ALTER TABLE `machines` auto_increment = 1');
		$this->addSql('ALTER TABLE `major_assemblies` auto_increment = 1');
		$this->addSql('ALTER TABLE `models` auto_increment = 1');
		$this->addSql('ALTER TABLE `photos` auto_increment = 1');
		$this->addSql('ALTER TABLE `sub_assemblies` auto_increment = 1');
		$this->addSql('ALTER TABLE `technicians` auto_increment = 1');
		$this->addSql('ALTER TABLE `tests_machine_general` auto_increment = 1');
		$this->addSql('ALTER TABLE `tests_oil` auto_increment = 1');
		$this->addSql('ALTER TABLE `tests_wear` auto_increment = 1');
		
		$this->addSql('SET FOREIGN_KEY_CHECKS=1');
	}
}
