<?php
class Route{
	//хранит временную метку начала исполнения скрипта
	static $start_script;
	//метод start() вызывается при каждом обращении к форуму
    static function start(){ 
		session_start();
		//получаем временную метку начала исполнения скрипта
		Route::$start_script = microtime(true);
		// укажем временную зону
		date_default_timezone_set(time_zone);
        // контроллер и действие по умолчанию
        $controller_name = 'auth';
        $action_name = 'index';
		//убираем прересылаемые методом GET данные из url
		$url = explode('?',$_SERVER['REQUEST_URI']);
		//разбираем url на части, где первая часть это имя контроллера, вторая - имя метода
        $routes = explode('/', $url[0]);
		if(isset($_SESSION['user_name'],$_SESSION['user_id']) || ($routes[1]=='auth' && $routes[2]=='check')){
			$controller_name = 'main';
			$action_name = 'index';
			// получаем имя контроллера
			if (!empty($routes[1])){	
				$controller_name = $routes[1];
			}
			// получаем имя метода контроллера
			if (!empty($routes[2]) ){
				$action_name = $routes[2];
			}
		}
        // добавляем префиксы и делаем первую букву префикса контроллера и модели заглавной
        $model_name = 'Model_'.ucfirst($controller_name);
        $controller_name = 'Controller_'.ucfirst($controller_name);
        $action_name = 'action_'.$action_name;
        // создаем контроллер (если файла с классом контроллера не будет найдено на сервере, бросим в автоподгрузке классов на страницу 404)
        $controller = new $controller_name;
        $action = $action_name;
		//если метод существует, вызываем метод (действие) контроллера, иначе бросаем на страницу 404
		if(method_exists($controller, $action)){
            $controller->$action();	
        }else{
			Route::ErrorPage404();
        }
    }
    //статический метод, генерирует страницу 404
    static function ErrorPage404(){	
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		header("Location: ".$host."404.html");
		exit;
    }
}
?>
