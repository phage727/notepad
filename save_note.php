<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    $title = htmlspecialchars(trim($title));
    $content = htmlspecialchars(trim($content));
    
    if (!is_dir('notes')) {
        mkdir('notes', 0755, true);
    }
    
    $filename = "notes/" . ".txt";
    
    file_put_contents($filename, $content);
    
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}
?>