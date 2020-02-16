<?php


class Pipeline
{
    protected $pipes = [];

    protected $passable;

    protected $method = 'handle';

    protected $container;


    public function __construct()
    {
        $this->container = $this->getContainer();
    }


    protected function pipes()
    {
        return $this->pipes;
    }


    public function send($passable)
    {
        $this->passable = $passable;
        return $this;
    }


    public function through($pipes)
    {

        $this->pipes = is_array($pipes) ? $pipes : func_get_args();
        return $this;
    }

    public function via($method)
    {
        $this->method = $method;
        return $this;
    }


    public function then(Closure $destination)
    {
        $pipeline = array_reduce($this->pipes(), $this->stacker(), $this->passable);

        return $destination($pipeline);
    }

    public function thenReturn()
    {
        return $this->then($this->container);
    }



    private function stacker()
    {
        return function ($stack, $pipe) {
            $class = new $pipe;
            return $class->{$this->method}($stack, $this->container);
        };
    }

    private function getContainer()
    {
        return function ($request) {
            return $request;
        };
    }
}
