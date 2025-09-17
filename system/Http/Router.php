<?php
namespace System\Http;

class Router
{
    protected array $routes = [];

    public function get(string $uri, $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post(string $uri, $action)
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch(Request $request): Response
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

        $action = $this->routes[$method][$uri] ?? null;

        if (!$action) {
             abort(404, 'Page Not Found');
        }

        if (is_array($action)) {
            [$controller, $method] = $action;
            $controller = new $controller();
            $result = $controller->$method($request);
        } else {
            $result = call_user_func($action, $request);
        }

        return $result instanceof Response
            ? $result
            : (new Response())->setContent($result);
    }
}
