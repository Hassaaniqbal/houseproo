<?php
// Assuming you have already started the session and set the provider_id
session_start();

$provider_id = $_SESSION['provider_id'];

// Include your database connection file here
// Example: include_once "db_connect.php";

include_once "database.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['checkbox1'])) {
        // Checkbox is not checked, redirect back to companyverification.php with an error message
        $_SESSION['verification_errors'] = "Please acknowledge the statement.";
        header("Location: companyverification.php");
        exit();
    }



    // Handle file uploads and other form data
    $picture = $_FILES["picture"];
    $nic = $_FILES["nic"];
    $certificate = $_FILES["certificate"];
    $address = $_POST["address"];
    $zipcode = $_POST["zipcode"];
    $companyname = $_POST["companyname"];
    $companyaddress = $_POST["companyaddress"];
    $permissionletter = $_FILES["permissionletter"];

    // Validate form inputs
    $errors = [];
    
    // Validate picture
    if (!file_exists($picture["tmp_name"]) || !is_uploaded_file($picture["tmp_name"])) {
        $errors[] = "Please upload a picture.";
    }
    
    // Validate NIC
    foreach ($nic["name"] as $filename) {
        if ($filename !== "" && $nic["size"] > 0) {
            // Validate size, type, etc. if needed
        }
    }
    
    // Validate Certificate
    foreach ($certificate["name"] as $filename) {
        if ($filename !== "" && $certificate["size"] > 0) {
            // Validate size, type, etc. if needed
        }
    }
    
    // Validate address
    if (empty($address)) {
        $errors[] = "Address is required.";
    }
    
    // Validate zipcode
    if (empty($zipcode)) {
        $errors[] = "Zipcode is required.";
    }
    
    // Validate company name
    if (empty($companyname)) {
        $errors[] = "Company name is required.";
    }
    
    // Validate company address
    if (empty($companyaddress)) {
        $errors[] = "Company address is required.";
    }
    
    // Validate permission letter
    if (!file_exists($permissionletter["tmp_name"]) || !is_uploaded_file($permissionletter["tmp_name"])) {
        $errors[] = "Please upload a permission letter.";
    }

    // If there are no errors, save to database and move files
    if (empty($errors)) {
        // Include your database connection file here
        // Example: include_once "db_connect.php";
        
        include_once "database.php";

        $currentDate = date("Y-m-d");

        // Save to company_sp_documents table


        // Update verification status in another table
       
            include_once "database.php"; // Include connection to the same database

            $verified = 1; // Assuming 1 indicates verification completed

            // Update verification status in the other table
            $query = "UPDATE company_service_provider SET verification_completed = ? WHERE provider_id = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("ii", $verified, $provider_id);
            $stmt->execute();
            $stmt->close();
        
            $mTime = time();
            $picName =  $mTime."_".$picture["name"];
            // Move uploaded files to a specific directory
            move_uploaded_file($picture["tmp_name"], "uploads/pictures/" .  $picName);
            
            // Handle other file uploads (NIC, Certificate, Permission Letter)
            $uploadedFilesNIC = array();
      

            foreach ($nic["name"] as $key => $filename) {
                $nicName = $mTime."_". basename($nic["name"][$key]);
                $nicPath = $nicName;
                if (move_uploaded_file($nic["tmp_name"][$key], "uploads/nics/" .  $nicPath)) {
                       $uploadedFilesNIC[] = $nicPath; // Add the path of the uploaded file to the array
                   }
             }

            $finalNicData = json_encode($uploadedFilesNIC); 
            
            $certificateFilesName = array();


            foreach ($certificate["name"] as $key => $filename) {
                $certName =  $mTime."_". basename($certificate["name"][$key]);
                $certificatePath =  $certName;
                if (move_uploaded_file($certificate["tmp_name"][$key], "uploads/certificates/" . $certificatePath)) {
                    $certificateFilesName[] = $certificatePath;
                }
            }

            $finalCertData = json_encode($certificateFilesName); 


             $permiName =  $mTime."_".basename($permissionletter["name"]);
            $permissionLetterPath = "uploads/permissionletters/" .  $permiName;
            move_uploaded_file($permissionletter["tmp_name"], $permissionLetterPath);
            
         
            $success = saveToDatabase($provider_id, $picName,  $finalNicData, $finalCertData, $address, $zipcode, $companyname, $companyaddress, $permiName, $currentDate);

            if($success){
   // Redirect after successful verification
   header("Location: status.php");
   exit();

        } else {
            $errors[] = "Error saving data to database.";
        }
        
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
        echo "<a href='javascript:history.go(-1)'>Go back</a>"; // Provide a way to go back to the form
    }
}

// Function to save data to database
function saveToDatabase($provider_id, $picture, $nic, $certificate, $address, $zipcode, $companyname, $companyaddress, $permissionletter, $currentDate) {
    global $mysqli; // Assuming $mysqli is your database connection object
    
    $query = "INSERT INTO company_sp_documents (provider_id, picture, NIC, certificate, address, zipcode, companyname, companyaddress, permissionletter, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssssssssss", $provider_id, $picture, $nic, $certificate, $address, $zipcode, $companyname, $companyaddress, $permissionletter, $currentDate);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}
?>
