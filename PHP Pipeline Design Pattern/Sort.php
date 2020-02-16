<?php


class Sort
{

    public function handle($request,Closure $next){
        rsort($request);
        return $next($request);
    }

}