<?php

namespace Exercise;

class Db {

    protected $con;

    /**
     * Creates a single conection
     */
    function __construct()
    {
        $this->con = DbConnection::getInstance()->connection;
    }

    public function viewArticle($id)
    {
        $sql = "SELECT articles.id, articles.title, articles.description, authors.name FROM articles 
        INNER JOIN authors ON articles.author_id=authors.id 
        WHERE articles.id = " . $this->escape($id);

        return $this->con->query($sql, \PDO::FETCH_ASSOC);
    }

    public function viewAuthor($id)
    {
        $sql = "SELECT articles.title  FROM articles 
        INNER JOIN authors ON authors.id=articles.author_id
        WHERE authors.name = " . $this->escape($id);

        return $this->con->query($sql, \PDO::FETCH_ASSOC);
    }

    public function getAuthorById($id)
    {
        $sql = "SELECT * FROM authors 
        WHERE authors.id = " . $this->escape($id);

        return $this->con->query($sql, \PDO::FETCH_ASSOC);
    }
    
    public function getCategorieById($id)
    {
        $sql = "SELECT * FROM categories 
        WHERE categories.id = " . $this->escape($id);

        return $this->con->query($sql, \PDO::FETCH_ASSOC);
    }

    public function getArticleById($id)
    {
        $sql = "SELECT * FROM articles 
        WHERE articles.id = " . $this->escape($id);

        return $this->con->query($sql, \PDO::FETCH_ASSOC);
    }

    public function viewCategory($id)
    {
        $sql = "SELECT articles.title
        from articles inner join articles_categories
        on articles_categories.articles_id = articles.id
        where articles_categories.categories_id = " . $this->escape($id);

        return $this->con->query($sql, \PDO::FETCH_ASSOC);
    }

    public function selectAllByTable($table)
    {
        $sql = "SELECT * FROM " . $table;
        
        return $this->con->query($sql, \PDO::FETCH_ASSOC);
    }

    public function selectAllByTableAndId($table, $id)
    {
        $sql  = " SELECT * FROM " . $table;
        $sql .= " WHERE id = " . $this->escape($id);

        return $this->con->query($sql, \PDO::FETCH_ASSOC);
    }

    public function createArticle($title, $author)
    {
        $sql  = "INSERT INTO `articles` (`title`, `author_id`) ";
        $sql .= "VALUES (" . $this->escape($title) .", ".$this->escape($author).")";
        
        return $this->con->query($sql, \PDO::FETCH_ASSOC);
    }

    public function updateArticleById($title, $author, $id)
    {
        $sql  = "UPDATE `articles` ";
        $sql .= "SET `title` = ".$this->escape($title).", `author_id` = ".$this->escape($author)." ";
        $sql .= "WHERE id = ".$this->escape($id);
        
        return $this->con->query($sql, \PDO::FETCH_ASSOC);
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM ".$this->escape($table);
        $sql .= "WHERE id = ".$this->escape($id);
        return $this->con->query($sql, \PDO::FETCH_ASSOC);
    }

    /**
     * Escape a parameter
     *
     * @param $str
     * @return string
     */
    public function escape($str)
    {
        return $this->con->quote($str);
    }

}