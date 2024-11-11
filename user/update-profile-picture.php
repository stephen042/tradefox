<?php ini_set("date.timezone", "Africa/Lagos"); ?>
<?php require_once("includes/initialize.php"); ?>
<?php before_every_protected_page(); ?>
<?php $user = $_SESSION['user_id'];
$get_user = $conn->query("SELECT * FROM users WHERE id = '$user' LIMIT 1");
$user_row = $get_user->fetch();

$profile_stmt = $conn->query("SELECT * FROM profile_image WHERE user_id = '$user' LIMIT 1");
$profile_row = $profile_stmt->fetch();
$profile_image_id = $profile_row['id'] ?? null;

if (isset($_POST['upload_profile_image'])) {
    $profile_image = $_FILES['profile_image'];
    $filename = $profile_image['name'];
    $tmp_name = $profile_image['tmp_name'];
    $size = $profile_image['size'];
    $type = $profile_image['type'];
    $error = $profile_image['error'];

    // Check if a file is uploaded
    if (empty($filename) || $error == UPLOAD_ERR_NO_FILE) {
        set_message('<script>
            Swal.fire(
                "Error",
                "Please select an image",
                "error"
            );
        </script>');
        header('Location: profile.php');
        exit;
    }

    $target_folder = "../uploads/profile/";

    if (!is_dir($target_folder)) {
        mkdir($target_folder, 0777, true);
    }

    // Check if a profile picture already exists and delete it
    $stmt = $conn->query("SELECT file_path FROM profile_image WHERE user_id = '$user'");
    $existing_image = $stmt->fetchColumn();

    if ($existing_image) {
        // Delete the existing file from the directory if it exists
        $old_file_path = $existing_image;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }
        // Delete the old record from the database
        $conn->query("DELETE FROM profile_image WHERE user_id = '$user'");
    }

    if ($error == 0) {
        if (($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif') && $size <= 2097152) {
            switch ($type) {
                case 'image/jpeg':
                    $image = imagecreatefromjpeg($tmp_name);
                    break;
                case 'image/png':
                    $image = imagecreatefrompng($tmp_name);
                    break;
                case 'image/gif':
                    $image = imagecreatefromgif($tmp_name);
                    break;
                default:
                    $image = false;
                    break;
            }

            if ($image) {
                $width = imagesx($image);
                $height = imagesy($image);
                $ratio = $width / $height;
                $new_width = 300;
                $new_height = $new_width / $ratio;

                $thumb = imagecreatetruecolor($new_width, $new_height);
                imagecopyresampled($thumb, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagedestroy($image);

                $new_filename = uniqid() . '.jpg';
                $new_file_path = $target_folder . $new_filename;
                imagejpeg($thumb, $new_file_path);
                imagedestroy($thumb);

                $stmt = $conn->prepare("INSERT INTO profile_image (user_id, file_path) VALUES (:user_id, :file_path) ON DUPLICATE KEY UPDATE file_path = :file_path");
                $stmt->bindParam(':user_id', $user);
                $stmt->bindParam(':file_path', $new_filename);
                $stmt->execute();

                set_message('<script>
                    Swal.fire(
                        "Profile Picture Updated",
                        "Profile picture was successfully updated",
                        "success"
                    );
                </script>');
                header('Location: profile.php');
                exit;
            } else {
                set_message('<script>
                    Swal.fire(
                        "Error",
                        "Failed to process the image file",
                        "error"
                    );
                </script>');
                header('Location: profile.php');
                exit;
            }
        } else {
            set_message('<script>
                Swal.fire(
                    "Invalid Image",
                    "Invalid image type or size too large",
                    "error"
                );
            </script>');
            header('Location: profile.php');
            exit;
        }
    } else {
        set_message('<script>
            Swal.fire(
                "Error",
                "An error occurred, try again later",
                "error"
            );
        </script>');
        header('Location: profile.php');
        exit;
    }
} elseif (isset($_POST['delete_profile_image'])) {
    // Check if a profile picture exists
    $stmt = $conn->query("SELECT file_path FROM profile_image WHERE user_id = '$user'");
    $existing_image = $stmt->fetchColumn();

    if ($existing_image) {
        // Delete the existing file from the directory
        $file_path = $target_folder . $existing_image;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        // Delete from the database
        $conn->query("DELETE FROM profile_image WHERE user_id = '$user'");

        set_message('<script>
            Swal.fire(
                "Profile Picture Removed",
                "Profile picture was successfully removed",
                "success"
            );
        </script>');
    } else {
        set_message('<script>
            Swal.fire(
                "No Profile Picture",
                "No profile picture to delete",
                "info"
            );
        </script>');
    }

    header('Location: profile.php');
    exit;
}

?>

