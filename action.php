<?php
/**
 * Composant Action pour SwitchPanel (Toolbar)
 * @author     J. Ferre
 */

if(!defined('DOKU_INC')) die();

if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'action.php');

class action_plugin_switchpanel extends DokuWiki_Action_Plugin {

    function getCodePanel($TypePanel){
        // Size of the panel
        $nb_of_rj = '==line:number=24';
        // Informations for samples
        $code_msg = '# '.$this->getLang('panel_info').'\n';
        $code_txt = 'text="'.$this->getLang('port_title').'"';
        $code_url = $code_txt.',link="'.$this->getLang('port_url').'",target="_blank"';
        // Samples for RJ, OF or Gbic ports
        $rj01to04 = '\n01,01,PC01:color="lime",'.$code_url.'\n02,02,PC02:color="cyan",'.$code_txt.'\n03,03,PC03:color="blue"\n04,04:color="#FF0000"';
        $rj05to10 = '\n05,05\n06,06\n07,07\n08,08\n09,09\n10,10';
        $cl11se12 = '\n11,11:case=close,text="'.$this->getLang('port_close').'"\n12,12:case=serial,text="'.$this->getLang('port_serial').'"';
        $rj13to16 = '\n13,13,PC13:color="teal",'.$code_url.'\n14,14,PC14:color="peru",'.$code_txt.'\n15,15,PC15:color="gold"\n16,16:color="#ABCDEF"';
        $rj17to22 = '\n17,17\n18,18\n19,19\n20,20\n21,21\n22,22';
        $of23gb24 = '\n23,23:case=of,text="'.$this->getLang('port_of').'"\n24,24:case=gbic,text="'.$this->getLang('port_gbic').'"';
        $rj25to28 = '\n01,25,PC25:color="lime",'.$code_url.'\n02,26,PC26:color="cyan",'.$code_txt.'\n03,27,PC27:color="blue"\n04,28:color="#FF0000"';
        $rj29to34 = '\n05,29\n06,30\n07,31\n08,32\n09,33\n10,34';
        $cl35se36 = '\n11,35:case=close,text="'.$this->getLang('port_close').'"\n12,36:case=serial,text="'.$this->getLang('port_serial').'"';
        $rj37to40 = '\n13,37,PC37:color="teal",'.$code_url.'\n14,38,PC38:color="peru",'.$code_txt.'\n15,39,PC39:color="gold"\n16,40:color="#ABCDEF"';
        $rj41to46 = '\n17,41\n18,42\n19,43\n20,44\n21,45\n22,46';
        $of47gb48 = '\n23,47:case=2of,text="'.$this->getLang('port_2of').'"\n24,48:case=gbic,text="'.$this->getLang('port_gbic').'"';
        // Other default port
        $rj11to16 = '\n11,11\n12,12\n13,13\n14,14\n15,15\n16,16';
        $rj35to40 = '\n11,35\n12,36\n13,37\n14,38\n15,39\n16,40';
        // Complete panel for 24 ports / 2x12 ports (1U or 2U)
        $rj01_24a = $nb_of_rj.$rj01to04.$rj05to10.$rj11to16.$rj17to22.$of23gb24;            // 1x24 ports
        $rj01_24b = $nb_of_rj.$rj01to04.$rj05to10.$cl11se12.$rj13to16.$rj17to22.$of23gb24;  // 2x12 ports
        $rj25_48a = $nb_of_rj.$rj25to28.$rj29to34.$rj35to40.$rj41to46.$of47gb48;            // 1x24 ports
        $rj25_48b = $nb_of_rj.$rj25to28.$rj29to34.$cl35se36.$rj37to40.$rj41to46.$of47gb48;  // 2x12 ports
        // Create code for all panels
        switch($TypePanel) {
            case '24rj':
                $code = '\n<switchpanel showEars=false>\n'.$code_msg.$rj01_24a;
                $code.= '\n</switchpanel>\n';
                break;
            case '1x24':
                $code = '\n<switchpanel showEars=false>\n'.$code_msg.'==text\n'.$this->getLang('name_1x24a').'\n'.$rj01_24a;
                $code.= '\n</switchpanel>\n';
                break;
            case '1x48':
                $code = '\n<switchpanel showEars=false>\n'.$code_msg.'==text\n'.$this->getLang('name_1x48a').'\n'.$rj01_24a;
                $code.= '\n'.$rj25_48a.'\n</switchpanel>\n';
                break;
            case '2x24':
                $code = '\n<switchpanel showEars=false>\n'.$code_msg.'==text\n'.$this->getLang('name_2x24a').'\n'.$rj01_24a;
                $code.= '\n==text\n'.$this->getLang('name_2x24b').'\n'.$rj25_48a.'\n</switchpanel>\n';
                break;
            case '2x12':
                $code = '\n<switchpanel showEars=false group=12>\n'.$code_msg.'==text\n'.$this->getLang('name_2x12a').'\n'.$rj01_24b;
                $code.= '\n</switchpanel>\n';
                break;
            case '4x12':
                $code = '\n<switchpanel showEars=false group=12>\n'.$code_msg.'==text\n'.$this->getLang('name_4x12a').'\n'.$rj01_24b;
                $code.= '\n==text\n'.$this->getLang('name_4x12b').'\n'.$rj25_48b.'\n</switchpanel>\n';
                break;
            case 'logo':
                $code = '\n<switchpanel>\n'.$code_msg.'==text\n'.$this->getLang('name_logo').'\n'.$rj01_24a;
                $code.= '\n</switchpanel>\n';
                break;
            case 'ears':
                $code = '\n<switchpanel logo=none>\n'.$code_msg.'==text\n'.$this->getLang('name_ears').'\n'.$rj01_24a;
                $code.= '\n</switchpanel>\n';
                break;
            default :
                $code = '';
                break;
        }
        return $code;
    }

