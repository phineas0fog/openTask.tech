<?php

    /**
     * --------------------------------------------------------------------------
     *   @Copyright : License MIT 2017
     *
     *   @Author : Alexandre Caillot
     *   @WebSite : https://www.shiros.fr
     *
     *   @File : Router.php
     *   @Created_at : 03/12/2017
     *   @Update_at : 03/12/2017
     * --------------------------------------------------------------------------
     */

    class Router
    {
        private const ROUTE_NOT_FOUND = 1;
        private const ACTION_NOT_ALLOWED= 2;
        /**
         * Contient l'instance de la classe
         * @var Router
         */
        protected static $_instance;

        /**
         * Contient le chemin du fichier des routes
         * @var string
         */
        protected static $routing_path = 'config/route.php';

        /**
         * Contient la route actuelle
         * @var string
         */
        protected $path;

        /**
         * Contient toutes les routes et régles
         * @var array
         */
        protected $routes = [];

        /**
         * Chemin du dossier contenant les Controleurs
         * @var string
         */
        protected $controllerFolder;

        /**
         * Nom du controleur à utiliser
         * @var string
         */
        protected $controller;

        /**
         * Nom de la méthode à appeler
         * @var string
         */
        protected $action;

        /**
         * Contient les potentiels paramètres pour la méthode
         * @var array
         */
        protected $params;


        /**
         * Construteur de la classe 'Router', Singleton
         * @param string $filePath
         */
        protected function __construct(string $filePath) 
        {
            $this->routes = require($filePath);
        }

        /**
         * Retourne l'instance de la classe 'Router'
         *
         * @param string $filePath | Default Value => NULL
         *
         * @return Router
         */
        public static function getInstance(string $filePath = NULL) 
        {
            if(is_null($filePath))
                $filePath = self::$routing_path;

            if(is_null(self::$_instance))
                self::$_instance = new Router($filePath);
            return self::$_instance;
        }

        /* ------------------------ Init Router ------------------------ */

            /**
             * Point d'entré de l'application
             */
            public function init() 
            {
                try {
                    $this->launch();
                } catch (PDOException $exception) {
                    echo $exception->getMessage();
                    die();
                    # Gére les Exceptions de Connexion à la Base de Données
                    // $this->RenderModule->internalServerError($pdo->getMessage());
                } catch (Exception $exception) {
                    switch($exception->getCode()){
                        case self::ROUTE_NOT_FOUND:
                            header("HTTP/1.1 404 Not Found");
                            include 'view/error404.php';
                            break;
                        case self::ACTION_NOT_ALLOWED:
                            header("HTTP/1.1 401 Not Allowed");
                            include 'view/error401.php';
                            break;
                        default:
                            header("HTTP/1.1 500 Internal Error");
                            include 'view/error500.php';
                            break;
                    }
                }
            }


        /**
         * Initialise le traitement de la requête et sa redirection
         * @throws PDOException
         * @throws RouteException
         */
        protected function launch() 
        {
            # Récupération de l'URl
            $REQUEST_URI    = $_SERVER['REQUEST_URI']; // uri = url + params
            $SCRIPT_NAME    = $_SERVER['SCRIPT_NAME']; // chemin du script appellé, ici index.php,

            # Découpe de l'Url, retire de l'url tout ce qui est avant "index.php"
            $requestTab = $this->formatRequest($REQUEST_URI, $SCRIPT_NAME);

            # Netoyage des values vides (supprime les index vides)
            $requestTab = $this->clearRoute($requestTab);

            // récupère l'url et la compare aux routes définies dans "config/route.php"
            $route = $this->matchRoute($requestTab);

            // place dans le nom du controller dans une variable de la classe et l'action dans une autre variable
            $this->createRoute($route);

            // vérifie que le controlleur a le droit d'appeller la méthode demandée
            $this->checkAccessPermissions();

            $class = $this->controller;
            $controller = new $class();

            if (!method_exists($controller, $this->action)) {
                throw new RouteException("ROUTE_NOT_FOUND", self::ROUTE_NOT_FOUND);
            } else {
                $action = $this->action;
            }

            if (empty($this->params)) {
                $controller->$action();
            } else {
                call_user_func_array(array($controller, $action), $this->params);
            }
        }


        /* ------------------------ Check ------------------------ */

            /**
             * Vérifie que la requête correspond à une régle de routage
             * Exemple :
             * - Request ('/Test') == Route ('/Test')
             * - Request ('/Test/Testy') == Route ('/Test/:name')
             *
             * @param array $route
             * @param array $request
             *
             * @return bool
             */
            protected function checkRoute(array $route, array $request): bool 
            {
                $size = count($route);

                for ($i=0; $i < $size; $i++) {
                    if ($route[$i] === $request[$i] || $route[$i][0] === ':') {
                        continue;
                    } else {
                        return false;
                    }
                }
                return true;
            }

            /**
             * Vérifie que l'utilisateur à les droits nécéssaire pour acceder à la ressource
             */
            protected function checkAccessPermissions() 
            {
                $action = array('login', 'register', 'registerHandl', 'checkLogin');
                switch($this->controller) {
                    case 'UserController':
                        if (!in_array($this->action, $action))
                            if (!isset($_SESSION['userId']))
                                throw new Exception("ACTION_NOT_ALLOWED", self::ACTION_NOT_ALLOWED);
                        break;

                    default :
                        break;
                }
            }

            /**
             * Permet de voir si la route existe, puis retourne le controleur et la méthode à utiliser pour cette requête
             *
             * @param array $requestTab
             *
             * @return string
             * @throws RouteException
             */
            protected function matchRoute(array $requestTab): string 
            {
                $requestTab = $this->clearRoute($requestTab);

                if(empty($requestTab)) { array_push($requestTab, "/"); 
                } // pour mettre "/" dans le tableau si celui ci est vide
                $routes = $this->getRoutes($this->routes);

                foreach ($routes as $route) {
                    $route = $this->clearRoute($route);

                    if (count($route) === count($requestTab) && $this->checkRoute($route, $requestTab)) {
                        $this->params = $this->getParams($route, $requestTab); // récupère les paramètres dans l'url par rapport au pattern renseigné (:id)
                        $path = $this->createPath($route); // reconstitue une route

                        $this->path = $path;
                        return $this->routes[$path];
                    }
                }

                throw new Exception("ROUTE_NOT_FOUND", self::ROUTE_NOT_FOUND);
            }


        /* ------------------------ Route Getter ------------------------ */

            /**
             * Recupère les routes (règles de routage) et décompose les régles
             * Exemple :
             * - array(
             *     '/' => ...,
             *     '/Test' => ...,
             *     '/Test/:name' => ...,
             * )
             *
             * <=> array(
             *     0 => array('/'),
             *     1 => array('Test'),
             *     2 => array('Test', ':name'),
             * )
             *
             * @param array $lists
             *
             * @return array
             */
            protected function getRoutes(array $lists): array 
            {
                $routes = array();
                foreach ($lists as $key => $value) {
                    $explode = (($key == '/') ? array('/') : explode('/', $key));
                    array_push($routes, $explode);
                }
                return $routes;
            }

            /**
             * Retourne les paramètres s'il y en a
             * Exemple :
             * - Request ('/Test/Testy') && Route ('/Test/:name') => Param['name'] = 'Testy'
             *
             * @param array $route
             * @param array $request
             *
             * @return array
             */
            protected function getParams(array $route, array $request): array 
            {
                $params = array();
                $size = count($route);

                for ($i=0; $i < $size; $i++) {
                    if ($route[$i][0] === ':') {
                        array_push($params, rawurldecode($request[$i]));
                    }
                }

                return $params;
            }


        /* ------------------------ Format & Create ------------------------ */

            /**
             * Formate la Requête
             *
             * @param string $REQUEST_URI
             * @param string $SCRIPT_NAME
             *
             * @return array
             */
            protected function formatRequest(String $REQUEST_URI, String $SCRIPT_NAME): array 
            {
                $REQUEST_URI = preg_replace('#\?[^>]*$#', '', $REQUEST_URI);

                $requestTab        = explode('/', $REQUEST_URI);
                $scriptTab        = explode('/', $SCRIPT_NAME);

                foreach ($requestTab as $key => $value) {
                    if (in_array($value, $scriptTab)) {
                        unset($requestTab[$key]);
                    }
                }

                return array_values($requestTab);
            }

            /**
             * Nettoie la route en enlevant les valeurs vides
             *
             * @param array $requestTab
             *
             * @return array
             */
            protected function clearRoute(Array $requestTab): array 
            {
 return array_values(array_filter($requestTab)); 
            }

            /**
             * Créer le chemin pour récupérer le controleur et sa méthode par la suite
             * Exemple :
             * - array(
             *     0 => 'Test',
             *     1 =>':name',
             * )
             *
             * <=> 'Test/:name'
             *
             * @param array $path
             *
             * @return string
             */
            protected function createPath(array $path): string 
            {
                $path = implode('/', $path);
                return (($path === DIRECTORY_SEPARATOR) ? $path : DIRECTORY_SEPARATOR . $path);
            }

            /**
             * Créer la route à appeler (Controleur / Méthode / Paramètres)
             *
             * @param string $route
             */
            protected function createRoute(string $route) 
            {
                # Parse de la Route
                $route = explode('.', $route);

                # Définition de la méthode
                $this->action = end($route);

                # Définition du Controller
                $key = array_search($this->action, $route);
                unset($route[$key]);
                $this->controller = array_shift($route);
            }
    }
