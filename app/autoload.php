<?php
// PREMIERE SYNTAXE autoload
// spl_autoload_register(function($class){
//     $tabFiles = ["./models/$class.php", "./models/admin/$class.php", "./models/public/$class.php","./controllers/$class.php", "./controllers/admin/$class.php", "./controllers/public/$class.php"];

//     foreach($tabFiles as $file){
//         if(file_exists($file)){
//             require $file;
//         }
//     }
// });

// AUTRE SYNTAXE autoload

function chargement($class){
    $tabFiles = ["./models/$class.php", "./models/admin/$class.php", "./models/public/$class.php","./controllers/$class.php", "./controllers/admin/$class.php", "./controllers/public/$class.php"];

    foreach($tabFiles as $file){
        if(file_exists($file)){
            require $file;
        }
    }
}
spl_autoload_register("chargement");