<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20160911180914 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE inspection_schedules (id INT AUTO_INCREMENT NOT NULL, inspection_id INT DEFAULT NULL, value INT NOT NULL, period VARCHAR(255) NOT NULL, time_deleted DATETIME DEFAULT NULL, deleted TINYINT(1) DEFAULT \'0\' NOT NULL, INDEX IDX_CD7145D6F02F2DDF (inspection_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inspections (id INT AUTO_INCREMENT NOT NULL, machine_id INT DEFAULT NULL, technician_id INT DEFAULT NULL, scheduler_id INT DEFAULT NULL, schedule_id INT DEFAULT NULL, time_created DATETIME DEFAULT NULL, time_scheduled DATETIME DEFAULT NULL, time_started DATETIME DEFAULT NULL, time_completed DATETIME DEFAULT NULL, time_deleted DATETIME DEFAULT NULL, deleted TINYINT(1) DEFAULT \'0\' NOT NULL, INDEX IDX_86254990F6B75B26 (machine_id), INDEX IDX_86254990E6C5D496 (technician_id), INDEX IDX_86254990A9D0F7D9 (scheduler_id), INDEX IDX_86254990A40BC2D5 (schedule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE machines (id INT AUTO_INCREMENT NOT NULL, model_id INT DEFAULT NULL, name LONGTEXT NOT NULL, time_deleted DATETIME DEFAULT NULL, deleted TINYINT(1) DEFAULT \'0\' NOT NULL, INDEX IDX_F1CE8DED7975B7E7 (model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technicians (id INT AUTO_INCREMENT NOT NULL, username LONGTEXT NOT NULL, first_name LONGTEXT NOT NULL, last_name LONGTEXT NOT NULL, email LONGTEXT NOT NULL, password LONGTEXT NOT NULL, temporary TINYINT(1) NOT NULL, login_expires_time DATETIME DEFAULT NULL, time_deleted DATETIME DEFAULT NULL, deleted TINYINT(1) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE domain_experts (id INT AUTO_INCREMENT NOT NULL, username LONGTEXT NOT NULL, first_name LONGTEXT NOT NULL, last_name LONGTEXT NOT NULL, email LONGTEXT NOT NULL, password LONGTEXT NOT NULL, time_deleted DATETIME DEFAULT NULL, deleted TINYINT(1) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inspection_major_assemblies (id INT AUTO_INCREMENT NOT NULL, inspection_id INT DEFAULT NULL, major_assembly_id INT DEFAULT NULL, INDEX IDX_3B3925CAF02F2DDF (inspection_id), INDEX IDX_3B3925CAF50BDA8F (major_assembly_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, inspection_id INT DEFAULT NULL, major_assembly_id INT DEFAULT NULL, sub_assembly_id INT DEFAULT NULL, machine_general_test_id INT DEFAULT NULL, oil_test_id INT DEFAULT NULL, wear_test_id INT DEFAULT NULL, technician_id INT DEFAULT NULL, domain_expert_id INT DEFAULT NULL, text LONGTEXT NOT NULL, time_commented DATETIME NOT NULL, INDEX IDX_5F9E962AF02F2DDF (inspection_id), INDEX IDX_5F9E962AF50BDA8F (major_assembly_id), INDEX IDX_5F9E962A2FD708D2 (sub_assembly_id), INDEX IDX_5F9E962A23774302 (machine_general_test_id), INDEX IDX_5F9E962A3039B455 (oil_test_id), INDEX IDX_5F9E962AE5C32A3E (wear_test_id), INDEX IDX_5F9E962AE6C5D496 (technician_id), INDEX IDX_5F9E962A23265EAA (domain_expert_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photos (id INT AUTO_INCREMENT NOT NULL, inspection_id INT DEFAULT NULL, major_assembly_id INT DEFAULT NULL, sub_assembly_id INT DEFAULT NULL, machine_general_test_id INT DEFAULT NULL, oil_test_id INT DEFAULT NULL, wear_test_id INT DEFAULT NULL, technician_id INT DEFAULT NULL, domain_expert_id INT DEFAULT NULL, text LONGTEXT DEFAULT NULL, format LONGTEXT NOT NULL, INDEX IDX_876E0D9F02F2DDF (inspection_id), INDEX IDX_876E0D9F50BDA8F (major_assembly_id), INDEX IDX_876E0D92FD708D2 (sub_assembly_id), INDEX IDX_876E0D923774302 (machine_general_test_id), INDEX IDX_876E0D93039B455 (oil_test_id), INDEX IDX_876E0D9E5C32A3E (wear_test_id), INDEX IDX_876E0D9E6C5D496 (technician_id), INDEX IDX_876E0D923265EAA (domain_expert_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE action_items (id INT AUTO_INCREMENT NOT NULL, machine_general_test_id INT DEFAULT NULL, oil_test_id INT DEFAULT NULL, wear_test_id INT DEFAULT NULL, technician_id INT DEFAULT NULL, status LONGTEXT NOT NULL, issue LONGTEXT DEFAULT NULL, action LONGTEXT DEFAULT NULL, time_actioned DATETIME NOT NULL, UNIQUE INDEX UNIQ_6D025F123774302 (machine_general_test_id), UNIQUE INDEX UNIQ_6D025F13039B455 (oil_test_id), UNIQUE INDEX UNIQ_6D025F1E5C32A3E (wear_test_id), INDEX IDX_6D025F1E6C5D496 (technician_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE administrators (id INT AUTO_INCREMENT NOT NULL, username LONGTEXT NOT NULL, first_name LONGTEXT NOT NULL, last_name LONGTEXT NOT NULL, email LONGTEXT NOT NULL, password LONGTEXT NOT NULL, time_deleted DATETIME DEFAULT NULL, deleted TINYINT(1) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE downtime_data (id INT AUTO_INCREMENT NOT NULL, machine_id INT DEFAULT NULL, systemName LONGTEXT NOT NULL, downTimeHours NUMERIC(10, 5) NOT NULL, reason LONGTEXT DEFAULT NULL, INDEX IDX_65889860F6B75B26 (machine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inspection_sub_assemblies (id INT AUTO_INCREMENT NOT NULL, inspection_id INT DEFAULT NULL, major_assembly_id INT DEFAULT NULL, sub_assembly_id INT DEFAULT NULL, INDEX IDX_7EDC2D8EF02F2DDF (inspection_id), INDEX IDX_7EDC2D8EF50BDA8F (major_assembly_id), INDEX IDX_7EDC2D8E2FD708D2 (sub_assembly_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tests_machine_general (id INT AUTO_INCREMENT NOT NULL, inspection_id INT DEFAULT NULL, sub_assembly_id INT DEFAULT NULL, INDEX IDX_8FE6092F02F2DDF (inspection_id), UNIQUE INDEX UNIQ_8FE60922FD708D2 (sub_assembly_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE major_assemblies (id INT AUTO_INCREMENT NOT NULL, model_id INT DEFAULT NULL, name LONGTEXT NOT NULL, time_deleted DATETIME DEFAULT NULL, deleted TINYINT(1) DEFAULT \'0\' NOT NULL, INDEX IDX_CF992C667975B7E7 (model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE models (id INT AUTO_INCREMENT NOT NULL, name LONGTEXT NOT NULL, time_deleted DATETIME DEFAULT NULL, deleted TINYINT(1) DEFAULT \'0\' NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tests_oil (id INT AUTO_INCREMENT NOT NULL, inspection_id INT DEFAULT NULL, sub_assembly_id INT DEFAULT NULL, lead INT NOT NULL, copper INT NOT NULL, tin INT NOT NULL, iron INT NOT NULL, pq90 INT NOT NULL, silicon INT NOT NULL, sodium INT NOT NULL, aluminium INT NOT NULL, water NUMERIC(10, 5) DEFAULT NULL, viscosity INT NOT NULL, INDEX IDX_D259A2F02F2DDF (inspection_id), UNIQUE INDEX UNIQ_D259A22FD708D2 (sub_assembly_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_assemblies (id INT AUTO_INCREMENT NOT NULL, major_assembly_id INT DEFAULT NULL, name LONGTEXT NOT NULL, machine_general TINYINT(1) NOT NULL, oil TINYINT(1) NOT NULL, wear TINYINT(1) NOT NULL, unique_details LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', time_deleted DATETIME DEFAULT NULL, deleted TINYINT(1) DEFAULT \'0\' NOT NULL, INDEX IDX_73F3A10DF50BDA8F (major_assembly_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tests_wear (id INT AUTO_INCREMENT NOT NULL, inspection_id INT DEFAULT NULL, sub_assembly_id INT DEFAULT NULL, smu INT NOT NULL, unique_details LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_7DC81759F02F2DDF (inspection_id), UNIQUE INDEX UNIQ_7DC817592FD708D2 (sub_assembly_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inspection_schedules ADD CONSTRAINT FK_CD7145D6F02F2DDF FOREIGN KEY (inspection_id) REFERENCES inspections (id)');
        $this->addSql('ALTER TABLE inspections ADD CONSTRAINT FK_86254990F6B75B26 FOREIGN KEY (machine_id) REFERENCES machines (id)');
        $this->addSql('ALTER TABLE inspections ADD CONSTRAINT FK_86254990E6C5D496 FOREIGN KEY (technician_id) REFERENCES technicians (id)');
        $this->addSql('ALTER TABLE inspections ADD CONSTRAINT FK_86254990A9D0F7D9 FOREIGN KEY (scheduler_id) REFERENCES domain_experts (id)');
        $this->addSql('ALTER TABLE inspections ADD CONSTRAINT FK_86254990A40BC2D5 FOREIGN KEY (schedule_id) REFERENCES inspection_schedules (id)');
        $this->addSql('ALTER TABLE machines ADD CONSTRAINT FK_F1CE8DED7975B7E7 FOREIGN KEY (model_id) REFERENCES models (id)');
        $this->addSql('ALTER TABLE inspection_major_assemblies ADD CONSTRAINT FK_3B3925CAF02F2DDF FOREIGN KEY (inspection_id) REFERENCES inspections (id)');
        $this->addSql('ALTER TABLE inspection_major_assemblies ADD CONSTRAINT FK_3B3925CAF50BDA8F FOREIGN KEY (major_assembly_id) REFERENCES major_assemblies (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AF02F2DDF FOREIGN KEY (inspection_id) REFERENCES inspections (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AF50BDA8F FOREIGN KEY (major_assembly_id) REFERENCES inspection_major_assemblies (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A2FD708D2 FOREIGN KEY (sub_assembly_id) REFERENCES inspection_sub_assemblies (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A23774302 FOREIGN KEY (machine_general_test_id) REFERENCES tests_machine_general (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A3039B455 FOREIGN KEY (oil_test_id) REFERENCES tests_oil (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AE5C32A3E FOREIGN KEY (wear_test_id) REFERENCES tests_wear (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AE6C5D496 FOREIGN KEY (technician_id) REFERENCES technicians (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A23265EAA FOREIGN KEY (domain_expert_id) REFERENCES domain_experts (id)');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D9F02F2DDF FOREIGN KEY (inspection_id) REFERENCES inspections (id)');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D9F50BDA8F FOREIGN KEY (major_assembly_id) REFERENCES inspection_major_assemblies (id)');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D92FD708D2 FOREIGN KEY (sub_assembly_id) REFERENCES inspection_sub_assemblies (id)');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D923774302 FOREIGN KEY (machine_general_test_id) REFERENCES tests_machine_general (id)');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D93039B455 FOREIGN KEY (oil_test_id) REFERENCES tests_oil (id)');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D9E5C32A3E FOREIGN KEY (wear_test_id) REFERENCES tests_wear (id)');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D9E6C5D496 FOREIGN KEY (technician_id) REFERENCES technicians (id)');
        $this->addSql('ALTER TABLE photos ADD CONSTRAINT FK_876E0D923265EAA FOREIGN KEY (domain_expert_id) REFERENCES domain_experts (id)');
        $this->addSql('ALTER TABLE action_items ADD CONSTRAINT FK_6D025F123774302 FOREIGN KEY (machine_general_test_id) REFERENCES tests_machine_general (id)');
        $this->addSql('ALTER TABLE action_items ADD CONSTRAINT FK_6D025F13039B455 FOREIGN KEY (oil_test_id) REFERENCES tests_oil (id)');
        $this->addSql('ALTER TABLE action_items ADD CONSTRAINT FK_6D025F1E5C32A3E FOREIGN KEY (wear_test_id) REFERENCES tests_wear (id)');
        $this->addSql('ALTER TABLE action_items ADD CONSTRAINT FK_6D025F1E6C5D496 FOREIGN KEY (technician_id) REFERENCES technicians (id)');
        $this->addSql('ALTER TABLE downtime_data ADD CONSTRAINT FK_65889860F6B75B26 FOREIGN KEY (machine_id) REFERENCES machines (id)');
        $this->addSql('ALTER TABLE inspection_sub_assemblies ADD CONSTRAINT FK_7EDC2D8EF02F2DDF FOREIGN KEY (inspection_id) REFERENCES inspections (id)');
        $this->addSql('ALTER TABLE inspection_sub_assemblies ADD CONSTRAINT FK_7EDC2D8EF50BDA8F FOREIGN KEY (major_assembly_id) REFERENCES inspection_major_assemblies (id)');
        $this->addSql('ALTER TABLE inspection_sub_assemblies ADD CONSTRAINT FK_7EDC2D8E2FD708D2 FOREIGN KEY (sub_assembly_id) REFERENCES sub_assemblies (id)');
        $this->addSql('ALTER TABLE tests_machine_general ADD CONSTRAINT FK_8FE6092F02F2DDF FOREIGN KEY (inspection_id) REFERENCES inspections (id)');
        $this->addSql('ALTER TABLE tests_machine_general ADD CONSTRAINT FK_8FE60922FD708D2 FOREIGN KEY (sub_assembly_id) REFERENCES inspection_sub_assemblies (id)');
        $this->addSql('ALTER TABLE major_assemblies ADD CONSTRAINT FK_CF992C667975B7E7 FOREIGN KEY (model_id) REFERENCES models (id)');
        $this->addSql('ALTER TABLE tests_oil ADD CONSTRAINT FK_D259A2F02F2DDF FOREIGN KEY (inspection_id) REFERENCES inspections (id)');
        $this->addSql('ALTER TABLE tests_oil ADD CONSTRAINT FK_D259A22FD708D2 FOREIGN KEY (sub_assembly_id) REFERENCES inspection_sub_assemblies (id)');
        $this->addSql('ALTER TABLE sub_assemblies ADD CONSTRAINT FK_73F3A10DF50BDA8F FOREIGN KEY (major_assembly_id) REFERENCES major_assemblies (id)');
        $this->addSql('ALTER TABLE tests_wear ADD CONSTRAINT FK_7DC81759F02F2DDF FOREIGN KEY (inspection_id) REFERENCES inspections (id)');
        $this->addSql('ALTER TABLE tests_wear ADD CONSTRAINT FK_7DC817592FD708D2 FOREIGN KEY (sub_assembly_id) REFERENCES inspection_sub_assemblies (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE inspections DROP FOREIGN KEY FK_86254990A40BC2D5');
        $this->addSql('ALTER TABLE inspection_schedules DROP FOREIGN KEY FK_CD7145D6F02F2DDF');
        $this->addSql('ALTER TABLE inspection_major_assemblies DROP FOREIGN KEY FK_3B3925CAF02F2DDF');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AF02F2DDF');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D9F02F2DDF');
        $this->addSql('ALTER TABLE inspection_sub_assemblies DROP FOREIGN KEY FK_7EDC2D8EF02F2DDF');
        $this->addSql('ALTER TABLE tests_machine_general DROP FOREIGN KEY FK_8FE6092F02F2DDF');
        $this->addSql('ALTER TABLE tests_oil DROP FOREIGN KEY FK_D259A2F02F2DDF');
        $this->addSql('ALTER TABLE tests_wear DROP FOREIGN KEY FK_7DC81759F02F2DDF');
        $this->addSql('ALTER TABLE inspections DROP FOREIGN KEY FK_86254990F6B75B26');
        $this->addSql('ALTER TABLE downtime_data DROP FOREIGN KEY FK_65889860F6B75B26');
        $this->addSql('ALTER TABLE inspections DROP FOREIGN KEY FK_86254990E6C5D496');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AE6C5D496');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D9E6C5D496');
        $this->addSql('ALTER TABLE action_items DROP FOREIGN KEY FK_6D025F1E6C5D496');
        $this->addSql('ALTER TABLE inspections DROP FOREIGN KEY FK_86254990A9D0F7D9');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A23265EAA');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D923265EAA');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AF50BDA8F');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D9F50BDA8F');
        $this->addSql('ALTER TABLE inspection_sub_assemblies DROP FOREIGN KEY FK_7EDC2D8EF50BDA8F');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A2FD708D2');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D92FD708D2');
        $this->addSql('ALTER TABLE tests_machine_general DROP FOREIGN KEY FK_8FE60922FD708D2');
        $this->addSql('ALTER TABLE tests_oil DROP FOREIGN KEY FK_D259A22FD708D2');
        $this->addSql('ALTER TABLE tests_wear DROP FOREIGN KEY FK_7DC817592FD708D2');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A23774302');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D923774302');
        $this->addSql('ALTER TABLE action_items DROP FOREIGN KEY FK_6D025F123774302');
        $this->addSql('ALTER TABLE inspection_major_assemblies DROP FOREIGN KEY FK_3B3925CAF50BDA8F');
        $this->addSql('ALTER TABLE sub_assemblies DROP FOREIGN KEY FK_73F3A10DF50BDA8F');
        $this->addSql('ALTER TABLE machines DROP FOREIGN KEY FK_F1CE8DED7975B7E7');
        $this->addSql('ALTER TABLE major_assemblies DROP FOREIGN KEY FK_CF992C667975B7E7');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A3039B455');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D93039B455');
        $this->addSql('ALTER TABLE action_items DROP FOREIGN KEY FK_6D025F13039B455');
        $this->addSql('ALTER TABLE inspection_sub_assemblies DROP FOREIGN KEY FK_7EDC2D8E2FD708D2');
        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962AE5C32A3E');
        $this->addSql('ALTER TABLE photos DROP FOREIGN KEY FK_876E0D9E5C32A3E');
        $this->addSql('ALTER TABLE action_items DROP FOREIGN KEY FK_6D025F1E5C32A3E');
        $this->addSql('DROP TABLE inspection_schedules');
        $this->addSql('DROP TABLE inspections');
        $this->addSql('DROP TABLE machines');
        $this->addSql('DROP TABLE technicians');
        $this->addSql('DROP TABLE domain_experts');
        $this->addSql('DROP TABLE inspection_major_assemblies');
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP TABLE photos');
        $this->addSql('DROP TABLE action_items');
        $this->addSql('DROP TABLE administrators');
        $this->addSql('DROP TABLE downtime_data');
        $this->addSql('DROP TABLE inspection_sub_assemblies');
        $this->addSql('DROP TABLE tests_machine_general');
        $this->addSql('DROP TABLE major_assemblies');
        $this->addSql('DROP TABLE models');
        $this->addSql('DROP TABLE tests_oil');
        $this->addSql('DROP TABLE sub_assemblies');
        $this->addSql('DROP TABLE tests_wear');
    }
}
