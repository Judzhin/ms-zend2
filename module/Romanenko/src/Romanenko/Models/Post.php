<?php

namespace Romanenko\Models;

use Romanenko\Models\Post\Mapper as Mapper;

class Post {

    /**
     *
     * @var \Romanenko\Models\Post\Mapper $_mapper
     */
    private $_mapper;

    /**
     * 
     * @param \Romanenko\Models\Post\Mapper $_mapper
     */
    public function __construct(Mapper $_mapper) {
        $this->_mapper = $_mapper;
    }
    /**
     * 
     * @param type $id
     */
    public function find($id) {
        
    }
}