<?php

class Forum
{
    private int $author;
    private string $postDate;
    private int $game;
    private string $subject;
    private string $msg;

    public function setParam(string $att, $val) : void
    {
        // valeur assignée à l'attribut
        $this->$att = $val;
    }

    public function getParam(string $att) 
    {
        return $this->$att;
    }
}