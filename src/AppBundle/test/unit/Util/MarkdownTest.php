<?php
namespace AppBundle\Utils;

class MarkdownTest extends \Codeception\TestCase\Test
{
    /**
     * @var Markdown
     */
    protected $markdown;
    
    protected function _before()
    {
        $this->markdown = new Markdown();
    }

    public function testBasicMarkdownParsing()
    {
        $this->assertEquals(
            "<p><strong>Hello</strong></p>",
            $this->markdown->toHtml("**Hello**")
        );
    }

}