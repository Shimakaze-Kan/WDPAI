<?php

class AppController
{
    private $request;

    public function __construct()
    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }

    protected function isGet(): bool
    {
        return $this->request === 'GET';
    }

    protected function isPost(): bool
    {
        return $this->request === 'POST';
    }

    protected function isCookieSetted(): bool
    {
        if(isset($_COOKIE['loginCredentials']) && !empty(isset($_COOKIE['loginCredentials'])))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    protected function render(string $template = null, array  $variables = [])
    {
        $templatePath = 'public/views/'.$template.'.php';
        $output = 'file not found';

        if(file_exists($templatePath))
        {
            extract($variables);
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    }
}