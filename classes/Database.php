<?php
class Database{

    public function action($action, $table, $where = array())
    {
        if(count($where) === 3)
        {
            $operators = array('=','>','<','>=','<=');
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if((in_array($operator, $operators)))
            {
                return "{$action} FROM {$table} WHERE {$field} {$operator} '{$value}'";
            }
        }
    }

    public function get($table, $field, $where)
    {
         return $this->action('SELECT '.$field,$table,$where);
    }

    public function insert($table, $fields = array())
    {
        if(count($fields))
        {
            $keys = array_keys($fields);
            $values = '';
            $x = 1;
            foreach($fields as $field)
            {
                $values .= "?";
                if($x < count($fields))
                {
                    $values .= ', ';
                }
                $x++;
            }

            return "INSERT INTO users (`".implode('`,`',$keys)."`) VALUES ({$values})";
        }
        return false;
    }

    public function update($table, $id, $fields)
    {
        $set = '';
        $x = 1;
        foreach($fields as $name => $value)
        {
            $set .= "{$name} = ?";
            if($x < count($fields))
            {
                $set .= ', ';
            }
            $x++;
        }
        return "UPDATE {$table} SET {$set} WHERE id = {$id}";
    }

    public function delete($table, $where)
    {
        return $this->action('DELETE',$table,$where);
    }

}