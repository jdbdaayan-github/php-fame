<?php
namespace System\Database;

use PDO;

class QueryBuilder
{
    protected $pdo;
    protected $table;
    protected $selects = '*';
    protected $wheres = [];
    protected $bindings = [];
    protected $joins = [];
    protected $orderBy = '';
    protected $limit = '';
    protected $groupBy = '';
    protected $having = '';

    public function __construct(PDO $pdo, $table)
    {
        $this->pdo = $pdo;
        $this->table = $table;
    }

    // SELECT columns
    public function select($columns = '*')
    {
        $this->selects = is_array($columns) ? implode(', ', $columns) : $columns;
        return $this;
    }

    // WHERE clause
    public function where($column, $operator, $value)
    {
        $this->wheres[] = "$column $operator ?";
        $this->bindings[] = $value;
        return $this;
    }

    public function orWhere($column, $operator, $value)
    {
        if (empty($this->wheres)) return $this->where($column, $operator, $value);
        $this->wheres[] = "OR $column $operator ?";
        $this->bindings[] = $value;
        return $this;
    }

    // JOIN clause
    public function join($table, $first, $operator, $second, $type = 'INNER')
    {
        $this->joins[] = "$type JOIN $table ON $first $operator $second";
        return $this;
    }

    // ORDER BY
    public function orderBy($column, $direction = 'ASC')
    {
        $this->orderBy = "ORDER BY $column $direction";
        return $this;
    }

    // GROUP BY
    public function groupBy($column)
    {
        $this->groupBy = "GROUP BY $column";
        return $this;
    }

    // HAVING
    public function having($column, $operator, $value)
    {
        $this->having = "HAVING $column $operator ?";
        $this->bindings[] = $value;
        return $this;
    }

    // LIMIT
    public function limit($count)
    {
        $this->limit = "LIMIT $count";
        return $this;
    }

    // GET multiple rows
    public function get()
    {
        $sql = "SELECT {$this->selects} FROM {$this->table}";

        if ($this->joins) $sql .= ' ' . implode(' ', $this->joins);
        if ($this->wheres) $sql .= ' WHERE ' . implode(' AND ', $this->wheres);
        if ($this->groupBy) $sql .= ' ' . $this->groupBy;
        if ($this->having) $sql .= ' ' . $this->having;
        if ($this->orderBy) $sql .= ' ' . $this->orderBy;
        if ($this->limit) $sql .= ' ' . $this->limit;

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($this->bindings);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // GET first row
    public function first()
    {
        $this->limit(1);
        $results = $this->get();
        return $results[0] ?? null;
    }

    // INSERT
    public function insert(array $data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} ($columns) VALUES ($placeholders)");
        return $stmt->execute(array_values($data));
    }

    // UPDATE
    public function update(array $data)
    {
        $set = implode(', ', array_map(fn($key) => "$key = ?", array_keys($data)));
        $sql = "UPDATE {$this->table} SET $set";
        if ($this->wheres) $sql .= " WHERE " . implode(' AND ', $this->wheres);

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(array_merge(array_values($data), $this->bindings));
    }

    // DELETE
    public function delete()
    {
        $sql = "DELETE FROM {$this->table}";
        if ($this->wheres) $sql .= " WHERE " . implode(' AND ', $this->wheres);

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($this->bindings);
    }

    // RAW query
    public function raw($sql, $bindings = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($bindings);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Aggregates
    public function count($column = '*')
    {
        $this->select("COUNT($column) as count");
        $result = $this->first();
        return $result['count'] ?? 0;
    }

    public function max($column)
    {
        $this->select("MAX($column) as max");
        $result = $this->first();
        return $result['max'] ?? null;
    }

    public function min($column)
    {
        $this->select("MIN($column) as min");
        $result = $this->first();
        return $result['min'] ?? null;
    }

    public function avg($column)
    {
        $this->select("AVG($column) as avg");
        $result = $this->first();
        return $result['avg'] ?? null;
    }

    public function sum($column)
    {
        $this->select("SUM($column) as sum");
        $result = $this->first();
        return $result['sum'] ?? null;
    }
}
