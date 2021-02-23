<?php
interface databaseObject{
    public static function loadById(int $id);
    public function save():void;
}