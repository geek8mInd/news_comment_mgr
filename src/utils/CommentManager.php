<?php

namespace MyApp\utils;

use MyApp\utils\InstanceManager;
use MyApp\utils\DB;
use MyApp\class\Comment;

class CommentManager extends InstanceManager
{
	/**
	 * This function will enlist comments of all the news or just the specific ones
	 * @param int $news_id set to 0 by default to get all news; otherwise filter comments by news_id
	 * 
	 * @return array $comments list of respective comments of the news
	 */
	public function listComments($news_id = 0)
	{
		$comments = [];
		//To avoid SQL injection, ensure that $news_id is of integer type; otherwise return an empty array
		if (!is_int($news_id)) return $comments;

		$commentsQuery = ($news_id === 0)
			? 'SELECT * FROM `comment`'
			: 'SELECT * FROM `comment` WHERE news_id =' . $news_id;
		$db = DB::getInstance();
		$rows = $db->select($commentsQuery);

		foreach($rows as $row) {
			$n = new Comment();
			$n->id = $row['id'];
			$n->body = $row['body'];
			$n->createdAt = $row['created_at'];
			$n->newsId = $row['news_id'];

			$comments[] = $n;
		}

		return $comments;
	}

	public function addCommentForNews($body, $newsId)
	{
		//To avoid SQL injection, ensure that $id is an integer
		if (!is_int($newsId)) return false;

		$db = DB::getInstance();

		$sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES('". $body . "','" . date('Y-m-d') . "','" . $newsId . "')";
		$db->exec($sql);
		return $db->lastInsertId($sql);
	}

	public function deleteComment(int $id)
	{
		//To avoid SQL injection, ensure that $id is an integer
		if (!is_int($id)) return false;

		$db = DB::getInstance();
		$sql = "DELETE FROM `comment` WHERE `id`=" . $id;
		return $db->exec($sql);
	}
}