<?php


namespace app\machina\db;

use app\machina\Model;
use app\machina\Application;

/**
 * Description of DbModel
 *
 * @author darko
 */
abstract class DbModel extends Model {        
        
    public function rules(): array {
        
    }
    
    abstract public static function tableName(): string;
    
    abstract public function attributes(): array;
    
    abstract public static function primaryKey(): string; 
        
    
    public function save() {   
                
        $tableName = $this->tableName();        
        $attributes = $this->attributes(); 
         // adding created_at field into array:
//        array_splice($attributes, 3, 0, "status");              
//        array_splice($attributes, 4, 0, "created_at");
        
        $params = array_map(fn($attr) => ":$attr", $attributes);
               
        $statement = self::prepare("INSERT INTO $tableName (". implode(',', $attributes) .") "
                . "VALUES (". implode(',', $params) .")");
        
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});

        }                        
        
        $statement->execute();
        return true;
    }
    
    public static function findOne($where) {
        // tableName is abstract method, 'static' corespond to actual class on which 
        // the 'findOne()' will be called. We called 'findOne()' in User class.
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(fn($attr) =>"$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }                
        
        $statement->execute();
        return $statement->fetchObject(static::class);
    }
    
    public static function prepare($sql) {
        return Application::$app->db->pdo->prepare($sql);
    }

}
