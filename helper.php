<?php



/** Get the base path 
 * @param string $path
 * @return string
 */

function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}


/**
 * Load a View
 * @param string $name
 * @param array $data
 * @param void
 */

function loadView($name, $data = [])
{
    $viewpath =  basePath("public/views/{$name}.view.php");

    if (file_exists($viewpath)) {
        extract($data);
        require $viewpath;
    } else {
        echo "View {$name} not found";
    };
}


/**
 * Load a Partial
 * @param string $name
 * @param void
 */

function loadPartial($name)
{
    $partialPath = basePath("public/views/partials/{$name}.php");
    if (file_exists($partialPath)) {
        require $partialPath;
    } else {
        echo "Partials {$name} not found";
    };
}

/**Inspect a value
 * @param mixed $value
 * @return void
 */
function inspect($value){
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}



function inspectAndDie($value){
    inspect($value);
    die();
}   
?>