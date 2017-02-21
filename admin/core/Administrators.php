<?php

/*
	Connected Admin
*/
function connected_admin() {
	return !empty($_SESSION['sk_admin']);
}

/*
	Access Admin
*/
function access_admin(){
   if (!isset($_SESSION['sk_admin'])){
      echo '<script>location.replace("index.php");</script>';
      exit();
   }
}

/*
	Connection
*/
function valid_connection_admin($email, $password) {

	$db = SokialDB::getInstance();

	$login = $db->prepare("SELECT id_admin
		FROM administrators
		WHERE email = :email
		AND password = :password");

	$login->bindValue(':email', $email);
	$login->bindValue(':password', $password);
	$login->execute();
	
	if($result = $login->fetch(PDO::FETCH_ASSOC)) {
		$login->closeCursor();
		return $result['id'];
	}
	return false;
}

/*
	Session admin
*/
function session_admin($email) {

	$db = SokialDB::getInstance();

	$admin = $db->prepare("SELECT id_admin
		FROM administrators
		WHERE email = ? ");

	$admin->execute(array($email));
	
	if ($result = $admin->fetch(PDO::FETCH_OBJ)) {
		$admin->closeCursor();
		return $result;
	}
	return false;
}

/*
	Update last login
*/
function up_last_login($id_admin) {

	$db = SokialDB::getInstance();

	$update = $db->prepare("UPDATE administrators SET
		last_login = '".strtotime(date("Y-m-d H:i:s"))."'
		WHERE
		id_admin = :id_admin");

	$update->bindValue(':id_admin', $id_admin);

	return $update->execute();
}

/*
	Admin infos
*/
function admin_info($id_admin) {

	$db = SokialDB::getInstance();

	$admin = $db->prepare("SELECT id_admin,firstname,lastname,email,super_admin,ip_add,date_add,last_login
		FROM administrators
		WHERE id_admin = ? ");

	$admin->execute(array($id_admin));
	
	if ($result = $admin->fetch(PDO::FETCH_OBJ)) {
		$admin->closeCursor();
		return $result;
	}
	return false;
}

/*
	Logout
*/
class logout_admin{
    public function logout_admin(){
        $_SESSION = array();
        session_start();
        if(ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params["httponly"]);
        }
        session_unset('sk_admin');
    	session_destroy();
    }   
}

/*
    Number administrators
*/
function admin_number() {

    $db = SokialDB::getInstance();

    $number = $db->query("SELECT id_admin FROM administrators");
    $number->execute();
    $total_admin = $number->rowCount();

    return $total_admin;
}

/*
    Administrators more
*/
function list_admin_more($position,$item_per_page) {

    $db = SokialDB::getInstance();

    $member = $db->query("SELECT id_admin,firstname,lastname,email,super_admin,DATE_FORMAT(date_add,'%d/%m') AS date_day,DATE_FORMAT(date_add,'%H:%i') AS date_hour
        FROM administrators
        ORDER BY id_admin DESC
        LIMIT $position, $item_per_page");
    
    $member->setFetchMode(PDO::FETCH_OBJ);

    while($x = $member->fetch()){

        switch($x->super_admin) {
            case '1':
                $superadmin = '<span style="background:#F9BF3B;color:#fff;padding:5px 10px;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px">Superadmin</span>';
                $catadmin = 'category-superadmin';
                break;
            default:
                $superadmin = '';
                $catadmin = '';
                break;
        }

        $users .= '
        <li class="mix '.$catadmin.'" data-myorder="'.$x->id_admin.'" style="display:inline-block">
            <a href="administrators_view.php?id='.$x->id_admin.'" title="">
                <div class="date_hour">'.$x->date_hour.'<span>'.$x->date_day.'</span></div>
                <div class="infos_user">
                    <div class="left">
                        <p>'.$x->firstname.' '.$x->lastname.'</p>
                        <span>'.$x->email.'</span>
                    </div>
                </div>
                <div class="os_infos">
                    '.$superadmin.'
                </div>
            </a>
        </li>
        ';
    }

    $member->closeCursor();
    return $users;
    
}

/*
    Administrators search
*/
function list_admin_search($search) {

    $db = SokialDB::getInstance();

    $member = $db->query("SELECT id_admin,firstname,lastname,email,super_admin,DATE_FORMAT(date_add,'%d/%m') AS date_day,DATE_FORMAT(date_add,'%H:%i') AS date_hour
        FROM administrators
        WHERE id_admin LIKE '%$search%'
        OR firstname LIKE '%$search%'
        OR lastname LIKE '%$search%'
        OR email LIKE '%$search%'
        ORDER BY id_admin DESC");
    
    $member->setFetchMode(PDO::FETCH_OBJ);

    while($x = $member->fetch()){

        switch($x->super_admin) {
            case '1':
                $superadmin = '<span style="background:#F9BF3B;color:#fff;padding:5px 10px;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px">Superadmin</span>';
                $catadmin = 'category-superadmin';
                break;
            default:
                $superadmin = '';
                $catadmin = '';
                break;
        }

        $users .= '
        <li class="mix '.$catadmin.'" data-myorder="'.$x->id_admin.'" style="display:inline-block">
            <a href="administrators_view.php?id='.$x->id_admin.'" title="">
                <div class="date_hour">'.$x->date_hour.'<span>'.$x->date_day.'</span></div>
                <div class="infos_user">
                    <div class="left">
                        <p>'.$x->firstname.' '.$x->lastname.'</p>
                        <span>'.$x->email.'</span>
                    </div>
                </div>
                <div class="os_infos">
                    '.$superadmin.'
                </div>
            </a>
        </li>
        ';
    }

    $member->closeCursor();
    return $users;
    
}

?>
