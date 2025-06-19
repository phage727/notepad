<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    if ($title && $content) {
        if (!is_dir('notes')) {
            mkdir('notes');
        }
        $filename = 'notes/' . preg_replace('/[^a-zA-Z0-9_\-]/', '_', $title) . '.txt';
        file_put_contents($filename, $content);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $file_to_delete = $_POST['file_to_delete'];
    
    $file_to_delete = basename($file_to_delete);
    $filepath = "notes/" . $file_to_delete;
    
    if (file_exists($filepath)) {
        unlink($filepath); 
        header("Location: " . $_SERVER['PHP_SELF']); 
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Notepad</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            background: #007acc;
            color: #fff;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        form {
            background: #fff;
            max-width: 400px;
            margin: 30px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background: #007acc;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #005fa3;
        }
        hr {
            margin: 40px 0 20px 0;
            border: none;
            border-top: 1px solid #ccc;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .notes-list {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }
        .note-item {
    margin-bottom: 20px;
}
.note-content {
    background: #f9f9f9;
    padding: 10px;
    border-radius: 4px;
    white-space: pre-wrap;
    word-break: break-word;
    display: block;
    width: 100%;
    box-sizing: border-box;
}
.note-delete-form {
    display: inline;
}
    </style>
</head>
<body>
    <h1>My Notepad</h1>
    
    <form method="POST">
        <input type="text" name="title" placeholder="Note Title" required><br>
        <textarea name="content" placeholder="Note Content" rows="5" required></textarea><br>
        <button type="submit" name="save">Save Note</button>
    </form>

    <hr>

    <h2>Saved Notes</h2>
    <div class="notes-list">
        <?php include 'display_notes.php'; ?>
    </div>
    <div style='white-space:pre-wrap;'>
    </div>
</body>
</html>