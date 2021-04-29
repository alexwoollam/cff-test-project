<?php

function whoops(){

    (new \Whoops\Run)->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    (new \Whoops\Run)->register();
}