<?php
require_once __DIR__.'/../managers/todo.manager.php';
require_once __DIR__.'/../managers/auth.manager.php';
require_once __DIR__.'/../helpers/basic.controller.php';

class todoController extends basicController{
    protected $todoManager;
    protected $userManager;

    public function __construct(ItodoManager $todomgr, IuserManager $usermgr) {
        $this->todoManager = $todomgr;
        $this->userManager = $usermgr;
        parent::__construct();
    }

    public function getAll() {
        $user = $this->userManager->getCurrentUser();
        $todos = $this->todoManager->getTodos($user);
        $this->app->response->write(json_encode($todos));
        //$this->app->response->write(json_encode($user->ownTodos));
    }
    
    public function get($id) {}
    
    public function post() {
        $user = $this->userManager->getCurrentUser();
        $json_data = $this->app->request->getBody();
        
        $data = json_decode($json_data);
        $todo = $this->todoManager->createTodo($data);
        $result = $this->todoManager->assignTodoToUser($user, $todo);
        $this->app->response->write($result);
    }
    public function put($id) {}
    public function delete($id) {}
};

?>