<?php
namespace System;

use System\Http\Kernel;
use System\Http\Router;

class Application
{
    protected ?Kernel $kernel = null; // nullable to prevent typed property error
    protected static ?Application $instance = null;

    public function __construct()
    {
        self::$instance = $this;
        // ❌ Don't initialize Kernel here
    }

    public static function getInstance(): ?Application
    {
        return self::$instance;
    }

    public function router(): Router
    {
        return $this->getKernel()->router();
    }

    protected function getKernel(): Kernel
    {
        if ($this->kernel === null) {
            $this->kernel = new Kernel($this);
        }
        return $this->kernel;
    }

    public function run()
    {
        $this->getKernel()->loadRoutes(); // load routes lazily
        $this->getKernel()->handle();
    }
}
