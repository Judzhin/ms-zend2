<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class AlbumTable {

    protected $tableGateway;

    /**
     * 
     * @param \Zend\Db\TableGateway\TableGateway $tableGateway
     */
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $results = $this->tableGateway->select();
        return $results;
    }

    public function getAlbum($id) {
        $id = (int) $id;
        
        $result = $this->tableGateway->select(array(
            'id' => $id
        ));
        
        $row = $result->current();
        
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        
        return $row;
    }

    /**
     * 
     * @param \Application\Model\Album $model
     * @throws \Exception
     */
    public function save(Album $model) {
        $data = array(
            'artist' => $model->artist,
            'title' => $model->title,
        );

        $id = (int) $model->id;
        
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            
            if ($this->getAlbum($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Album id does not exist');
            }
        }
    }

    public function delete($id) {
        $this->tableGateway->delete(array('id' => $id));
    }

}