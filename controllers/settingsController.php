<?php

//check if table params exist in url
if(isset($_GET['table'])){
    // need to create checker method with all table but normaly only admin can be here, not so important to secure here, just sql error if not exist i guess
    $table = htmlspecialchars($_GET['table']);
    $column = new Admin();
    // check if del params exist, if exist del row id
    if(isset($_GET['del'])){
        $id = htmlspecialchars($_GET['del']);
        $column->id = $id;
        $columns = $column->deleteInTable($table);
    }
    $contentList = $column->getAllInTable($table);
    $columns = $column->showColumns($table);
}