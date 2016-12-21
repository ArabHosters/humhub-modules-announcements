<?php

class m150429_151121_init extends EDbMigration {

    public function up() {
        // Schema for table 'announcement'
        $this->createTable("announcement", array(
            "id" => "int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
            "title" => "varchar(100) NOT NULL",
            "content" => "text NOT NULL",
            "alert_after_date" => "date",
            "alert_before_date" => "date",
            "expire" => "date",
            "team_id" => "int(11) NOT NULL",
            "department_id" => "int(11) NOT NULL",
            "priority" => "int(11) NOT NULL",
            "type" => "int(11) NOT NULL DEFAULT '1'",
            "assigned_to" => "int(11) NOT NULL",
            "assigner_id" => "int(11) NOT NULL",
                ), $options);


        // Schema for table 'announcement_reads'
        $this->createTable("announcement_reads", array(
            "id" => "int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
            "user_id" => "int(11) NOT NULL",
            "announcement_id" => "int(11) NOT NULL",
            "readed" => "tinyint(4) NOT NULL",
                ), $options);


        // Schema for table 'announcement_types'
        $this->createTable("announcement_types", array(
            "id" => "int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT",
            "title" => "varchar(100) NOT NULL",
            "priority" => "int(11) NOT NULL",
                ), $options);
    }

    public function down() {
        echo "m150429_151121_init does not support migration down.\n";
        return false;
    }
}
