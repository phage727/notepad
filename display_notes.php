<?php
$notesDir = 'notes/';
if (is_dir($notesDir)) {
    $files = array_diff(scandir($notesDir), array('.', '..'));
    if (count($files) === 0) {
        echo "<p>No notes saved yet.</p>";
    } else {
        foreach ($files as $file) {
            $title = basename($file, '.txt');
            $content = htmlspecialchars(file_get_contents($notesDir . $file));
            $content = nl2br($content);
            echo "<div class='note-item'>";
            echo "<strong>" . htmlspecialchars($title) . "</strong><br>";
            echo "<div class='note-content'>" . $content . "</div>";
            echo "<form method='POST' class='note-delete-form'>
                    <input type='hidden' name='file_to_delete' value='" . htmlspecialchars($file) . "'>
                    <button type='submit' name='delete'>Delete</button>
                  </form>";
            echo "</div>";
        }
    }
} else {
    echo "<p>No notes directory found.</p>";
}
?>