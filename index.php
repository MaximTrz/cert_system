<?php require 'db.php'; ?>
<? if( isset($_SESSION['logged_user']) or isset($_COOKIE['logged_user'])):?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Система учета сертификатов</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.footer.css" rel="stylesheet">
        <script src="http://code.jquery.com/jquery-3.3.1.js"></script>
<!--        <script type="text/javascript" src="js/addcert.js"></script>-->
<!--	<link href="css/style.css" rel="stylesheet">-->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	  <![endif]-->
        
	</head>
        <body>
<div class="container wrapper">

<nav id="nav" class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?=$_SERVER['SCRIPT_NAME']?>">Система учета сертификатов</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown active">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Сертификаты<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=$_SERVER['SCRIPT_NAME']?>">Текущие</a></li>
            <li><a href="<?=$_SERVER['SCRIPT_NAME']?>?action=oldCerts">Просроченные</a></li>
          </ul>
        </li>
        <li><a href="<?=$_SERVER['SCRIPT_NAME']?>?action=allUsers">Пользователи</a></li>
        <li><a href="<?=$_SERVER['SCRIPT_NAME']?>?action=allSystems">Системы</a></li>
        <li><a href="<?=$_SERVER['SCRIPT_NAME']?>?action=formCert">Добавить новый сертификат</a></li>
        <li><a href="/logout.php">Выйти</a></li>
      </ul>
    </div>
  </div>
</nav>
    <div class="content">
