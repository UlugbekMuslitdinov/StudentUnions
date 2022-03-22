<?php
if(!isset($_FILES)) {
    returnError('Please upload a file.');
} else {
    // upload each picture
    $target_dir = "/timeclocknews/slides";

    $flag = 0;

    foreach ($_FILES as $picture) {
        $upload_name = explode('.', $picture['name']);

        if(count($upload_name) < 2) {
            returnError('Invalid File Extension');
        }

        $extension = $upload_name[1];
        $target_file = random_filename(45, '../slides', $extension);
        $path = '../slides/' . $target_file;

        $order_path = "../slides/order.json";

        // check if both file exists

        if (move_uploaded_file($picture["tmp_name"], $path)) {
            // Get the contents of the JSON file 
            $strJsonFileContents = file_get_contents($order_path);
            // Convert to array 
            $order = json_decode($strJsonFileContents, true);
            $order[] = Array(
                "path" => '/timeclocknews/slides/' . $target_file,
                "insertion_date" => date("Y/m/d"),
                "name" => $target_file,
                "id" => count($order)
            );

            $myfile = fopen($order_path, "w");
            fwrite($myfile, json_encode($order));
            fclose($myfile);

        } else {
            $flag = 1;
            returnError("Sorry, there was an error uploading your file: " . $picture['name']);
        }
    }

    if(!$flag) {
        $res = array(
            'success' => true
        );

        echo json_encode($res);
    }
}

function returnError($msg) {
    $res = array(
        'success' => false,
        'err' => $msg
    );

    echo json_encode($res);
}


// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//     if($check !== false) {
//         echo "File is an image - " . $check["mime"] . ".";
//         $uploadOk = 1;
//     } else {
//         echo "File is not an image.";
//         $uploadOk = 0;
//     }
// }




function random_filename($length, $directory = '', $extension = '')
{
    // default to this files directory if empty...
    $dir = !empty($directory) && is_dir($directory) ? $directory : dirname(__FILE__);

    do {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
    } while (file_exists($dir . '/' . $key . (!empty($extension) ? '.' . $extension : '')));

    return $key . (!empty($extension) ? '.' . $extension : '');
}

?>