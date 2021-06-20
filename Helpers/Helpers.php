<?php 

	//Returns the url of the project.
	function base_url(){
        return BASE_URL;
	}

    function media(){
        return BASE_URL."/Assets/";
    }

    function headerAdmin($data=""){
        $view_header = "Views/Template/header_admin.php";
        require_once ($view_header);
    }

    function footerAdmin($data=""){
        $view_footer = "Views/Template/footer_admin.php";
        require_once ($view_footer);
    }

	//Shows formatted information.
	function show($data){
        $format  = print_r('<pre>');
        $format .= print_r($data);
        $format .= print_r('</pre>');
        return $format;
    }

    function getModal(string $nameModal, $data){
        $view_modal = "Views/Template/Modals/{$nameModal}.php";
        require_once $view_modal;
    }

    //Remove excess spaces between words.
    function strClean($string){
        $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $string);
        $string = trim($string); //Remove whitespace at the beginning and end.
        $string = stripslashes($string); //Remove backslash.
        $string = str_ireplace("<script>","",$string);
        $string = str_ireplace("</script>","",$string);
        $string = str_ireplace("<script src>","",$string);
        $string = str_ireplace("<script type=>","",$string);
        $string = str_ireplace("SELECT * FROM","",$string);
        $string = str_ireplace("DELETE FROM","",$string);
        $string = str_ireplace("INSERT INTO","",$string);
        $string = str_ireplace("SELECT COUNT(*) FROM","",$string);
        $string = str_ireplace("DROP TABLE","",$string);
        $string = str_ireplace("OR '1'='1","",$string);
        $string = str_ireplace('OR "1"="1"',"",$string);
        $string = str_ireplace('OR ´1´=´1´',"",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("LIKE '","",$string);
        $string = str_ireplace('LIKE "',"",$string);
        $string = str_ireplace("LIKE ´","",$string);
        $string = str_ireplace("OR 'a'='a","",$string);
        $string = str_ireplace('OR "a"="a',"",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("--","",$string);
        $string = str_ireplace("^","",$string);
        $string = str_ireplace("[","",$string);
        $string = str_ireplace("]","",$string);
        $string = str_ireplace("==","",$string);
        return $string;
    }

    // Validate title.
    function validateTitle($title){
        if(strlen($title) < 1 || strlen($title) > 100){
            return false;
        }
        return true;
    }

    // Validate category description.
    function validateText($text){
        if(strlen($text) < 1 || strlen($text) > 2000){
            return false;
        }
        return true;
    }
?>