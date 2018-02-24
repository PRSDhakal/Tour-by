<?php
//start session
session_start();
//load and initialize user class
include 'user.php';
$erv;
$user = new User();
if (isset($_POST['signupSubmit'])) {
    //check whether user details are empty
    if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['description'])) {
        //password and confirm password comparison
        if ($_POST['password'] !== $_POST['confirm_password']) {
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Passwords do no match!';
        } else {
            //check whether user exists in the database
            $prevCon['where'] = array('email' => $_POST['email']);
            $prevCon['return_type'] = 'count';
            $prevUser = $user->getRows($prevCon);
            if ($prevUser > 0) {
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'Email already exists!';
            } else {
                //insert user data in the database
                $dest_folder = "img/";
                $dest_file = $dest_folder . basename($_FILES["photo"]["name"]);
                $uploadOk = 1;
                $img_type = pathinfo($dest_file, PATHINFO_EXTENSION);
                $erv = $_POST['sp'];
                $served;

                $check = getimagesize($_FILES["photo"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
                // Check if file already exists
                if (file_exists($dest_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["photo"]["size"] > 5000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if ($img_type != "jpg" && $img_type != "png" && $img_type != "jpeg"
                ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $dest_file)) {
                        echo "The file " . basename($_FILES["photo"]["name"]) . " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
                if (count($erv) > 1) {
                    $served = implode(',', $_POST['sp']);
                } else {
                    $served = $erv[0];
                }
                $userData = array(
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'email' => $_POST['email'],
                    'password' => md5($_POST['password']),
                    'rate' => $_POST['rate'],
                    'owns_car' => $_POST['car'],
                    'description' => $_POST['description'],
                    'languages' => $_POST['languages'],
                    'picURL' => ($_FILES['photo']['name']),
                    'served_places' => $served,
                    'type' => "guide"
                );
                $insert = $user->insert($userData);



                //set status based on data insert
                if ($insert) {
                    echo $insert;
                    include 'config.php';
                    if (is_array($erv) || is_object($erv)) {
                        foreach ($erv as $value) {

                            echo 'here';
                            $qu = "insert into servedplaces(id, place) values(" . $insert . ",'" . $value . "')";
                            if ($db->query($qu) == FALSE) {
                                die($db->error);
                            };
                        }
                    }

                    $sessData['status']['type'] = 'success';
                    $sessData['status']['msg'] = 'You have registered successfully!';
                } else {
                    $sessData['status']['type'] = 'error';
                    $sessData['status']['msg'] = 'Some problem occurred, please try again.';
                }
            }
        }
    } else {
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Please fill all the fields.';
    }
    //store signup status into the session
    $_SESSION['sessData'] = $sessData;
    $redirectURL = ($sessData['status']['type'] == 'success') ? 'index.php' : 'signUpGuide.php';
    //redirect to the home/registration page
    header("Location:".$redirectURL);
} elseif (isset($_POST['loginSubmit'])) {
    //check whether login details are empty
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        //get user data from user class
        $conditions['where'] = array(
            'email' => $_POST['email'],
            'password' => md5($_POST['password']),
            'status' => '1'
        );
        $conditions['return_type'] = 'single';
        $userData = $user->getRows($conditions);
        //set user data and status based on login credentials
        if ($userData) {
            $sessData['userLoggedIn'] = TRUE;
            $sessData['userID'] = $userData['id'];
            $sessData['status']['type'] = 'success';
            $sessData['status']['msg'] = 'Welcome ' . $userData['first_name'] . '!';
        } else {
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Wrong email or password, please try again.';
        }
    } else {
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'Enter email and password.';
    }
    //store login status into the session
    $_SESSION['sessData'] = $sessData;
    //redirect to the home page
    header("Location:index.php");
} elseif (!empty($_REQUEST['logoutSubmit'])) {
    //remove session data
    unset($_SESSION['sessData']);
    session_destroy();
    //store logout status into the ession
    $sessData['status']['type'] = 'success';
    $sessData['status']['msg'] = 'You have logout successfully from your account.';
    $_SESSION['sessData'] = $sessData;
    //redirect to the home page
    header("Location:index.php");
} else {
    //redirect to the home page
    header("Location:index.php");
}
