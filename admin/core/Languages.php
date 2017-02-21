<?php

// Copyright Sokial
// Created by Emmanuel Glajean
// Last Modification => 13.12.14
// Version 3.0.4

class Languages {

	private $_language = '';
	private $_folder = '';
	private $_contentXML = null;

	public function __construct($file) {
		if(is_dir($folder)) {
			$this->_folder = $folder;
		}
		else {
			$this->_folder = CORE.SK_LANGUAGES;
		}

		if(!empty($_GET['lang'])) {
			$_SESSION['language_admin'] = $_GET['lang'];
			$this->_language = $_SESSION['language_admin'];
		}
		else {
    		$this->_language = SK_LANG;
		}

		if (!empty($_SESSION['language_admin'])) {
			$this->_language = $_SESSION['language_admin'];
		}

		if(file_exists($this->_folder.$this->_language.'/'.$file.'.xml')) {
			$this->loadXmlFile($file);
		}
		else {
			die('XML file ('.$this->_folder.$this->_language.'/'.$file.'.xml) don\'t exist!');
		}
	}

	private function loadXmlFile($file) {
		$this->_contentXML = simplexml_load_file($this->_folder.$this->_language.'/'.$file.'.xml');
	}

	public function sokial($text) {
		$result = $this->_contentXML->xpath($text);
		
		foreach($result as $node) {
			return $node;
		}
	}
}

function languages_edit() {

    $db = SokialDB::getInstance();

    $lang = $db->query("SELECT id_lang,name_lang,code_iso
        FROM languages
        ORDER BY id_lang ASC");
    
    $lang->setFetchMode(PDO::FETCH_OBJ);

    while ($x = $lang->fetch()){
        $languages .= '<li><a href="languages_choice.php?l='.$x->code_iso.'" title="">'.$x->id_lang.'. '.$x->name_lang.' ('.$x->code_iso.')</a></li>';
    }

    $lang->closeCursor();
    return $languages;
    
}

function load_language($language,$file,$type) {

    switch($type) {
        case 'area':
            $dest = '../core/languages';
            break;
        default:
            $dest = 'core/languages';
            break;
    }

    $xml=simplexml_load_file("$dest/$language/$file.xml");

    foreach($xml->children() as $child){

        $lang .= '
            <div class="w50"><label>'.$child->getName().'</label>
            <input type="text" value="'.$child.'" style="width:40%"/></div>
        ';
    }

    return $lang;
}

?>