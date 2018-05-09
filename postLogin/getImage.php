<?php
require_once 'includes/connection.php';

// would be in URL like /get-image.php?id=101
$id = $_GET['id'] ?? null;

if ($id === null) {
	return;
}

$stmt = $conn->prepare('SELECT * FROM pictures WHERE id = ?');
$stmt->bind_param('i', $id);

if (!$stmt->execute()) {
	return;
}

$result = $stmt->get_result();
$img = $result->fetch_object();

header('Content-type: ' . $img->filetype);
echo $img->filedata;