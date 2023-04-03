<?php
// Отправляем браузеру правильную кодировку,
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
  if (!empty($_GET['save'])) {
    // Если есть параметр save, то выводим сообщение пользователю.
    print('Спасибо, результаты сохранены.');
  }
  include('form.php');
  // Завершаем работу скрипта.
  exit();
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.

// Проверяем ошибки.
$errors = FALSE;
if (empty($_POST['name'])) {
  print('Введите имя.<br/>');
  $errors = TRUE;
}

if (empty($_POST['email']) ||  !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
  print('Введите почту.<br/>');
  $errors = TRUE;
}
if (empty($_POST['year'])) {
  print('Выберите год.<br/>');
  $errors = TRUE;
}
if (empty($_POST['pol']) || !($_POST['pol']=='w' || $_POST['pol']=='m')) {
  print('Выберите пол.<br/>');
  $errors = TRUE;
}
if (empty($_POST['kolvo'])) {
  print('Выберите количество конечностей.<br/>');
  $errors = TRUE;
}
if (empty($_POST['sposobn'])) {
  print('Заполните способности.<br/>');
  $errors = TRUE;
}

if (empty($_POST['bio'])) {
    print('Заполните биографию.<br/>');
    $errors = TRUE;
  }
  
  if (empty($_POST['info'])) {
    print('Поставьте галочку "С контрактом ознакомлен(а)".<br/>');
    $errors = TRUE;
  }
  

if ($errors) {
  // При наличии ошибок завершаем работу скрипта.
  exit();
}

// Сохранение в базу данных.

$user = 'u52810'; 
$pass = '1211928';
$db = new PDO('mysql:host=localhost;dbname=u52810', $user, $pass, [PDO::ATTR_PERSISTENT => true]); 

// Подготовленный запрос. Не именованные метки.
try {
    $stmt = $db->prepare("INSERT INTO application (name, email, year, pol, kolvo, bio) VALUES (:name, :email, :year, :pol, :kolvo, :bio);");
    $stmtErr=$stmt -> execute(['name'=>$_POST['name'], 'email' => $_POST['email'], 'year'=>$_POST['year'],'pol'=> $_POST['pol'], 'kolvo'=> $_POST['kolvo'],'bio'=>$_POST['bio'] ]);
    $strId = $db -> lastInsertId();
    if (isset($_POST['sposobn'])) {
        foreach ($_POST['sposobn'] as $ability) {
            switch ($ability) {
                case "immortal":
                    $stmt = $db -> prepare("INSERT INTO connection (id, a_id) VALUES (:id, :a_id);");
                    $stmtErr = $stmt -> execute(['id' => intval($strId), 'a_id' => 1]);
                    break;
                case "throughwalls":
                    $stmt = $db -> prepare("INSERT INTO connection (id, a_id) VALUES (:id, :a_id);");
                    $stmtErr = $stmt -> execute(['id' => intval($strId), 'a_id' => 2]);
                    break;
                case "levitation":
                    $stmt = $db -> prepare("INSERT INTO connection (id, a_id) VALUES (:id, :a_id);");
                    $stmtErr = $stmt -> execute(['id' => intval($strId), 'a_id' => 3]);
                    break;
            }
        }
    }
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}
    

// Делаем перенаправление.
// Если запись не сохраняется, но ошибок не видно, то можно закомментировать эту строку чтобы увидеть ошибку.
// Если ошибок при этом не видно, то необходимо настроить параметр display_errors для PHP.
header('Location: ?save=1');
?>
