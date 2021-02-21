<?php
interface databaseObject{
    public static function loadById(int $id):self;
    public function save():void;
}