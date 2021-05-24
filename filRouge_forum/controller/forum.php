<?php
include_once(__DIR__ . "/../view/showHeader.php");
include_once(__DIR__ . "/../view/display_forum.php");
include_once(__DIR__."/../services/CommentServices.php");
include_once(__DIR__ . "/../view/showFooter.php");

showHeader();

if(empty($_GET)){
    $commentServices = new CommentServices();
    $games = $commentServices->get_games();
    $comments = $commentServices->get_comments();
    pageForum($games, $comments);
} elseif(!empty($_GET) && $_GET['comment'] == 'process'){
    $commentServices = new CommentServices();
    $err = $commentServices->process_comment();    
}

showFooter();