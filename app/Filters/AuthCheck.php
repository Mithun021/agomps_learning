<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthCheck implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check session for login
        if (!session()->get('isLoggedIn')) {
            // Redirect to login page with a flash message
            return redirect()->to('user-login')->with('status', 
                '<div class="alert alert-warning" role="alert">Please log in to access that page.</div>'
            );
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing to do here
    }
}
