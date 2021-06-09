<?php

include_once(__DIR__ . "/../view/showHeader.php");
include_once(__DIR__ . '/showNav.php');
include_once(__DIR__ . '/showFooter.php');

function title(){
?>
    <h1>BIENVENUE AU FORUM !</h1>  
<?php
}

function container_start(){
?>
    <div class="forum-container">
<?php    
}

function container_end(){
?>
    </div>
<?php
}

function pageForum(array $games, array $comments) {
    // transfert des arrays aux fonctions
    $select = create_select_game($games);

    $id = !empty($_GET['id']) ? $_GET['id'] : false;
    $select_filter = create_select_game($games, $id);
    
    
    if(count($comments) > 0){
        $list = display_comments($comments, $games);
    } else {
        $list = "aucun commentaires sur ce jeu n'a été trouvé";
    }

    $filter = !empty($_GET['id']) ? $games[$_GET['id']-1]['shortname'] : " - " ;

?>
    <!-- div container déplacée dans une fonction pour tout le contenu et le message du post lors du post -->
        <div class="form">
            <form action="../controller/forum.php?comment=process" method="POST">
                <label for="game">Choisissez le jeu que vous voulez commentez :</label><br><br>
                <select name="game">
                    <?php echo $select; ?>
                </select><br><br>
                
                <label for="subject"></label><br>
                <input type="text" name="subject" placeholder="Entrez le titre du sujet"><br><br>
                
                <label for="message"></label><br>
                <textarea name="message" cols="50" rows="9" placeholder="Entrez du texte"></textarea><br><br>

                <input type="Submit" name="submit" value="Validation">
            </form>
        </div><br><br>

        <div class="filter-menu-container">
            Filtrer par : <?php echo $filter; ?>
            <select class="filter-select">
                <option value="0">Sans filtre</option>
                <?php echo $select_filter; ?>
            </select>
        </div>

        

        <div class="comment-list"><?php echo $list; ?></div>
    <!-- /div container déplacée dans une fonction pour tout le contenu et le message du post lors du post -->
    

    <!-- jquery pour l'affichage dynamique lors du jeu selectionné dans le filtre -->
    <script type="text/javascript">

        $('.filter-select').on('change', (e) => {
            let 
                selected_option = $(e.target).val(),
                queryParam;
            
            // debug
            console.log($(e.target).val());

            queryParam = (selected_option == 0) ? "" : '?filter=games&id=' + selected_option;
            window.location.assign('../controller/forum.php' + queryParam);         
        });
    
    </script>

<?php
}

function create_select_game(array $arr, $id=false){
    $select = "";
    $selected = "";
    for($i = 0; $i < count($arr); $i++){ // récupération des id pour afficher les jeux
        if($id){
            $selected = ($i==$id-1) ? "selected" : "";
        }
        
        $select .= "<option value =\"".$arr[$i]['game_id']."\" $selected>".$arr[$i]['name']."</options>\n";
    }
    return $select;
}

// on escape les guillemets dans les variables pour différiencier les guillemets d'html aux guillemets de php
function display_comments(array $comments, array $games) : string {
    $list = "";

    for($i = 0; $i < count($comments); $i++){// récupération des id pour afficher les comments
        $game_id = $comments[$i]['game'];
        $list .= " 
                <div class=\"comment-container\">
                    <div class=\"comment-author\">".$comments[$i]['author']."</div>
                    <div class=\"comment-game\">".$games[$game_id-1]['name']."</div> 
                    <div class=\"comment-date\">".$comments[$i]['date_post']."</div>
                    <div class=\"clear\"></div>
                    <div class=\"comment-subject\">".$comments[$i]['sujet']."</div>
                    <div class=\"comment-message\">".$comments[$i]['contenu']."</div>
                </div>
            "; // l'array games commence à l'indice 0 alors que l'indice des jeux commence à l'id 1, du coup on met -1 à la ligne 11 pour décaler au bon endroit l'indice des jeux
            // ligne 65 : récupération de la colonne des jeux de la table post_forum qui servira à retrouver le jeu en question dans la table games à la ligne 69
        }
    
    return $list;
}

function display_message($err){
    if($err){
        $msg = "Error posting comment : $err";
    } else {
        $msg = 
            "Your comment has been posted successfully <br><br>
            <a href=\"forum.php\">Go back to forum</a>";
    }
    echo $msg;
}