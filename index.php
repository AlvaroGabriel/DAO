<?php

require_once ('config.php');

$delete = new Usuario();

$delete->loadById("4");
$delete->delete();

echo $delete;

//---- update-----------
//$update = new Usuario();
//
//$update->loadById('2');
//$update->update("Maria", "blackhalt");
//echo $update;
//-------------- End Update ---------

//-------- Insert--------
//$aluno = new Usuario("Luna", "luna2013");
//
//$aluno->insert();
//echo $aluno;
//---------End Insert-----

//------ Show all users----
//      $resuts = Usuario::search('alvaro');
//      $resuts = Usuario::getList();
//      $resuts = new Usuario();
//      $resuts->login("Alvaro","1234567");
//
//      echo $resuts;

//    foreach ($resuts as $raw){
//        echo "<ul>";
//        foreach ($raw as $key => $value){
//            echo "<li> $key: $value </li>";
//        }
//        echo "</ul>";
//    }
//----------- End Show --------------

/* $root = new Usuario();
$root->loadById(1);

echo $root; */

?>
<style>
    ul{
        padding: 2px;
        margin: 2px auto;
        display: flex;
        flex-wrap: wrap;
        width: 40%;
        border: 1px solid red;
    }
    li{
        margin: 5px;
        padding: 10px;
        list-style: none;
        border: 1px solid black;
        flex: 1;
    }
</style>
