<?php
/**
 * Created by PhpStorm.
 * User: RUBEN
 * Date: 2018-07-09
 * Time: 12:40
 */

namespace AppBundle\Service\DBManager;

use AppBundle\Entity\AppUsers;
use Doctrine\ORM\Query\Expr\Join;

class FilterManager
{
    const SPACE = ' ';

    const EQUAL = 'EQUAL';
    const LIKE = 'LIKE';
    const GREATER = 'GREATER';
    const LESS = 'LESS';
    const OR = 'OR';
    const IN = 'IN';
    const LIMIT_PER_PAGE = 30;

    private $doctrine;
    private $table = array();
    private $join = array();
    private $condition = array();
    private $select = array();
    private $limit = FilterManager::LIMIT_PER_PAGE;
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
            if($this->checkEmpty($value))
            {
                $type = 'LIKE';
                if(isset($conditionType[$field]))
                {
                    $type = $conditionType[$field];
                }
                $this->condition[] = array(
                    'field' => $table . '.' . $field,
                    'value' => $value,
                    'type' => $type
                );
            }
        }
    }

    private function checkEmpty($data)
    {
        if(is_array($data))
        {
            return count($data);
        } else {
            return strlen($data);
        }

        if(is_null($data) || strlen($data) == 0) {
            return 0;
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
        $this->createOrCondition();
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
                case FilterManager::GREATER:
                    $field = str_replace('_from','',$condition['field']);
                    $this->query->andWhere($field . " >= " . $condition['value']);
                    break;
                case FilterManager::LESS:
                    $field = str_replace('_to','',$condition['field']);
                    $this->query->andWhere($field . " <= " . $condition['value']);
                    break;
                case FilterManager::IN:
                    $this->query->andWhere($condition['field'] . ' IN(' . implode(',',$condition['value']).')');
                    break;
                case FilterManager::OR:
                    $con = '';
                    foreach($condition['field'] as $id => $field)
                    {
                        $connector = '';
                        if(end($condition['field']) != $field) $connector = FilterManager::SPACE . FilterManager::OR . FilterManager::SPACE;
                        $con .= $field . " LIKE '%" . $condition['value'] . "%'" .$connector;
                    }
                    $this->query->andWhere($con);
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

    private function createOrCondition()
    {
        $conditionArr = array();
        $orFieldArr = array();

        foreach($this->condition as $id => $condition)
        {
            if($condition['type'] == FilterManager::OR)
            {
                preg_match('/(.*)_or_(.*)/', $condition['field'], $matches);
                $connector = $matches[2];
                $field = $matches[1];
                $orFieldArr[$connector]['field'][] = $field;
                $orFieldArr[$connector]['value'] = $condition['value'];
                $orFieldArr[$connector]['type'] = FilterManager::OR;
                unset($this->condition[$id]);
            }
        }

        foreach($orFieldArr as $name => $fields)
        {
            $this->condition[] = $fields;
        }
    }

}