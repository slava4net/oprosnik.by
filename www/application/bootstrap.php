<?php
//функция автоподгрузки классов
function my_autoload($name_class){
	/*проверяем, содержится ли в папке application/core искомый класс, если находим,
	подключаем, иначе смотрим в папке application/controllers или application/mdoels*/
	if(file_exists('application/core/'.$name_class.'.php')){
		require_once 'application/core/'.$name_class.'.php';
	}else if(file_exists('application/controllers/'.$name_class.'.php')){
		require_once 'application/controllers/'.$name_class.'.php';
	}else if(file_exists('application/models/'.$name_class.'.php')){
		require_once 'application/models/'.$name_class.'.php';
	}else{
		$a = true;
		//если не находим файла подключаемого класса, бросаем на страницу 404
        if ((class_exists($name_class,FALSE)) || (strpos($name_class, 'PHPExcel') !== 0)) {
            //    Either already loaded, or not a PHPExcel class request
            $a = FALSE;
        }

        $pClassFilePath = 'application/core/'.
                          str_replace('_',DIRECTORY_SEPARATOR,$name_class) .
                          '.php';

        if ((file_exists($pClassFilePath) === FALSE) || (is_readable($pClassFilePath) === FALSE)) {
            //    Can't load
            $a = FALSE;
        }
        require($pClassFilePath);
		if(!$a)
			Route::ErrorPage404(); 
		// die('просто сдох-'.$name_class);
	}
}
//регистрируем функцию my_autoload в качестве реализации метода __autoload()
spl_autoload_register('my_autoload'); 
 
// запускаем маршрутизатор
Route::start(); 
?>