<?php
////// Здесь надо подключить все файлы моделей, классов и пр.
include_once ('config.php');
include_once ('models/dataBase.php');
include_once ('models/superModel.php');
include_once ('models/MainModel.php');
include_once ('models/certsModel.php');
include_once ('models/certsLinkModel.php');
include_once ('models/usersModel.php');
include_once ('models/systemsModel.php');
include_once ('controllers/superController.php');
include_once ('controllers/certsController.php');
include_once ('controllers/certsLinkController.php');
include_once ('controllers/mainController.php');
include_once ('controllers/usersController.php');
include_once ('controllers/systemsController.php');

    
    // считываем парамерты подключения к БД из файла config.php
    $host = $config['db']['host'];
    $username = $config['db']['user'];
    $password = $config['db']['pass'];
    $dbname = $config['db']['name'];
    
    // создаем экземпляр класа БД
    $db = new dataBase($host, $username, $password, $dbname);

    //// Проверяем указано ли действие при запуске скрипта
    if (isset($_REQUEST['action'])) {

    $action= trim($_REQUEST['action']);
    $delete= trim($_REQUEST['delete']);
    
    
    	switch ($action) {
            

            ///Отображение списка пользователей
            case 'allUsers':
                
                /// создаем новый экземпляр контроллера 
                $users = new usersController('usersView.php');
                
                /// создаем экземпляр модели
                $usersModel = new usersModel($db);
                
                /// получаем список всех пользователей 
                $usersList = $usersModel->getAll();
                               
                // подключаем представление
                $users->displayView();
                
                
                
            break;
            /// Добавление нового пользователя
            case 'addUsers':
                
                /// создаем новый экземпляр контроллера 
                $users = new usersController('usersView.php');
                
                $users->getInput();
                
                /// создаем экземпляр модели
                $usersModel = new usersModel($db);
                
                /// Отправляем нового пользователя 
                $usersModel->addNew($users->userName);

                /// получаем список всех пользователей 
                $usersList = $usersModel->getAll();
                
                /// подключаем представление
                $users->displayView();
                
            break;
            /// Удаление пользователя
            case 'deleteUser':
                
                /// создаем новый экземпляр контроллера 
                $users = new usersController('usersView.php');
                
                $users->getInput();
                
                /// создаем экземпляр модели
                $usersModel = new usersModel($db);
                
                /// Удаление пользователя 
                $usersModel->delOne();

                /// получаем список всех пользователей 
                $usersList = $usersModel->getAll();
                
                /// подключаем представление
                $users->displayView();
                
            break;
            ///Отображение списка систем
            case 'allSystems':

                /// создаем новый экземпляр контроллера 
                $systems = new systemsController('systemsView.php');

                /// создаем экземпляр модели
                $systemsModel = new systemsModel($db);

                /// получаем список всех систем 
                $systemsList = $systemsModel->getAll();

                // подключаем представление
                $systems->displayView();

            break;
            ///удаление системы
            case 'deleteSystem':

                /// создаем новый экземпляр контроллера 
                $systems = new systemsController('systemsView.php');

                /// создаем экземпляр модели
                $systemsModel = new systemsModel($db);
                
                /// Удаление системы 
                $systemsModel->delOne();

                /// получаем список всех систем 
                $systemsList = $systemsModel->getAll();

                // подключаем представление
                $systems->displayView();

            break;
            ///Добавление новой системы
            case 'addSystems':
                
                /// создаем новый экземпляр контроллера 
                $systems = new systemsController('systemsView.php');
                
                $systems->getInput();
                
                
                /// создаем экземпляр модели
                $systemsModel = new systemsModel($db);
                
                /// Добавляем новую систему 
                $systemsModel->addNew($systems->systemName);

                /// получаем список всех систем 
                $systemsList = $systemsModel->getAll();
                
                /// подключаем представление
                $systems->displayView();
                
            break;
            ///Форма добавления нового сертификата
            case 'formCert':
                
                /// создаем новый экземпляр контроллера 
                $certs = new certsController('certsView.php');
           
                /// создаем экземпляр модели
                $certsModel = new certsModel($db);
                                                
                /// получаем список всех пользователей 
                $usersList = $certsModel->getAll();
               
                /// подключаем представление
                $certs->displayView();
                
            break;
            ///Добавление нового сертификата
            case 'addCert':
                
                /// создаем новый экземпляр контроллера 
                $certs = new certsController('certsView.php');
                
                $certs->getInput();
                
                /// создаем экземпляр модели
                $certsModel = new certsModel($db);
                
                ///Добавления нового сертификата
                $certsModel->addNew($certs->certName, $certs->userName, $certs->fileName, $certs->imageName, $certs->activeFrom, $certs->activeTo);
                                
                /// получаем список всех пользователей 
                $usersList = $certsModel->getAll();
               
                /// подключаем представление
                $certs->displayView();
                
                
            break;
            ///Форма добавления пользователя/системы к сертификату
            case 'certsLink':
                
                /// создаем новый экземпляр контроллера 
                $certsLink = new certsLinkController('certsLinkView.php');
                
                /// создаем экземпляр модели
                $certsLinkModel = new certsLinkModel($db);
                 
                /// получаем сертификат
                $mainList = $certsLinkModel->getAll();
                
                /// получаем список всех пользователей 
                $usersList = $certsLinkModel->getAllUsers();
                
                /// получаем список всех систем 
                $systemsList = $certsLinkModel->getAllSystems();
              
                /// подключаем представление
                $certsLink->displayView();
            break;
            /// Удаление сертификата
            case 'deleteCerts':
                
                /// создаем новый экземпляр контроллера 
                $main = new mainController('mainView.php');
                
                /// создаем экземпляр модели
                $mainModel = new mainModel($db);
                
                /// Удаление сертификата 
                $mainModel->delOne();
                             
                /// получаем список всех сертификатов
                $mainList = $mainModel->getAll();
                               
                /// подключаем представление
                $main->displayView();
                
            break;
            /// Список всех просроченных сертификатов
            case 'oldCerts':
                
                switch ($delete){
                /// Удаление просроченного сертификата
                case 'y':
                    /// создаем новый экземпляр контроллера 
                    $main = new mainController('mainView.php');

                    /// создаем экземпляр модели
                    $mainModel = new mainModel($db);

                    /// Удаление сертификата 
                    $mainModel->delOne();

                    /// получаем список всех сертификатов
                    $mainList = $mainModel->getAllOld();

                    /// подключаем представление
                    $main->displayView();
                break;
                /// Список всех просроченных сертификатов
                default:
                    /// создаем новый экземпляр контроллера 
                    $main = new mainController('mainView.php');

                    /// создаем экземпляр модели
                    $mainModel = new mainModel($db);

                    /// получаем список всех сертификатов
                    $mainList = $mainModel->getAllOld();

                    /// подключаем представление
                    $main->displayView();
                    }
            break;
            ///Добавление пользователя к сертификату
            case 'addCertsLinkUsers':
                
                /// создаем новый экземпляр контроллера 
                $certsLink = new certsLinkController('certsLinkView.php');
                
                $certsLink->getInput();
                
                /// создаем экземпляр модели
                $certsLinkModel = new certsLinkModel($db);
                
                ///Добавление пользователя к сертификату
                $certsLinkModel->addNewUsers($certsLink->userName);
 
                /// получаем текущий сертификат
                $mainList = $certsLinkModel->getAll();
                
                /// получаем список всех пользователей 
                $usersList = $certsLinkModel->getAllUsers();
                
                /// получаем список всех систем 
                $systemsList = $certsLinkModel->getAllSystems();
              
                /// подключаем представление
                $certsLink->displayView();
                
                
                                
            break;
            ///Добавление системы к сертификату
            case 'addCertsLinkSystems':
                
                /// создаем новый экземпляр контроллера 
                $certsLink = new certsLinkController('certsLinkView.php');
                
                $certsLink->getInput();
                
                /// создаем экземпляр модели
                $certsLinkModel = new certsLinkModel($db);
                 
                ///Добавление пользователя к сертификату
                $certsLinkModel->addNewSystems($certsLink->systemName);
 
                /// получаем текущий сертификат
                $mainList = $certsLinkModel->getAll();
                
                 /// получаем список всех пользователей 
                $usersList = $certsLinkModel->getAllUsers();
                
                /// получаем список всех систем 
                $systemsList = $certsLinkModel->getAllSystems();
              
                /// подключаем представление
                $certsLink->displayView();
                
                
                                
                break;
        }
    
    
    } else {
        
            /// Список всех сертификатов
                /// создаем новый экземпляр контроллера 
                $main = new mainController('mainView.php');
                
                /// создаем экземпляр модели
                $mainModel = new mainModel($db);
                             
                /// получаем список всех сертификатов
                $mainList = $mainModel->getAll();
                               
                /// подключаем представление
                $main->displayView();
    }

    



?>
    </div>
                        <div class=" row footer">
                            <div class="col-md-12">
								<center><div class="ftext">Управление финансов <?= date("Y")?></div></center>
							</div>
						</div>
    </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
            
	</body>
	</html>
<? else: ?>
<? header('location: login.php');?>
<?endif;?>