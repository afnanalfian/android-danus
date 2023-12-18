<?php namespace App\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\Services;
 
class AuthAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $key = getenv('TOKEN_SECRET');
        if(!$session->get('logged_in')){
            return redirect()->to(base_url('/admin/signin')); 
        }
        $token = $session->get('token');

        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $ses_data = [
                'id'       => $decoded->id,
                'username' => $decoded->username,
                'email'    => $decoded->email,
                'nama'     => $decoded->nama,
                'jabatan'   => $decoded->jabatan
            ];
            $session->set($ses_data);
        } catch (\Throwable $th) {
            return redirect()->to(base_url('/admin/signin'));
        }
    }
 
    //--------------------------------------------------------------------
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}