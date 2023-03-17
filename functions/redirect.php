<?php
function redirect(string $url){
    header("location: $url");
    exit;
}