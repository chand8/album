<?php

namespace Practice\Gateway;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Practice\Model\PracticeModel;

class PracticeGateway {

    protected $adapter;
    protected $table = 'album';
    protected $sql;
    protected $model;

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->sql = new Sql($this->adapter, $this->table);
        $this->model = new PracticeModel;
    }

    public function fetch($id) {
        $select = $this->sql->select();
        $select->where->equalTo('id', $id);
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        foreach ($results AS $result) {
            if (!empty($result['id'])) {
                $this->model->setId($result['id']);
                $this->model->setTitle($result['title']);
                $this->model->setArtist($result['artist']);
            }
        }
        return $this->model;
    }

    public function fetchAll() {
        $select = $this->sql->select();
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        $data = [];
        foreach($results AS $result){
           if (!empty($result['id'])) {
                $this->model->setId($result['id']);
                $this->model->setTitle($result['title']);
                $this->model->setArtist($result['artist']);
                $data[] = $this->model;
            } 
        }
        
        return $data;
    }   
}
