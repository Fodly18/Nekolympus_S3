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
        
        return new ResultSet($data); // Kembalikan sebagai ResultSet
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

    public static function join(array $joins, array $conditions = [], array $columns = ['*'], $type = 'INNER')
    {
        self::init();

        $baseTable = static::$table;
        
        // Pilih kolom yang ingin ditampilkan
        $columnsList = implode(', ', $columns);
        $query = "SELECT $columnsList FROM $baseTable";

        // Proses Join
        foreach ($joins as $join) {
            if (!isset($join['table'], $join['baseColumn'], $join['joinColumn'])) {
                throw new \Exception("Join array must contain 'table', 'baseColumn', and 'joinColumn' keys.");
            }

            $joinTable = $join['table'];
            $baseColumn = $join['baseColumn'];
            $joinColumn = $join['joinColumn'];
            
            // Menyusun query join
            $query .= " $type JOIN $joinTable ON $baseTable.$baseColumn = $joinTable.$joinColumn";
        }

        // Proses Where Clause
        if (!empty($conditions)) {
            $query .= " WHERE ";
            $clauses = [];
            foreach ($conditions as $column => $value) {
                $clauses[] = "$column = :$column";
            }
            $query .= implode(' AND ', $clauses);
        }

        $stmt = self::$db->prepare($query);

        // Bind nilai untuk kondisi
        foreach ($conditions as $column => $value) {
            $stmt->bindValue(":$column", $value);
        }

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $results; // Mengembalikan hasil sebagai array biasa
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