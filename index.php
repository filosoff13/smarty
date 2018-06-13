<?php
//для записи правил используем БД(где предварительно создаем новую БД и таблицу с колонками ID, поле, оператор, значение)
//соединимся с БД
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'My_base1');
    try {$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch (Exception $e) {
    exit('Ошибка соединения с БД');
    }

    /*$query = "SELECT * FROM `users` WHERE `login`='$login'"; 
    $query = $pdo->prepare($query);
    $query->execute([$login]);
    */
    if (isset($_POST['delete'])||isset($_POST['apply'])) {
        $f = $_POST['field'];
        $o = $_POST['operator'];
        $v = $_POST['value'];
    }
if (isset($_POST['delete'])) 
{
    $query = "DELETE * FROM variants WHERE `field` = '$f' AND `operator` = '$o' AND `value` = '$v')";
    $query = $pdo->prepare($query);
    if ($query->execute([$f, $o, $v])) echo 'Правило успешно удалено';
}
if (isset($_POST['apply'])) 
{
    //отправка на сервер(предварительно нужно выполнить проверку на корректность заполения поля "значение")

    $query = "INSERT INTO variants VALUES ('', '$f', '$o', '$v')";
    $query = $pdo->prepare($query);
    if ($query->execute()) echo 'Успешно добавленно правило';
}
if (isset($_POST['clear'])) 
{
    $query = "DELETE * FROM variants";
    $query = $pdo->prepare($query);
    $query->execute();
    $query = "INSERT INTO variants VALUES ('', '', '', '')";
    $query = $pdo->prepare($query);
    $query->execute();
}
if (isset($_POST['addRule'])) 
{
    $query = "INSERT INTO variants VALUES ('', '', '', '')";
    $query = $pdo->prepare($query);
    $query->execute();
}
?>
<!DOCTYPE html>
<html>
<head> 
    <style type="text/css">
        .b1{
            background: red;
            color: white;
            border-radius: 13px;
        }
        .b2{
            background: blue;
            color: white;
            border-radius: 13px;
        }
        .b3{
            background: orange;
            color: white;
            border-radius: 13px;
        }
        .b4{
            background: green;
            color: white;
            border-radius: 13px;
            margin-left: 15%;
        }
    </style>
	<meta charset="utf-8">
	<title>Example</title>
</head>
<body>
    <form name="myform" action="index.php" method="post">
        <select name="field">
            <option value="size">size</option>
            <option value="forks">forks</option>
            <option value="stars">stars</option>
            <option value="followers">followers</option>
       </select>
        <select name="operator">
            <option value="bigger">></option>
            <option value="smoller"><</option>
            <option value="equal">=</option>
       </select>

        <input type="text" name="value">
        <input type="submit" class="b1" name="delete" value="Delete">

        <hr/>

        <input type="submit" class="b2" name="apply" value="Apply">               
        <input type="submit" class="b3" name="clear" value="Clear">                
        <input type="submit" class="b4" name="addRule" value="Add Rule">
        
    </form>    
</body>
</html>
