<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class IsAdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        log_message('debug', 'Session in Filter: ' . print_r($session->get(), true));
        if (!$session->get('adminLoginned')) {
            return redirect()->to(base_url('admin/login'))->with('fail', 'You must be logged in');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}

