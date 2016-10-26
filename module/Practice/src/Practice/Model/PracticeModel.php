<?php

namespace Practice\Model;

class PracticeModel {
    
    protected $id;
    protected $artist;
    protected $title;
    
    public function setId($id){
        $this->id = $id;
        return $this;
    }
    
    public function setArtist($name){
        $this->artist = $name;
        return $this;
    }
    
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getArtist(){
        return $this->artist;
    }
    
    public function getTitle(){
        return $this->title;
    }
}
