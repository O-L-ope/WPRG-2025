<?php
function isPangram($param) {
    $sentences = strtolower(trim($param));
    $letters = str_split("thequickbrownfoxjumpsoverthelazydog");
    foreach($letters as $letter) {
        if(!strstr($sentences, $letter))
            return "false";
    }
    return "true";

}
$param = "The quick brown fox jumps over the lazy dog";
echo isPangram($param);
?>