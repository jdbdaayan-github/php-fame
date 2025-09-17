<?php
namespace System\Http;

use System\Application;

class Kernel
{
    protected Router $router;
    protected Application $app;
    protected bool $routesLoaded = false;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->router = new Router();
        // ❌ Don't load routes here to avoid circular dependency
    }

    public function loadRoutes()
    {
        if (!$this->routesLoaded) {
            require base_path('routes/web.php');
            $this->routesLoaded = true;
        }
    }

    public function router(): Router
    {
        return $this->router;
    }

    public function handle()
    {
        $request = Request::capture();
        $response = $this->router->dispatch($request);
        $response->send();
    }
}
