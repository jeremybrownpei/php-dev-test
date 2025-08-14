<?php

namespace silverorange\DevTest\Model;

use silverorange\DevTest\Database;
use silverorange\DevTest\Config;

class Author
{
    public string $id;
    public string $full_name;
    public string $created_at;
    public string $modified_at;

    public static function getAuthorById(string $id): object|array
    {
        $config = new Config();
        $db = (new Database($config->dsn))->getConnection();
        $q = $db->prepare('SELECT * FROM authors WHERE id = :id LIMIT 1');
        $q->execute(array(':id' => $id));
        return $q->fetch(\PDO::FETCH_ASSOC);
    }
}
