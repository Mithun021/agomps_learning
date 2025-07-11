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

        // Debugging: Print session contents and stop execution
        echo "<pre>";
        print_r($session->get()); // Print full session data
        echo "</pre>";

        // Optional: Check if adminLoginned is set
        if (!$session->get('adminLoginned')) {
            die("adminLoginned session key not found. Check session setup."); // Stop execution
        }

        // For success, allow request to continue (do nothing)
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
