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
    protected $groupBy;
    protected $orderBy = [];

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

    public function buildQuery()
    {
        $columns = implode(', ', $this->columns);
        $query = "SELECT $columns FROM {$this->table}";

        if ($this->joins) {
            $query .= ' ' . implode(' ', $this->joins);
        }

        if ($this->conditions) {
            $query .= ' WHERE ' . implode(' AND ', $this->conditions);
        }


        if (isset($this->groupBy)) {
            $query .= " GROUP BY {$this->groupBy}";

        if ($this->orderBy) {
            $query .= ' ORDER BY ' . implode(', ', $this->orderBy);
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

    public function paginate($perPage = 15, $page = 1)
    {
        $offset = ($page - 1) * $perPage;
        $this->limit = "$offset, $perPage"; // Gunakan offset untuk pagination

        $query = $this->buildQuery();
        $stmt = $this->db->prepare($query);

        foreach ($this->bindings as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Hitung total records
        $countQuery = "SELECT COUNT(*) as total FROM {$this->table}";
        if ($this->conditions) {
            $countQuery .= ' WHERE ' . implode(' AND ', $this->conditions);
        }
        $countStmt = $this->db->prepare($countQuery);
        foreach ($this->bindings as $key => $value) {
            $countStmt->bindValue($key, $value);
        }
        $countStmt->execute();
        $total = $countStmt->fetch(\PDO::FETCH_ASSOC)['total'];

        return [
            'data' => $data,
            'current_page' => $page,
            'per_page' => $perPage,
            'total' => $total,
            'last_page' => ceil($total / $perPage),
        ];
    }


    public function groupBy($columns)
    {
        $this->groupBy = is_array($columns) ? implode(', ', $columns) : $columns;
        return $this;
    }

    public function addSelect($column)
    {
        if (!in_array($column, $this->columns)) {
            $this->columns[] = $column;
        }

    public function orderBy($column, $direction = 'ASC')
    {
        $this->orderBy[] = "$column $direction";
        return $this;
    }


}
