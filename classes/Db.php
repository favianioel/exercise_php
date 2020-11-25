<?php

namespace Exercise;

class Db implements DbInterface  {

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

    public function viewCategory($id)
    {
        $sql = "SELECT articles.title
        from articles inner join articles_categories
        on articles_categories.articles_id = articles.id
        where articles_categories.categories_id = " . $this->escape($id);

        return $this->con->query($sql, \PDO::FETCH_ASSOC);
    }

    /**
     * select query
     *
     * @param  string $table
     * @param  array $select_fields
     * @param  array $where
     * @param  string $where_mode
     * @param  string $limit
     * @param  string $order
     *
     * @return array array of selected parameters
     */
    public function select($table, $select_fields = '*', $where = array(), $where_mode = "AND", $limit = false, $order = false)
    {
        //if is not left default we select fields from array
        if (is_array($select_fields)) {
            $fields = '';
            foreach ($select_fields as $s) {
                $fields .= '`' . $s . '`, ';
            }
            $select_fields = rtrim($fields, ', ');
        }

        $sql = 'SELECT ' . $select_fields . ' FROM `' . $table . '`';

        //add more conditions to query
        if (!empty($where)) {
            $sql .= ' WHERE' . $this->process_where($where, $where_mode);
        }
        if ($order) {
            $sql .= ' ORDER BY ' . $order;
        }
        if ($limit) {
            $sql .= ' LIMIT ' . $limit;
        }
        return $this->con->query($sql, \PDO::FETCH_ASSOC);
    }

    
    /**
     * insert
     *
     * @param  string $table
     * @param  array $fields
     * @param  string $appendix
     *
     * @return void
     */
    public function insert($table, $fields = array(), $appendix = false) 
    {
        $sql = 'INSERT INTO';
        $sql .= ' `' . $table . "`";

        if (is_array($fields)) {
            $sql .= ' (';
            $num = 0;
            foreach ($fields as $key => $value) {
                $sql .= ' `' . $key . '`';
                $num++;
                if ($num != count($fields)) {
                    $sql .= ',';
                }
            }
            $sql .= ' ) VALUES ( ' . $this->join_array($fields) . ' )';
        } else {
            $sql .= ' ' . $fields;
        }
        if ($appendix) {
            $sql .= ' ' . $appendix;
        }
        $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $this->con->exec($sql);
    }

    
    /**
     * update
     *
     * @param  string $table
     * @param  array $fields
     * @param  array $where
     * @param  string $limit
     * @param  string $order
     *
     * @return void
     */
    public function update($table, $fields = array(), $where = array(), $limit = false, $order = false) 
    {

        if (empty($where)) {
            throw new DatabaseException('Where clause is empty for update method');
        }

        $sql = 'UPDATE `' . $table . '` SET';
        if (is_array($fields)) {
            $nr = 0;
            foreach ($fields as $k => $v) {
                if (is_object($v) || is_array($v) || is_bool($v)) {
                    $v = serialize($v);
                }
                if($v === null) {
                    $sql .= ' `' . $k . "`=NULL";
                } else {
                    $sql .= ' `' . $k . "`=" . $this->escape($v) . "";
                }
                $nr++;
                if ($nr != count($fields)) {
                    $sql .= ',';
                }
            }
        } else {
            $sql .= ' ' . $fields;
        }
        if (!empty($where)) {
            $sql .= ' WHERE' . $this->process_where($where);
        }
        if ($order) {
            $sql .= ' ORDER BY ' . $order;
        }
        if ($limit) {
            $sql .= ' LIMIT ' . $limit;
        }
        // var_dump($sql);die;
        $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $this->con->exec($sql);
    }

    
    /**
     * delete
     *
     * @param  string $table
     * @param  array $where
     * @param  string $where_mode
     * @param  string $limit
     * @param  string $order
     *
     * @return void
     */
    public function delete($table, $where = array(), $where_mode = "AND", $limit = false, $order = false) 
    {
        if (empty($where)) {
            throw new DatabaseException('Where clause is empty for update method');
        }

        $sql = 'DELETE FROM `' . $table . '`';
        if (!empty($where)) {
            $sql .= ' WHERE' . $this->process_where($where, $where_mode);
        }
        if ($order) {
            $sql .= ' ORDER BY ' . $order;
        }
        if ($limit) {
            $sql .= ' LIMIT ' . $limit;
        }

        return $this->con->exec($sql);
    
    }

    /**
     * Turn an array into a where statement
     *
     * @param array $where
     * @param string $where_mode
     * @return string
     * @throws Exception
     */
    private function process_where($where, $where_mode = 'AND')
    {
        $sql = '';
        if (is_array($where)) {
            $num = 0;
            $where_count = count($where);
            foreach ($where as $k => $v) {
                if (is_array($v)) {
                    $w = array_keys($v);
                    if (reset($w) != 0) {
                        throw new Exception('Can not handle associative arrays');
                    }
                    $sql .= " `" . $k . "` IN (" . $this->join_array($v) . ")";
                } elseif (!is_integer($k)) {
                    $sql .= ' `' . $k . "`=".$this->escape($v);
                } else {
                    $sql .= ' ' . $v;
                }
                $num++;
                if ($num != $where_count) {
                    $sql .= ' ' . $where_mode;
                }
            }
        } else {
            $sql .= ' ' . $where;
        }
        return $sql;
    }

    /**
     * Helper function for process_where
     *
     * @param $array
     * @return string
     */
    private function join_array($array)
    {
        $nr = 0;
        $sql = '';
        foreach ($array as $key => $value) {
            if (is_object($value) || is_array($value) || is_bool($value)) {
                $value = serialize($value);
            }
            if($value === null) {
                $sql .= ' NULL';
            } else {
                $sql .= $this->escape($value);
            }
            $nr++;
            if ($nr != count($array)) {
                $sql .= ',';
            }
        }
        return trim($sql);
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