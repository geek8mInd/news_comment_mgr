<?php
require_once realpath("vendor/autoload.php");

use MyApp\class\Comment;
use MyApp\utils\NewsManager;
use MyApp\utils\CommentManager;

$newsManager = NewsManager::getInstance('MyApp\utils\NewsManager')->listNews();
foreach ($newsManager as $news) {
	echo("############ NEWS " . $news->id . " ############\n");
	echo($news->body . "\n");
	$commentManager = CommentManager::getInstance('MyApp\utils\CommentManager')->listComments($news->id);
	foreach ($commentManager as $comment) {
		echo("Comment " . $comment->id . " : " . $comment->body . "\n");
	}
}

$commentManager = CommentManager::getInstance('MyApp\utils\CommentManager');
$c = $commentManager->listComments();