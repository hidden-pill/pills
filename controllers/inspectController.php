<?php

if(isset($_GET['table'])){
    $table = htmlspecialchars($_GET['table']);
    $column = new Admin();
    if(isset($_GET['del'])){
        $id = htmlspecialchars($_GET['del']);
        $column->id = $id;
        $columns = $column->deleteInTable($table);
    }
    $contentList = $column->getAllInTable($table);
    $columns = $column->showColumns($table);
}