<?php

namespace Exercise;

interface DbInterface {

    public function select($table, $select_fields, $where, $where_mode, $limit, $order);

    public function insert($table, $fields, $appendix);

    public function update($table, $fields, $where, $limit, $order);

    public function delete($table, $where, $where_mode, $limit, $order);

}