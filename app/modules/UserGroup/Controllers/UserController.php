<?php
namespace UserGroup\Controllers;
use \App;
use \View;
use \Menu;
use \User;
use \Input;
use \Sentry;
use \Request;
use \Response;
use \Exception;
use \Cartalyst\Sentry\Users\UserNotFoundException;
class UserController extends \BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * display list of resource
     */
    public function index($page = 1)
    {
        $this->data['title'] = 'Users List';
        $this->data['users'] = User::where('id', '>', 0)
            ->get()
            ->toArray();
        /** render the template */
        View::display('@usergroup/user/index.twig', $this->data);
    }
}