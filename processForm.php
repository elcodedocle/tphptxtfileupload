<?php
  /**
   * Performs checks on user name
   *
   * Returns false on invalid/existing user name
   * or valid user name
   *
   * @param string $input The user name to be checked
   * @return string The checked username, false on error
   */
  function validateUserName($input){
    // server side user name input validation here
    return filter_var(
      $input,
      FILTER_VALIDATE_REGEXP,
      array(
        'options'=>array(
          'default'=>false,
          // Only alphanumeric, underscores and dots allowed
          // min length: 4
          // max length: 31 
          'regexp'=>'/^[a-zA-Z0-9_\\.]{4,31}$/',
        )
      )
    );
  }

  if (
    $fileName = filter_var(
      $_FILES['theFile']['name'],
      FILTER_VALIDATE_REGEXP,
      array(
        'options' => array(
          'default' => false,
          // Only alphanumeric, underscores, and non starting hyphens. 
          // Must end in .txt
          // min length: 4
          // max length: 127
          'regexp' => '/^([a-zA-Z0-9_]+|(-)*){1,123}\\.txt$/',
        ),
      )
    ) === false
  ){

    $error = "Invalid file: {$_FILES['theFile']['name']}";
    echo json_encode(
      array(
        'result' => array(
          'code' => 'KO',
          'title' => 'ERROR',
          'message' => $error,
        ),
      )
    );
    trigger_error($error,E_USER_ERROR);

  } else if (
    (
      $user = filter_input(
        INPUT_POST, 
        'user', 
        FILTER_CALLBACK, 
        array('options' => 'validateUserName')
      )
    ) !== false
  ){

    //must be a character not allowed in user name/beggining of input file name
    $avoid_duplicates = '-';
    move_uploaded_file (
      $_FILES['theFile']['tmp_name'], 
      "uploads/{$user}{$avoid_duplicates}{$_FILES['theFile']['name']}"
    );
    echo json_encode(
      array(
        'result' => array(
          'code' => 'OK',
          'title' => 'SUCCESS',
          'message' => "File {$fileName} from user {$user} has been successfuly transferred and stored.",
        )
      )
    );

  } else {

    $error = "Invalid user input: {$_REQUEST['user']}";
    echo json_encode(
      array(
        'result' => array(
          'code' =>'KO',
          'title' => 'ERROR',
          'message' => $error,
        )
      )
    );
    trigger_error($error,E_USER_ERROR);

  }
