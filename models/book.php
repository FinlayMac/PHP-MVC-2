<?php

class Book {   
    public $name;   
    public $author;   
    public $description;   
  
    public function __construct($name, $author, $description)   
    {   
        $this->name = $name;   
        $this->author = $author;   
        $this->description = $description;   
    }   
}
