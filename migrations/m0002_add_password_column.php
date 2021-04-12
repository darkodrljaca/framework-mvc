<?php

class m0002_add_password_column {
    
    public function up() {
        
        $db = \app\machina\Application::$app->db;
        $SQL = "ALTER TABLE users ADD COLUMN password VARCHAR(255) NOT NULL;";
        $db->pdo->exec($SQL);
        
    }
    
    public function down() {
        
        $db = \app\machina\Application::$app->db;
        $SQL = "ALTER TABLE users DROP column password;";
        $db->pdo->exec($SQL);
        
    }
    
}
