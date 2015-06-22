<?php

namespace Starkerxp\CQRSESBundle\Services\Query;

use \Starkerxp\CQRSESBundle\Services\Bus\AbstractBus;

class QueryBus extends AbstractBus
{

    protected $handlers = [];

    public function handle(QueryInterface $action)
    {
        $actionHandler = $this->handlers[get_class($action)];
        return $actionHandler->handle($action);
    }

    public function register(QueryHandlerInterface $handler)
    {
        $queryClass = $this->str_lreplace('Handler', '', get_class($handler));
        $this->handlers[$queryClass] = $handler;
    }

}
