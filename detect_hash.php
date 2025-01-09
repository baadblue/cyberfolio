<?php

$hash = array(
    'hash' => $_POST['hash']
);
file_put_contents("data.json", json_encode($hash));
echo shell_exec("python ./assets/scripts/hash_detector.py");