<?php
  require_once __DIR__ . '/config.php'; // require the config file we created
  class API {
    function Select(){
      $db = new Connect; // new variable pointing to a Connection object
      $users = array(); // data we get back we are calling users and will be type of array
      $data = $db->prepare('SELECT * FROM users ORDER BY id');
      $data->execute(); // we want to assing all the data from the db to the users var, and then return that var in the json format so we can view it in the browser
      while($OutputData = $data->fetch(PDO::FETCH_ASSOC)){
        $users[$OutputData['id']] = array(
          'id' => $OutputData['id'],
          'name' => $OutputData['name'],
          'age' => $OutputData['age']
        );
      }
      return json_encode($users); // ... then return that var in the json format so we can view it in the browser
    }
  }

  $API = new API; // a new instance of the API object we created above
  header('Content-Type: application/json'); // header tells browser what kind of data it's going to receive, in this case it's json
  echo $API->Select(); // output is the Select function from the API object
?>