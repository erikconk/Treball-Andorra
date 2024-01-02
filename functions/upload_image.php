
<?php
function upload($post_name, $file_name){
    // Get reference to uploaded image
    $image_file = $_FILES[$post_name];

    // Get extension of image
    $extension = explode('.', $image_file["name"]);
    $extension = end($extension);

    // Image not defined, let's exit
    if (!isset($image_file)) {
        die('No file uploaded.');
    }

    // Set new name and add extension
    $image_file["name"] = $file_name;
    $image_file["name"] .= '.' . $extension;


    // Move the temp image file to the images/ directory
    move_uploaded_file(
        // Temp image location
        $image_file["tmp_name"],

        // New image location, __DIR__ is the location of the current PHP file
        $_SERVER['DOCUMENT_ROOT'] . "/public/app_images/avatars/users/" . $image_file["name"]

    );

    return $image_file["name"];
}

?>
