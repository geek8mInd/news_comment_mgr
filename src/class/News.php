<?php

namespace MyApp\class;

use MyApp\class\BaseModel;

class News extends BaseModel
{
	protected $id, $title, $body, $createdAt, $comments;
}