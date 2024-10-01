<?php

namespace MyApp\utils;

use MyApp\utils\InstanceManager;
use MyApp\utils\DB;
use MyApp\utils\CommentManager;
use MyApp\class\News;

class NewsManager extends InstanceManager
{
	/**
	* list all news
	*/
	public function listNews()
	{
		$db = DB::getInstance();
		$rows = $db->select('SELECT * FROM `news` n');

		$news = [];
		foreach($rows as $row) {

			$n = new News();
			$n->id = $row['id'];
			$n->title = $row['title'];
			$n->body = $row['body'];
			$n->createdAt = $row['created_at'];

			$news[] = $n;
		}

		return $news;
	}

	/**
	* add a record in news table
	*/
	public function addNews($title, $body)
	{
		$db = DB::getInstance();
		$sql = "INSERT INTO `news` (`title`, `body`, `created_at`) VALUES('". $title . "','" . $body . "','" . date('Y-m-d') . "')";
		$db->exec($sql);
		return $db->lastInsertId($sql);
	}

	/**
	* deletes a news, and also linked comments
	*/
	public function deleteNews($id)
	{
		$comments = CommentManager::getInstance()->listComments();
		$idsToDelete = [];

		foreach ($comments as $comment) {
			if ($comment->getNewsId() == $id) {
				$idsToDelete[] = $comment->getId();
			}
		}

		foreach($idsToDelete as $id) {
			CommentManager::getInstance()->deleteComment($id);
		}

		$db = DB::getInstance();
		$sql = "DELETE FROM `news` WHERE `id`=" . $id;
		return $db->exec($sql);
	}
}