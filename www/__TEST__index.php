<?php
/**
 * Created by PhpStorm.
 * User: Jlndbe
 * Date: 11.11.2015
 * Time: 23:56
 */
require_once 'config.php';
require_once 'db_connect.inc.php';
require_once 'func_get_template_html.inc.php';

$index_file = basename(__FILE__);
$document = '';
$document_nav = '';

$pid = 0;

$pages = array(
    array(
        'pid' => 0,
        'title' => 'Starteite',
        'description' => '',
        'nav' => true,
        'nav_active' => '',
        'nav_title' => 'Start',
        'nav_href' => $index_file . '?pid=0'
    ),
    array(
        'pid' => 1,
        'title' => '&Uuml;ber',
        'description' => '',
        'nav' => true,
        'nav_active' => '',
        'nav_title' => '&Uuml;ber',
        'nav_href' => $index_file . '?pid=1'
    ),
    array(
        'pid' => 2,
        'title' => '',
        'description' => '',
        'nav' => true,
        'nav_active' => '',
        'nav_title' => 'Anmelden',
        'nav_href' => $index_file . '?pid=2'
    ),
    array(
        'pid' => 3,
        'title' => 'Suche',
        'description' => '',
        'nav' => false,
        'nav_active' => '',
        'nav_title' => '',
        'nav_href' => ''
    )
);

if(isset($_GET['pid'])) {
    $pid = $_GET['pid'];
}

if(!isset($pages[$pid])){
    header("HTTP/1.0 404 Not Found");
    $pid=404;
}

foreach($pages as $page){
    if($page['nav']){
        if($pid == $page['pid']){
            $page['nav_active'] = 'active';
        }
        $document_nav .= get_template_html('DEFAULT_NAV_ITEM', $page);
    }
}

$pages[$pid]['nav_items'] = $document_nav;
unset($document_nav);

$pages[$pid]['index_file'] = $index_file;

$document .= get_template_html('DEFAULT_BEGIN', $pages[$pid]);

switch($pid){
    case 0:
        $memorials_html = '';
        $overview_data = array();
        $sql_result = mysqli_query($db_connection, "SELECT * FROM `memorials`;");

        $i = 0;
        while($memorial = mysqli_fetch_array($sql_result)){

            //TODO:
            $overview_data[$memorial['id']] = $memorial['name'];
            $vars = array(
                'memorial_id' => $memorial['id'],
                'memorial_title' => $memorial['name'],
                'memorial_description' => $memorial['description'],
                'memorial_street' => $memorial['street'],
                'memorial_zip' => $memorial['zip'],
                'memorial_city' => $memorial['city']
            );
            $memorials_html .= get_template_html('MEMORIAL', $vars);

            $i++;
        }
        unset($vars); unset($memorial);
        mysqli_free_result($sql_result);

        $document .= $memorials_html;
        unset($memorials_html);

        break;
    case 1:
        break;
    case 2:
        $document .= get_template_html('LOGIN_CONTENT',array('INDEX_FILE' => $index_file));
        break;
    case 3:
        break;
    case 404:
        break;

}

$document .= get_template_html('DEFAULT_END');
print($document);