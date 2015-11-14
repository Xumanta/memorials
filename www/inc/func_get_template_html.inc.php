<?php
/**
 * Created by PhpStorm.
 * User: Jlndbe
 * Date: 11.11.2015
 * Time: 19:05
 */
// require_once da die Config im Index geladen wird.
require_once 'config.php';
require_once 'func_db_get_var.inc.php';

/**
 * @param $tpl_name
 * @param $vars
 * @return string $tpl
 *  Läd html templates aus dem tpl/ Verzeichnis und ersetzt Variablen nach dem Schema:
 *  {{TPL:TEMPLATE_NAME}} oder {{VAR:VAR_NAME}}
 */

function get_template_html($tpl_name, $vars = 0){
    try{
        if(preg_match('/^[0-9A-Z_]+$/', $tpl_name) != 1) throw new Exception('Invalid template name passed:' . $tpl_name);
        $tpl = file_get_contents('tpl/' . strtolower($tpl_name) . '.tpl.html');
        if($tpl == '') throw new Exception('Empty template loaded.');

        $pattern = '/(?:{{(?:TPL|VAR):[0-9A-Z_]+}})/';
        if(preg_match_all($pattern, $tpl, $matches)) {
            $matches = array_unique($matches[0]);

            foreach ($matches as $val) {
                $key_val = explode(':', str_replace(array('{', '}'), '', $val));

                switch ($key_val[0]) {
                    case 'TPL':
                        if($key_val[1] == $tpl_name) throw new Exception('Do you want to see the world burn?');
                        $tpl = str_replace($val, get_template_html($key_val[1], $vars), $tpl);
                        break;

                    case 'VAR':
                        $var = 'VAR_NOT_DEFINED';

                        if($vars != 0 && isset($vars[strtolower($key_val[1])])){
                            $var = $vars[strtolower($key_val[1])];
                        }

                        $tpl = str_replace($val, $var, $tpl);
                        break;
                }
            }
        }

        return $tpl;

    } catch (Exception $e){
        if(Config::DEBUG_ENABLED){
            die('Could not load template: ' . $e->getMessage());
        }

        return('ERROR_COULD_NOT_LOAD_TEMPLATE');
    }
}