    function register(&$controller){
        $controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'handle_toolbar', array ());
    }

    function handle_toolbar(&$event, $param) {
        $event->data[] = array (
            'type' => 'picker',
            'title' => 'SwitchPanel',
            'icon' => '../../plugins/switchpanel/pics/logo.png',
            'list' => array(
                array(
                    'type'   => 'insert',
                    'title'  => $this->getLang('panel_24rj'),
                    'icon'   => '../../plugins/switchpanel/pics/panel_24rj.png',
                    'insert' => $this->getCodePanel('24rj'),
                    'block'  => true
                ),
                array(
                    'type'   => 'insert',
                    'title'  => $this->getLang('panel_1x24'),
                    'icon'   => '../../plugins/switchpanel/pics/panel_1x24.png',
                    'insert' => $this->getCodePanel('1x24'),
                    'block'  => true
                ),
                array(
                    'type'   => 'insert',
                    'title'  => $this->getLang('panel_1x48'),
                    'icon'   => '../../plugins/switchpanel/pics/panel_1x48.png',
                    'insert' => $this->getCodePanel('1x48'),
                    'block'  => true
                ),
                array(
                    'type'   => 'insert',
                    'title'  => $this->getLang('panel_2x24'),
                    'icon'   => '../../plugins/switchpanel/pics/panel_2x24.png',
                    'insert' => $this->getCodePanel('2x24'),
                    'block'  => true
                ),
                array(
                    'type'   => 'insert',
                    'title'  => $this->getLang('panel_2x12'),
                    'icon'   => '../../plugins/switchpanel/pics/panel_2x12.png',
                    'insert' => $this->getCodePanel('2x12'),
                    'block'  => true
                ),
                array(
                    'type'   => 'insert',
                    'title'  => $this->getLang('panel_4x12'),
                    'icon'   => '../../plugins/switchpanel/pics/panel_4x12.png',
                    'insert' => $this->getCodePanel('4x12'),
                    'block'  => true
                ),
                array(
                    'type'   => 'insert',
                    'title'  => $this->getLang('panel_logo'),
                    'icon'   => '../../plugins/switchpanel/pics/panel_logo.png',
                    'insert' => $this->getCodePanel('logo'),
                    'block'  => true
                ),
                array(
                    'type'   => 'insert',
                    'title'  => $this->getLang('panel_ears'),
                    'icon'   => '../../plugins/switchpanel/pics/panel_24rj.png',
                    'insert' => $this->getCodePanel('ears'),
                    'block'  => true
                ),
                array(
                    'type'   => 'insert',
                    'title'  => $this->getLang('rj'),
                    'icon'   => '../../plugins/switchpanel/pics/rj.png',
                    'insert' => 'XX,rj45:case=rj45\n',
                    'block'  => false
                ),
                array(
                    'type'   => 'insert',
                    'title'  => $this->getLang('of'),
                    'icon'   => '../../plugins/switchpanel/pics/of.png',
                    'insert' => 'XX,of:case=of\n',
                    'block'  => false
                ),
                array(
                    'type'   => 'insert',
                    'title'  => $this->getLang('2of'),
                    'icon'   => '../../plugins/switchpanel/pics/2of.png',
                    'insert' => 'XX,2of:case=2of\n',
                    'block'  => false
                ),
                array(
                    'type'   => 'insert',
                    'title'  => $this->getLang('gbic'),
                    'icon'   => '../../plugins/switchpanel/pics/gbic.png',
                    'insert' => 'XX,gbic:case=gbic\n',
                    'block'  => false
                ),
                array(
                    'type'   => 'insert',
                    'title'  => $this->getLang('serial'),
                    'icon'   => '../../plugins/switchpanel/pics/serial.png',
                    'insert' => 'XX,serial:case=serial\n',
                    'block'  => false
                ),
                array(
                    'type'   => 'insert',
                    'title'  => $this->getLang('close'),
                    'icon'   => '../../plugins/switchpanel/pics/close.png',
                    'insert' => 'XX,close:case=close\n',
                    'bolck'  => false
                ),
                array(
                    'type'   => 'insert',
                    'title'  => $this->getLang('none'),
                    'icon'   => '../../plugins/switchpanel/pics/none.png',
                    'insert' => 'XX:case=none\n',
                    'bolck'  => false
                ),
                array(
                    'type'   => 'insert',
                    'title'  => $this->getLang('syntax'),
                    'icon'   => '../../plugins/switchpanel/pics/syntax.png',
                    'insert' => '<code>\nIndex,Label:color="color|#rgb",case="rj45|of|2of|gbic|none|serial|close",text="Information",link="proto://url",target="page|_new|_blank"\n</code>\n',
                    'bolck'  => false
                )
            )
        );
    }
}

