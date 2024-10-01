<?php

namespace MyApp\class;

use MyApp\class\BaseModel;

class Comment extends BaseModel
{
	protected $id, $body, $createdAt, $newsId;
}