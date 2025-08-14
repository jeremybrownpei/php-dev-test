<?php

namespace silverorange\DevTest\Model;

use silverorange\DevTest\Database;
use silverorange\DevTest\Config;

class Post
{
    public string $id;
    public string $title;
    public string $body;
    public string $created_at;
    public string $modified_at;
    public string $author;


    public static function getAllPostsIds(): object|array
    {
        $config = new Config();
        $db = (new Database($config->dsn))->getConnection();
        $q = $db->prepare('SELECT id FROM posts');
        $q->execute();
        return $q->fetchAll(\PDO::FETCH_COLUMN);
    }

    public static function getAllPostsListReverseOrder(): object|array
    {
        $config = new Config();
        $db = (new Database($config->dsn))->getConnection();
        $q = $db->prepare('SELECT id, title, author FROM posts ORDER BY created_at DESC');
        $q->execute();
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function insertPost(string $id, string $title, string $body, string $created_at, string $modified_at, string $author): bool
    {
        $config = new Config();
        $db = (new Database($config->dsn))->getConnection();
        $q = $db->prepare('INSERT INTO posts (id, title, body, created_at, modified_at, author) VALUES (:id, :title, :body, :created_at, :modified_at, :author)');
        return $q->execute([
            ':id' => $id,
            ':title' => $title,
            ':body' => $body,
            ':created_at' => $created_at,
            ':modified_at' => $modified_at,
            ':author' => $author,
        ]);
    }

    public static function getPostById(string $id): object|array
    {
        $config = new Config();
        $db = (new Database($config->dsn))->getConnection();
        $q = $db->prepare('SELECT * FROM posts WHERE id = :id');
        $q->execute([':id' => $id]);
        $data = $q->fetch(\PDO::FETCH_OBJ);

        return $data ? $data : [];
    }
}
