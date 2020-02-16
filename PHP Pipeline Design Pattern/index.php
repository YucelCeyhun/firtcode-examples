<?php
function __autoload($className)
{
    $className = str_replace('\\', '/', $className);
    $filePath = "{$className}.php";
    if (file_exists($filePath)) {
        require($filePath);
    }
}

$pipeline = new Pipeline;
$arr = array(1, 2, 3, 4, 5, 6, 7);

$filteredArr = $pipeline
    ->send($arr)
    ->through([
        Odd::class,
        Sort::class
    ])
    ->thenReturn();

echo '<pre>';
var_dump($filteredArr);
echo '</pre>';
