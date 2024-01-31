<?php

class Categories
{
    private $conn;
    private $table_name = "categories";
    public $id;
    public $name;
    public $uri;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function readAll()
    {
        $query = "SELECT
                id, name, uri
            FROM
                " . $this->table_name . "
            ORDER BY
                name";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function readAllWithCount()
    {
        $query = "SELECT
                c.id, c.name, c.uri, COUNT(g.id) as product_count
            FROM
                " . $this->table_name . " c
            LEFT JOIN
                goods g ON c.id = g.category_id
            GROUP BY
                c.id
            ORDER BY
                c.name";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}