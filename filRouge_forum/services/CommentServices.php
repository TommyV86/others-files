<?php 

include_once(__DIR__."/../dao/ConnectDb.php");
include_once(__DIR__."/../dao/CommentDao.php");
include_once(__DIR__."/../model/CommentModel.php");

class CommentServices extends ConnectDb
{
    public function process_comment() : string
    {
        $commentDao = new CommentDao();
        return $commentDao->process_comment();
    }

    public function get_games() : array
    {
        $commentDao = new CommentDao();
        return $commentDao->get_games();
    }

    public function get_comments() : array
    {
        $commentDao = new CommentDao();
        return $commentDao->get_comments();
    }
}