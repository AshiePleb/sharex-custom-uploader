<?php
// Load Composer autoloader for dependencies
require 'vendor/autoload.php';

// Load environment variables from the .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Retrieve environment variables
$authenticationKey = $_ENV['AUTHENTICATION_KEY']; // Replace with the authentication key in the .env file
$uploadDirectory = rtrim($_ENV['UPLOAD_DIRECTORY'], '/') . '/'; // Replace with the directory where files will be uploaded in the .env file
$domainUrl = rtrim($_ENV['DOMAIN_URL'], '/') . '/'; // Replace with the domain URL where files will be uploaded in the .env file
$stringLength = $_ENV['STRING_LENGTH']; // Replace with the length of the random string to generate in the .env file

/**
 * Generates a random string of the specified length.
 *
 * @param int $length The length of the random string to generate.
 * @return string The generated random string.
 */
function generateRandomString($length) {
    $characters = array_merge(range(0, 9), range('a', 'z'));
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[mt_rand(0, count($characters) - 1)];
    }

    return $randomString;
}

// Check if the 'authenticationKey' POST parameter is set
if (isset($_POST['authenticationKey'])) {
    // Check if the provided authentication key matches the configured key
    if ($_POST['authenticationKey'] === $authenticationKey) {
        // Generate a random filename based on the configured string length
        $filename = generateRandomString($stringLength);

        // Get the original filename from the uploaded file
        $originalFilename = $_FILES['sharex']['name'];

        // Get the file extension from the original filename
        $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION);

        // Define the file destination with the generated filename and extension
        $fileDestination = $uploadDirectory . $filename . '.' . $fileExtension;

        // Move the uploaded file to the specified destination
        if (move_uploaded_file($_FILES['sharex']['tmp_name'], $fileDestination)) {
            // Generate the URL of the uploaded file
            $fileUrl = $domainUrl . $uploadDirectory . $filename;

            // Output the URL of the uploaded file
            echo $fileUrl;
        } else {
            // Output an error message if file upload fails
            echo 'File upload failed. Please check the permissions or directory existence.';
        }
    } else {
        // Output an error message for an invalid authentication key
        echo 'Invalid Authentication Key. Access denied.';
    }
} else {
    // Output an error message if no authentication key is provided
    echo 'No authentication key provided. Access denied.';
}
