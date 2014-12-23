<?php
class Model{
	//счетчик запросов к базе данных
	private $counter=0;
	//объект класса MySqli
	private $mysqli=null;
	//хранит время выполнения запроса к базе 
	private $mytime=0;
	//хранит начальную метку времени соединения с бд
	private $start_time;
	//флаг, true- соединение с базой данных установлено, false-нет
	private $flag=false;
	//подключение к базе данных
	public function connect(){
		//проверяем, установлено ли соединение с БД ранее
		if(!$this->flag){
			$this->start_time=microtime(true);
			$this->mysqli=new mysqli(db_host,db_username,db_pass,db_name);
			//проверяем, что соединение с базой данных установлено и нет ошибок
			if ($this->mysqli->connect_error){
				die('Ошибка подключения к бд!('.$this->mysqli->connect_errno.')'. $this->mysqli->connect_error);
			}
			//на всякий случай зададим кодировку
			$this->mysqli->query("SET NAMES utf8");
			//задаем наборр символов по умолчанию
			$this->mysqli->set_charset('utf8');
			//задаем временную зону
			$this->mysqli->query("SET TIME ZONE ".time_zone);
			$this->flag=true;
		}
	}
	//отключение от базы данных
	public function disconnect(){
		//если были соеденины, отключаемся
		if($this->flag){
			$this->mysqli->close();
			$this->mytime=microtime(true)-$this->start_time;
			unset($this->mysqli);
			$this->flag=false;
		}
	}
	//запрос к базе данных, возвращающий результирующий набор, полученный из БД 
	public function query_todb($query){
		//если соединение установлено, выполняем, в противном случае выбрасываем false
		if($this->flag){
			$this->counter++;
			return $this->mysqli->query($query,MYSQLI_STORE_RESULT);
		}else{
			return false;
		}
	}
	//метод выполняет запрос к базе данных и получает результат в виде ассоциативного массива 
	public function get_dataAr($str){
		//если есть соединение с БД, выполняем, иначе выбрасываем false
		if($this->flag){
			//увеличиваем показания счетчика, учитывающего запросы к базе данных
			$this->counter++;
			//если результат отрицательный (не нашли результата) возвращаем false
			if(!$result=$this->mysqli->query($str,MYSQLI_STORE_RESULT)){
				return false;
			}
			//если все-же результат есть, обрабатываем
			if($result->num_rows>=1){
				$i=0;
				$ar=null;
				//вытягиваем в цикле результат
				while($a=$result->fetch_assoc()){
					$ar[$i++]=$a;
				}
				$result->close();
				return $ar;
			}
			return false;
		}else{
			return false;
		}
	}
	//метод возвращает время выполнения запросов к БД
	public function get_exec_Time(){
		return $this->mytime;
	}
	//метод возвращает количество выполненных запросов к БД
	public function get_count_query(){
		return $this->counter; 
	}
	//очищаем запрос для избежания sql инъекций
	public function clean_query($query){
		return $this->mysqli->real_escape_string($query);
	}
}
?>