<?php

namespace AppFilters;

use CodeIgniterFiltersFilterInterface;
use CodeIgniterHTTPRequestInterface;
use CodeIgniterHTTPResponseInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/user/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
