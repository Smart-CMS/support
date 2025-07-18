<?php

namespace SmartCms\Support\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;

/**
 * Class Html Minifier.
 */
class HtmlMinifier
{
    private $replace = [
        '/<!--[\s\S]*?-->/' => '', // remove comments
        "/<\?php/" => '<?php ',
        "/\n([\S])/" => '$1',
        "/\r/" => '', // remove carriage return
        "/\n/" => '', // remove new lines
        "/\t/" => '', // remove tab
        "/\s+/" => ' ', // remove spaces
        '/> +</' => '><',
    ];

    /**
     * @param  $htmlString  string
     */
    public function minify(string $htmlString): string
    {
        return preg_replace(array_keys($this->replace), array_values($this->replace), $htmlString);
    }

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        // wire:ignore dont work with that, so temporary disabled
        // $response->setContent($this->minify($response->getContent()));

        return $response;
    }
}
