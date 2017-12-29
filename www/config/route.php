<?php

/**
 * Routes config
 * Here are all the routes declarations.
 * The first column is the route (url) and the second col is the controller.action
 * who must to be called.
 *
 * Example: '/' => 'VisitorController.call',
 * this line say "when the url is '/', call the method 'call' of the controller 'VisitorController'"
 */

return [
    '/'                        => 'VisitorController.call',

    '/public/project/add'      => 'VisitorController.createProject',
    '/public/project/:id'      => 'VisitorController.tasks',
    '/public/project/del/:id'  => 'VisitorController.removeProject',

    '/task/add'                => 'VisitorController.createTask',

    '/task/state/:id'          => 'VisitorController.changeState',
    '/task/del/:id'            => 'VisitorController.removeTask',

    '/private/project/add'     => 'UserController.createProject',
    '/private/project/:id'     => 'UserController.tasks',
    '/private/project/del/:id' => 'UserController.removeProject',

    '/login'                   => 'UserController.login',
    '/logout'                  => 'UserController.logout',
    '/checkLogin'              => 'UserController.checkLogin',
    '/register'                => 'UserController.register',
    '/registerHandl'           => 'UserController.registerHandl',
    '/about'                   => 'VisitorController.about'
];
