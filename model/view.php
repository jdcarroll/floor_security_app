<?php  
class Views{
    // Create a public method called "getViews"
    // Function/Method Parameters:  Pass the file name and data received from Controller
    public function getView($filename="", $results=array()){
        // include the filename being requested by Controller
        include $filename;
    }
}
?>