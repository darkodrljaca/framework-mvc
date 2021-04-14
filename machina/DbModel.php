<?php


namespace app\machina;

/**
 * Description of DbModel
 *
 * @author darko
 */
abstract class DbModel extends Model {        
        
    public function rules(): array {
        
    }
    
    abstract public function tableName(): string;
    
    abstract public function attributes(): array;
    
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
    
    public static function prepare($sql) {
        return Application::$app->db->pdo->prepare($sql);
    }

}
