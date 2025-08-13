<?php

namespace silverorange\DevTest\Template;

use silverorange\DevTest\Context;

/**
 * Template for the importer page
 */
class Importer extends Layout
{
    protected function renderPage(Context $context): string
    {
        $content = $this->header->render($context);

        return <<<HTML
                <h1>Importer</h1>
                <p>Welcome to the importer page.</p>
                <p>{$context->content}</p>
            HTML;
    }
}
