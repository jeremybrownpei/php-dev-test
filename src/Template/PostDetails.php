<?php

namespace silverorange\DevTest\Template;

use silverorange\DevTest\Context;

class PostDetails extends Layout
{
    protected function renderPage(Context $context): string
    {
        return <<<HTML
            <h1 class="post-title">{$context->title}</h1>
            <div>{$context->content}</div>

            HTML;
    }
}
