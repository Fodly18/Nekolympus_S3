<?php

namespace Nekolympus\Project\core;

use Nekolympus\Project\databases\Database;

class Model
{
    protected static $table;
    protected static $guarded = [];
    private static $db;

    public static function init()
    {
        if (is_null(self::$db)) {
            self::$db = (new Database())->getConnection();
        }
    }

    public static function all()
    {
        self::init();
        $stmt = self::$db->prepare("SELECT * FROM " . static::$table);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        

        return $data;   

    }

    public static function find($id)
    {
        self::init();
        $stmt = self::$db->prepare("SELECT * FROM " . static::$table . " WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        return new ResultSet([$result]); // Kembalikan sebagai ResultSet
    }

    public static function where($column, $operator, $value)
    {
        self::init();
        $stmt = self::$db->prepare("SELECT * FROM " . static::$table . " WHERE $column $operator :value");
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return new ResultSet($results); // Kembalikan sebagai ResultSet
    }



    public static function create(array $data)
    {
        self::init();
        $columns = implode(", ", array_keys($data));
        $placeholders = ':' . implode(", :", array_keys($data));
        
        $stmt = self::$db->prepare("INSERT INTO " . static::$table . " ($columns) VALUES ($placeholders)");
        
        foreach ($data as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }
        
        $stmt->execute();
        return self::$db->lastInsertId(); // Mengembalikan ID dari entri yang baru dibuat
    }

    public static function update($id, array $data)
    {
        self::init();
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ', '); // Menghapus koma terakhir

        $stmt = self::$db->prepare("UPDATE " . static::$table . " SET $set WHERE id = :id");
        $stmt->bindParam(':id', $id);
        
        foreach ($data as $key => &$value) {
            $stmt->bindParam(":$key", $value);
        }
        
        return $stmt->execute(); // Mengembalikan true jika berhasil
    }

    public static function delete($id)
    {
        self::init();
        $stmt = self::$db->prepare("DELETE FROM " . static::$table . " WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute(); // Mengembalikan true jika berhasil
    }
}