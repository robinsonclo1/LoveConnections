<?php

class UploadHelper
{

	public static function init(&$conn)
	{
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			return;
		}

		try {
			if (self::problemWithUpload()) {
				throw new \Exception('Problem Uploading File');
			}

			$file = $_FILES['upload'];
      $memberID = $_SESSION['id'];
			$name = $file['name'];
			$type = $file['type'];
			$size = $file['size'];
			$tmpPath = $file['tmp_name'];

			$stream = fopen($tmpPath, 'r');
			$data = fread($stream, $size);
			fclose($stream);


			$stmt = $conn->prepare('INSERT INTO profilePictures(
        memberID_FK,filename,filetype,filedata) VALUES(?,?,?,?)');
			$stmt->bind_param('isss', $memberID, $name, $type, $data);

			if (!$stmt->execute()) {
				throw new \Exception($stmt->error);
			}

			return 'Image uploaded successfully!';

		} catch (\Throwable $e) {
			return $e->getMessage();
		}
	}

	public static function getImages(&$conn) {
		$result = $conn->query('SELECT * FROM profilePictures WHERE memberID_FK = ' . $_SESSION['id']);

		return $result ? $result : [];
	}

	private static function problemWithUpload()	{
		return !isset($_FILES['upload']) ||
				!file_exists($_FILES['upload']['tmp_name']) ||
				$_FILES['upload']['error'] > 0;
	}
}
