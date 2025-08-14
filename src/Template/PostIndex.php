<?php

namespace silverorange\DevTest\Template;

use silverorange\DevTest\Context;

class PostIndex extends Layout
{
    protected function renderPage(Context $context): string
    {
        return <<<HTML
            <h1>Posts</h1>
            {$context->content}
            HTML;
    }
}
