<?php

namespace app\vendor\mvc\controllers;

class MainController
{

    public function render($url, $attributes = [])
    {
        $directory = substr(str_replace(['controllers\\', 'controller'], '', mb_strtolower(get_class($this))), 4);

        if (empty($directory)) return to_404();
        
        $path = explode('\\', $directory);
        if (count($path) >= 3) { // это модуль
            $mainDir = $path[0] . '/' . $path[1];
            $controllerDir = $path[2];
        } else {
            $mainDir = $path[0];
            $controllerDir = $path[1];
        }
        $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $mainDir . '/views/' . $controllerDir . '/' . $url . '.php';
        try {
            if (!file_exists($fullPath)) {
                throw new  \Exception("File $fullPath не найден");
            }
            extract($attributes);
            return include "$fullPath";
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
        }
    }
}

?>