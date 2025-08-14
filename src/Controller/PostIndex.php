<?php

namespace silverorange\DevTest\Controller;

use silverorange\DevTest\Context;
use silverorange\DevTest\Model\Post;
use silverorange\DevTest\Model\Author;
use silverorange\DevTest\Template;

class PostIndex extends Controller
{
    /**
     * @var array<Post>
     */
    private array $posts = [];

    public function getContext(): Context
    {
        $context = new Context();
        $context->title = 'Posts';
        //$context->content = strval(count($this->posts));
        $context->content = $this->renderList();
        return $context;
    }

    public function getTemplate(): Template\Template
    {
        return new Template\PostIndex();
    }

    protected function loadData(): void
    {
        // TODO: Load posts from database here.
        // $this->posts = [];
        $this->posts = Post::getAllPostsListReverseOrder();
    }

    public function renderList(): string
    {
        $html = '<div class="post-list">';
        foreach ($this->posts as $post) {
            $author_name = Author::getAuthorById($post['author']);
            $html .= '<a href="posts/' . $post['id'] . '" class="post-list-item">';
            $html .= '<h2>' . $post['title'] . '</h2>';
            $html .= '<div>Author: ' . $author_name['full_name'] . '</div>';
            $html .= '</a>';
        }
        $html .= '</div>';
        return $html;
    }
}
