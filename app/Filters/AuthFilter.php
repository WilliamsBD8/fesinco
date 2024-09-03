<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Config\Services;

class AuthFilter implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session()->get('user');
        if(!$session) {
            return redirect()->to('/login');
        }else if(session('user')->created_at == session('user')->updated_at){
            $request = Services::request();
            $url = $request->uri->getSegment(1);
            $method =  $request->uri->getSegment(2);
            $url_complete = base_url([$url, $method]);
            if($url_complete != base_url(['table/users']))
                return redirect()->to(base_url(['table/users']));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}