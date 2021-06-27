<?php
declare(strict_types=1);

namespace App\Uniphpant\Actions;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Views\PhpRenderer;

class RequestAction extends Action
{
    protected $renderer;

    public function __construct(
        LoggerInterface $logger,
        PhpRenderer $renderer
    )
    {
        parent::__construct($logger);
        $this->renderer = $renderer;
    }

    protected function action(): Response
    {
        $templatesPath = __DIR__.'/../../../templates';
        $this->renderer->setTemplatePath($templatesPath);
        return $this->renderer->render(
            $this->response,
            "default.php",
            [
                'display_text'=>'Hello World!'
            ]
        );
    }
}