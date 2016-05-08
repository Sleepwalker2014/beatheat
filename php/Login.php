<?php
namespace BeatHeat\Login;

use BeatHeat\SessionHandler;
use BeatHeat\Template;
use UsersQuery;

class Login
{
    /**
     * @var Template $template
     */
    private $template;
    const TEMPLATE_FILE = 'login/login.html.twig';
    /**
     * @var SessionHandler
     */
    private $sessionHandler;

    /**
     * Login constructor.
     * @param Template $template
     */
    public function __construct(Template $template, SessionHandler $sessionHandler)
    {
        $this->template = $template;
        $this->sessionHandler = $sessionHandler;
    }

    public function getHTML()
    {
        echo $this->template->getHTMLAsString(self::TEMPLATE_FILE);
    }

    public function login()
    {
        $usersQuery = new UsersQuery();

        $user = $usersQuery->filterByName('Horst')
            ->filterByPassword('Deutschrock1')
            ->findOne();

        if (!empty($user)) {
            $this->setUserAsSession($user);
            return $user;
        }

        return null;
    }

    public function setUserAsSession ($user) {
        $this->sessionHandler->setSessionUser($user);
    }
}