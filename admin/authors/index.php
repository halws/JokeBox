<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . '/php/chapter7/includes/helpers.inc.php';
include $_SERVER['DOCUMENT_ROOT'] . '/php/chapter7/includes/ChromePhp.php';
// if (isset($_GET['addjoke'])) {
  
// }
if (isset($_GET['add'])) {
    $pageTitle = 'New Author';
    $action = 'addform';
    $name = '';
    $email = '';
    $id='';
    $button = 'Add author';
    include 'form.html.php';
    exit();
}

if (isset($_GET['addform'])) {
try {
	include $_SERVER['DOCUMENT_ROOT'] . '/php/chapter7/includes/db.inc.php';
  
  $sql = 'INSERT INTO author SET
     name =:name,
     email=:email';
     $s = $pdo -> prepare($sql);
     $s->bindValue(':name', $_POST['name']);
     $s->bindValue(':email', $_POST['email']);
     $s->execute(); 
} catch (PDOException $e) {
  errorMsg("Error while inserting author");
}
  header('Location: .');
  exit();
     
}

if (isset($_POST['action']) and $_POST['action']=='Edit'  ) {
  include $_SERVER['DOCUMENT_ROOT'] . '/php/chapter7/includes/db.inc.php';
  try {
        $sql = 'SELECT id,name, email FROM author WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id',$_POST['id']);
        $s->execute();
      } catch (PDOException $e) {
        errorMsg("Errror while editing infromation");
      }
      $row = $s->fetch();
      $pageTitle = 'Edit author';
      $action='editform';
      $name=$row['name'];
      $email=$row['email'];
      $id=$row['id'];
      $button='Update information about author';
      include 'form.html.php';    
      exit();
}
if (isset($_GET['editform'])) {
  include $_SERVER['DOCUMENT_ROOT'] . '/php/chapter7/includes/db.inc.php';
  try {
   
     $sql = 'UPDATE author SET
     name = :name,
     email = :email
     WHERE id = :id';
     $s = $pdo->prepare($sql);
     $s->bindValue(':id', $_POST['id']);
     $s->bindValue(':name', $_POST['name']);
     $s->bindValue(':email', $_POST['email']);
     $s->execute();
  } catch (PDOException $e) {
    errorMsg("Error while updating data about authors");
  }
  header('Location: .');
  exit();
}
if (isset($_POST['action']) and $_POST['action']=='Delete'  ) {
    // ChromePhp::Log("Hello");
  include $_SERVER['DOCUMENT_ROOT'] . '/php/chapter7/includes/db.inc.php';
	try
  {
    $sql = 'SELECT id FROM joke WHERE authorid = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  } catch (PDOException $e) {
	errorMsg("Error while getting id from what jokes should be deleted");
	}
	$result = $s->fetchAll();
	// ChromePhp::log($result);
try
  {
    $sql = 'DELETE FROM jokecategory WHERE jokeid = :id';
    $s = $pdo->prepare($sql);

    // For each joke
    foreach ($result as $row)
    {
      $jokeId = $row['id'];
      $s->bindValue(':id', $jokeId);
      $s->execute();
    }
  } catch (PDOException $e) {
		errorMsg("Error while deleting from jokecategory");
	}
	// delete jokes, which belong to author
	 try
  {
    $sql = 'DELETE FROM joke WHERE authorid = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  } catch (PDOException $e) {
		errorMsg("Error while deleting jokes from joke");
	}
	 try
  {
    $sql = 'DELETE FROM author WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
  }
  catch (PDOException $e)
  {
   errorMsg("Error while deleting jokes from joke");
  }
	header('Location: .');
	exit();
}
try {
	include $_SERVER['DOCUMENT_ROOT'] . '/php/chapter7/includes/db.inc.php';
	$result = $pdo -> query('SELECT id,name FROM author');
} catch (PDOException $e) {
	errorMsg("0");
}
foreach ($result as $row) {
	$authors[]  = array('id' => $row['id'],'name'=>$row['name'] );
}
include 'authors.html.php';

 ?>