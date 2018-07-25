<?php
/**
 * Created by PhpStorm.
 * User: RUBEN
 * Date: 2018-07-09
 * Time: 12:40
 */

namespace AppBundle\Service\DBManager;

use AppBundle\Entity\AppUsers;

class FilterManager
{
    const SPACE = ' ';

    const EQUAL = 'EQUAL';
    const LIKE = 'LIKE';

    private $doctrine;
    private $table = array();
    private $join = array();
    private $condition = array();
    private $select = array();
    private $limit = 0;
    private $query;
    
    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function setTable($table)
    {
        $this->table['fullName'] = $table['fullName'];
        $this->table['shortName'] = $table['shortName'];
        //$this->table[$table['fullName']] = $table['shortName'];
    }

    public function setJoin($join)
    {
        foreach ($join as $field => $alias) {
            $this->join[] = array(
                'field' => $field,
                'alias' => $alias
            );
        }
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    public function setCondition($condition, $table, $conditionType = array())
    {
        foreach ($condition as $field => $value) {
            if(!is_null($value) && strlen($value))
            {
                $condition = 'LIKE';
                if(isset($conditionType[$field]))
                {
                    $condition = $conditionType;
                }
                $this->condition[] = array(
                    'field' => $table . '.' . $field,
                    'value' => $value,
                    'type' => $condition
                );
            }
        }
    }

    public function setSelect($select)
    {
        $this->select = $select;
    }

    public function getfilteredData()
    {
        $this->query = $this->doctrine->getEntityManager()->createQueryBuilder();
        $this->query->select($this->select);
        $this->query->from($this->table['fullName'], $this->table['shortName']);
        $this->join();
        $this->where();
        $this->limit();

        $result = $this->query->getQuery()->getResult();

        return $result;
    }

    private function join()
    {
        foreach($this->join as $id => $join)
        {
            $this->query->leftJoin($join['field'],$join['alias']);
        }
    }

    private function where()
    {
        foreach($this->condition as $id => $condition)
        {
            switch($condition['type']) {
                case FilterManager::EQUAL:
                    $this->query->andWhere($condition['field'] . " = " . $condition['value']);
                    break;
                case FilterManager::LIKE:
                    $this->query->andWhere($condition['field'] . " LIKE '%" . $condition['value'] . "%'");
                    break;
            }
        }
    }

    private function limit()
    {
        if ($this->limit) {
            $this->query->setMaxResults($this->limit);
        }
    }
}