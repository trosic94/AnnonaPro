<?php

namespace App\Http\Middleware;

use Closure;
use Route;

class DevelopmentAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $ipWhitelist = ['93.87.74.50'];
    //protected $ipWhitelist = ['10.110.113.110', '::80'];

    public function handle($request, Closure $next)
    {
        if (app()->environment() != 'production' && $this->clientNotAllowed()) {
            //return abort(403, 'You are not authorized to access this');
            return redirect('dev');
        }

        return $next($request);
        
    }

    /**
     * Checks if current request client is allowed to access the app.
     *
     * @return boolean
     */

    protected function clientNotAllowed()
    {
        $isAllowedIP = in_array(request()->ip(), $this->ipWhitelist);

        return (!$isAllowedIP && auth()->guest()) || ($isAllowedIP && !auth()->guest());
    }
}
