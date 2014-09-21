<?php
//Maximize script execution time
ini_set('max_execution_time', 0);

//Initial settings, Just specify Source and Destination Image folder.
$ImagesDirectory    = 'Picture/'; //Source Image Directory End with Slash
$DestImagesDirectory    = 'Picture/new/'; //Destination Image Directory End with Slash
$NewImageWidth      = 700; //New Width of Image
$NewImageHeight     = 0; // New Height of Image
$Quality        = 100; //Image Quality

//Open Source Image directory, loop through each Image and resize it.
if($dir = opendir($ImagesDirectory)){
    while(($file = readdir($dir))!== false){

        $imagePath = $ImagesDirectory.$file;
        $destPath = $DestImagesDirectory.$file;
        $checkValidImage = @getimagesize($imagePath);

        if(file_exists($imagePath) && $checkValidImage) //Continue only if 2 given parameters are true
        {
            //Image looks valid, resize.
            if(resizeImage($imagePath,$destPath,$NewImageWidth,$Quality))
            {
                echo $file.' resize Success!<br />';
                /*
                Now Image is resized, may be save information in database?
                */

            }else{
                echo $file.' resize Failed!<br />';
            }
        }
    }
    closedir($dir);
}

//Function that resizes image.
function resizeImage($SrcImage,$DestImage,$MaxWidth,$Quality)
{
    list($iWidth,$iHeight,$type)    = getimagesize($SrcImage);

    $ratio = $MaxWidth / $iWidth;
    $height = $iHeight * $ratio;

    $NewWidth               = ceil($MaxWidth);
    $NewHeight              = ceil($height);
    $NewCanves              = imagecreatetruecolor($NewWidth, $NewHeight);

    switch(strtolower(image_type_to_mime_type($type)))
    {
        case 'image/jpeg':
        case 'image/png':
        case 'image/gif':
            $NewImage = imagecreatefromjpeg($SrcImage);
            break;
        default:
            return false;
    }

    // Resize Image
    if(imagecopyresampled($NewCanves, $NewImage,0, 0, 0, 0, $NewWidth, $NewHeight, $iWidth, $iHeight))
    {
        // copy file
        if(imagejpeg($NewCanves,$DestImage,$Quality))
        {
            imagedestroy($NewCanves);
            return true;
        }
    }
}

?>