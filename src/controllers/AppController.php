<?php

require_once __DIR__ . '/../repository/UserRepository.php';

class AppController
{
    private $request;
    private $userRepository;

    public function __construct()
    {
        session_start();
        $this->request = $_SERVER['REQUEST_METHOD'];
        $this->userRepository = new UserRepository();
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
        if (isset($_COOKIE['user']) && !empty(isset($_COOKIE['user']))) {
            return true;
        } else {
            return false;
        }
    }

    protected function render(string $template = null, array $variables = [])
    {
        $templatePath = 'public/views/' . $template . '.php';
        $output = 'file not found';

        if (file_exists($templatePath)) {
            extract($variables);
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }

        print $output;
    }

    protected function checkCurrentUserActiveStatus(): void
    {
        if (isset($_SESSION['user_id']) && !$this->userRepository->getUserActiveStatus($_SESSION['user_id'])) {
            setcookie("user", "", time() - 3600);
            session_destroy();
        }
    }
}