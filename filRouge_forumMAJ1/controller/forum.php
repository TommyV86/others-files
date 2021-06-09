<?php

include_once(__DIR__ . "/../view/aff_forum.php");
include_once(__DIR__."/../service/ForumServ.php");

showHeader();
showNav();
container_start();
title();

if(empty($_GET)){
    $forumServices = new ForumServices();
    $games = $forumServices->get_games();
    $comments = $forumServices->get_comments();
    pageForum($games, $comments);
    
} elseif(!empty($_GET['comment']) && $_GET['comment'] == 'process'){
    $forumServices = new ForumServices();
    $err = $forumServices->process_comment();
    display_message($err);

} elseif(!empty($_GET['filter']) && $_GET['filter'] == 'games'){
    $game_id = $_GET['id'];

    // get comments filtered
    $forumServices = new ForumServices();
    $games = $forumServices->get_games();
    $comments_selected_game = $forumServices->get_comments_filtered($game_id);
    pageForum($games, $comments_selected_game);
}

container_end();
showFooter();
?>