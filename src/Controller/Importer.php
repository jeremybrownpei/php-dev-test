<?php

namespace silverorange\DevTest\Controller;

use silverorange\DevTest\Context;
use silverorange\DevTest\Template;
use silverorange\DevTest\Model\Post;

class Importer extends Controller
{
    public function getContext(): Context
    {
        $context = new Context();
        $context->title = 'Importer';
        $context->content = $this->importData();

        return $context;
    }

    public function getTemplate(): Template\Template
    {
        return new Template\Importer();
    }

    public function importData(): string
    {
        $return = '';

        $postIds = Post::getAllPostsIds();

        $data_dir = __DIR__ . '/../../data';
        $files = scandir($data_dir);
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                $jsonString = file_get_contents($data_dir . '/' . $file);
                $data = json_decode($jsonString, true);

                /** @var string $id */
                $id = $data['id'] ?? '';
                /** @var string $title */
                $title = $data['title'] ?? '';
                /** @var string $body */
                $body = $data['body'] ?? '';
                /** @var string $created_at */
                $created_at = $data['created_at'] ?? '';
                /** @var string $modified_at */
                $modified_at = $data['modified_at'] ?? '';
                /** @var string $author */
                $author = $data['author'] ?? '';

                //Check if post exists
                if (!in_array($id, $postIds) && is_array($data)) {
                    if (Post::insertPost($id, $title, $body, $created_at, $modified_at, $author)) {
                        $return .= "<br>Imported post with id {$id}";
                    } else {
                        $return .= "<br>Failed to import post with id {$id}";
                    }
                } else {
                    $return .= "<br>Post with id {$id} already exists. Skipping import.";
                }
            }
        }

        if (empty($files)) {
            $return = "<br>No JSON files found for import.";
        }

        return $return;
    }
}
