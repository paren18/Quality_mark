<?php

class Goods
{
    private $conn;
    private $table_name = "goods";

    public $id;
    public $name;
    public $inn;
    public $barcode;
    public $description;
    public $price;
    public $category_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT
        c.name as category_name, p.id, p.name,p.inn,p.barcode, p.description, p.price, p.category_id
    FROM
        " . $this->table_name . " p
        LEFT JOIN
            categories c
                ON p.category_id = c.id
    ORDER BY
        p.id ";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    function create()
    {
        $query = "INSERT INTO
            " . $this->table_name . "
        SET
            name=:name, inn=:inn, barcode=:barcode, description=:description, price=:price, category_id=:category_id";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->inn = htmlspecialchars(strip_tags($this->inn));
        $this->barcode = htmlspecialchars(strip_tags($this->barcode));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":inn", $this->inn);
        $stmt->bindParam(":barcode", $this->barcode);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":category_id", $this->category_id);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function readOne()
    {
        $query = "SELECT
            c.name as name, p.id, p.name,p.inn,p.barcode, p.description, p.price, p.category_id
        FROM
            " . $this->table_name . " p
            LEFT JOIN
                categories c
                    ON p.category_id = c.id
        WHERE
            p.id = ?
        LIMIT
            0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row["name"];
        $this->inn = $row["inn"];
        $this->barcode = $row["barcode"];
        $this->description = $row["description"];
        $this->price = $row["price"];
        $this->category_id = $row["category_id"];
    }
    function update()
    {
        $query = "UPDATE
            " . $this->table_name . "
        SET
            name = :name,
          inn = :inn,
          barcode= :barcode, 
          description = :description,  
             price = :price,
            category_id = :category_id
        WHERE
            id = :id";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->inn = htmlspecialchars(strip_tags($this->inn));
        $this->barcode = htmlspecialchars(strip_tags($this->barcode));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":inn", $this->inn);
        $stmt->bindParam(":barcode", $this->barcode);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":category_id", $this->category_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    function delete()
    {

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function search($keyword)
    {

        $query = "SELECT
                    id, name, inn, barcode, description, price, category_id
                FROM
                    " . $this->table_name . "
                WHERE
                    name LIKE ? OR
                    description LIKE ?";

        $stmt = $this->conn->prepare($query);

        $keyword = "%{$keyword}%";

        $stmt->bindParam(1, $keyword);
        $stmt->bindParam(2, $keyword);
        $stmt->execute();

        return $stmt;
    }
}


