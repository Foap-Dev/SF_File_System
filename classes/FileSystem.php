<?php
class FileSystem{

	//For getting user files and displaying them
	public static function GetUserFiles($dir, $user_id){

		chdir("users/user".$user_id);

		$i = 0;

		if ($handle = opendir($dir)) {

    		while (false !== ($entry = readdir($handle))) {
       			if ($entry != "." && $entry != "..") {

       				$i++;

            		if(is_file($entry)){
            			echo "file [id: ".$i."]: ".$entry." - ".date ("F d Y H:i.", filemtime($entry))."<br>";
            		}else if(is_dir($entry)){
            			echo "dir [id: ".$i."]: ".$entry." - ".date ("F d Y H:i.", filemtime($entry))."<br>";
            		}
        		}
    		}

    		closedir($handle);
		}
	}

	//For getting total disk space
	public static function GetTotalSpace($disk){
		$bytes = disk_total_space($disk);
    	$si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
    	$base = 1024;
    	$class = min((int)log($bytes , $base) , count($si_prefix) - 1);
    	$total = sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class] . '<br />';
    	return $total;
	}

	//For getting availible disk space
	public static function GetFreeSpace($disk){
		$bytes = disk_free_space($disk);
    	$si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
    	$base = 1024;
    	$class = min((int)log($bytes , $base) , count($si_prefix) - 1);
    	$total = sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class] . '<br />';
    	return $total;
	}

	//For getting a comparison between availible disk space and total disk space
	//This will be printed out as freespace/totalspace
	public static function GetSpaceCompare($disk){
		$freebytes = disk_free_space($disk);
		$totalbytes = disk_total_space($disk);

    	$si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
    	$base = 1024;
    	$class = min((int)log($freebytes , $base) , count($si_prefix) - 1);
    	$total = sprintf('%1.2f' , $freebytes / pow($base,$class)) . ' ' . $si_prefix[$class] . ' / ' . sprintf('%1.2f' , $totalbytes / pow($base,$class)) . ' ' . $si_prefix[$class] . '<br>';
    	return $total;
	}


	//For adding a direcory
	public static function AddDir($dirname){
		if(file_exists($dirname)){
			echo 'Directory cannot be made. Reason: Directory already exists!';
		}else {
			mkdir($dirname);
			echo "Directory has been made!";
		}
	}

	//For removing a directory
	public static function RemoveDir($dirname){
		if(file_exists($dirname)){
			rmdir($dirname);
			echo 'Directory has been deleted.';
		}else{
			echo 'Directory does not exist!';
		}
	}

	//For adding files
	public static function AddFile($filename){
		if(file_exists($filename)){
			echo 'File cannot be made! File already exists!';
		}else{
			fopen($filename, "w+");
		}
	}

	//For removing files
	public static function RemoveFile($filename){
		if(file_exists($filename)){
			unlink($filename);
		}else{
			echo "File does not exist";
		}
	}

	//For reading files
	public static function ReadFile($filename){
		if(file_exists($filename)){
			ReadFile($filename);
		}else{
			echo "File does not exist!";
		}
	}

	public static function MoveFile($filename, $newpath){
		if(file_exists($filename)){
			if(file_exists($newpath)){
				rename($filename, $newpath);
			}else{
				echo 'Directory not found!';
			}
		}else{
			echo "File not found";
		}
	}

	public static function CopyFile($filename){
		if(file_exists($filename)){
			$newpath = "Copy - ".$filename;

			copy($filename, $newpath);
		}else{
			echo "File not found";
		}
	}

	public static function RenameFile($filename, $newname){
		if(file_exists($filename)){
			rename($filename, $newname);
		}else{
			echo "File not found";
		}
	}
}

?>