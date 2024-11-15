<?php

namespace Nekolympus\Project\core;

class QueryBuilder
{
    protected $db;
    protected $table;
    protected $columns = ['*'];
    protected $joins = [];
    protected $conditions = [];
    protected $bindings = [];
    protected $limit;

    public function __construct(\PDO $db, $table)
    {
        $this->db = $db;
        $this->table = $table;
    }

    public function select(array $columns)
    {
        $this->columns = $columns;
        return $this;
    }

    public function join($table, $firstColumn, $operator = '=', $secondColumn = null, $type = 'INNER')
    {
        if (is_null($secondColumn)) {
            $secondColumn = $operator;
            $operator = '=';
        }

        $this->joins[] = "$type JOIN $table ON $firstColumn $operator $secondColumn";
        return $this;
    }

    public function where($column, $operator, $value)
    {
        $param = str_replace('.', '_', $column); // unique parameter key
        $this->conditions[] = "$column $operator :$param";
        $this->bindings[":$param"] = $value;
        return $this;
    }

    public function get()
    {
        $query = $this->buildQuery();
        $stmt = $this->db->prepare($query);

        foreach ($this->bindings as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function first()
    {
        $this->limit(1);
        $results = $this->get();
        return $results ? $results[0] : null;
    }

    private function buildQuery()
    {
        $columns = implode(', ', $this->columns);
        $query = "SELECT $columns FROM {$this->table}";

        if ($this->joins) {
            $query .= ' ' . implode(' ', $this->joins);
        }

        if ($this->conditions) {
            $query .= ' WHERE ' . implode(' AND ', $this->conditions);
        }

        if ($this->limit) {
            $query .= " LIMIT {$this->limit}";
        }

        return $query;
    }

    public function limit($count)
    {
        $this->limit = $count;
        return $this;
    }
}