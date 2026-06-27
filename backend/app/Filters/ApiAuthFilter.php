<?php

namespace AppFilters;

use AppModelsUserModel;
use CodeIgniterFiltersFilterInterface;
use CodeIgniterHTTPRequestInterface;
use CodeIgniterHTTPResponseInterface;

class ApiAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeaderLine('Authorization');
        $token = trim(str_replace('Bearer', '', $header));
        if (!$token || !(new UserModel())->where('token', $token)->first()) {
            return service('response')->setStatusCode(401)->setJSON(['status' => 401, 'error' => 'Unauthorized']);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
