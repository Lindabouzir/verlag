<?php

namespace Repository;
class Author
{
    private  $id;
    private  $fname;
    private  $lname;
    private  $bday;
    private  $country;


    public function __construct(int $id, string $fname, string $lname, string $bday, string $country){
        $this->id = $id;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->bday = $bday;
        $this->country = $country;
    }


    public function getId()
    {
        return $this->id;
    }
    public function getFname()
    {
        return $this->fname;
    }
    public function getLname()
    {
        return $this->lname;
    }
    public function getBday()
    {
        return $this->bday;
    }
    public function getCountry()
    {
        return $this->country;

    }

}