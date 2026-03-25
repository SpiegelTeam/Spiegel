<?php
$conn = new mysqli('localhost', 'root', '', 'spiegeldb');
if (!$conn) {
    echo "Error!: {$conn->connect_error}";
}
