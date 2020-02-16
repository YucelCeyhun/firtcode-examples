<?php


class Odd
{

    public function handle($request, Closure $next)
    {
        $request = array_filter($request, function ($val) {
            if ($val % 2)
                return $val;
        });

        return $next($request);
    }
}
