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

    private $doctrine;
    private $table = array();
    private $join = array();
    private $condition = array();
    private $select = array();

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

    public function setCondition($condition)
    {
        foreach ($condition as $field => $value) {
            if(!is_null($value) && strlen($value))
            {
                $this->condition[] = array(
                    'field' => $field,
                    'value' => $value
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
        $q = $this->doctrine->getEntityManager()->createQueryBuilder();
        $q->select($this->select);
        $q->from($this->table['fullName'], $this->table['shortName']);

        foreach($this->join as $id => $join)
        {
            $q->leftJoin($join['field'],$join['alias']);
        }

        foreach($this->condition as $id => $condition)
        {
            $q->andWhere($condition['field'] . " LIKE '%" . $condition['value'] . "%'");
        }

        $result = $q->getQuery()->getResult();

        return $result;
    }
}