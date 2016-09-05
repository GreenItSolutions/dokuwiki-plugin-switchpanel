<?php
/**
 * Info Plugin: switchpanel
 *
 * @license	GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author	 Bertrand Fruchet <bertrand@greenitsolutions.fr>
 * @author	 Emmanuel Hidalgo <manu@greenitsolutions.fr>
 * 
 * Based on the dokuwiki-plugin-patchpanel plugin (https://github.com/grantemsley/dokuwiki-plugin-patchpanel) by Grant Emsley <grant@emsley.ca>
 */
// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_switchpanel extends DokuWiki_Syntax_Plugin {
	private $_sName = "switchpanel";
	private $_oTagsContent = array( 'line'=>array( 'number', 'color', 'case', 'labelLeft', 'colorLabelLeft', 'labelRight', 'colorLabelRight' ), 'text'=>array( 'bgColor', 'color', 'size', 'brColor', 'brRadius' ), 'heightBar'=>array( 'height' ) );
	private $_oTagsItemsContent = array( 'line_items'=>array( 'color', 'text', 'link', 'case', 'target' ) );

	function getType(){ return 'substition'; }
	function getSort(){ return 155; }
	function getPType(){ return 'block'; }

	function connectTo($mode){
		$this->Lexer->addSpecialPattern( "<switchpanel[^>]*>.*?(?:<\/switchpanel>)", $mode, 'plugin_switchpanel' );
	}
	
	/**
	 * Handle the match
	 *
	 * @param   string       $match   The text matched by the patterns
	 * @param   int          $state   The lexer state for the match
	 * @param   int          $pos	 The character position of the matched text
	 * @param   Doku_Handler $handler The Doku_Handler object
	 * @return  array Return an array with all data you want to use in render
	 */
	function handle($match, $state, $pos, Doku_Handler $handler){

		// remove "</switchpanel>" from the match
		$match = trim( substr( $match, 0, ( strlen( $this->_sName ) + 3 ) * -1 ) );

		// default options
		$opt = array(
			'logo'=>DOKU_BASE.'lib/plugins/switchpanel/images/greenIt.svg',
			'logoLink'=>'http://www.greenitsolutions.fr/',
			'target'=>'_blank',
			'showEars'=>true,
			'labelLeft'=>'',
			'labelRight'=>'',
			'colorLabelLeft'=>'#fff',
			'colorLabelRight'=>'#fff',
			'case'=>'rj45',
			'group'=>0,
			'groupSeparatorWidth'=>18,
			'color'=>'#ccc',
			'elementWidth'=>36,
			'elementHeight'=>45,
			'elementSeparatorWidth'=>5,
			'elementSeparatorHeight'=>5,
			'textSize'=>20,
			'textColor'=>'#fff',
			'textBgColor'=>'',
			'textBrColor'=>'',
			'textBrRadius'=>'',
			'barHeight'=>5,
			'screwHeightSpace'=>60,
			'screwHeight'=>15,
			'screwWidth'=>20,
			'screwColor'=>'#fff',
			'switchColor'=>'#808080',
			'content'=>array()
		);

		// recovered the first line and content
		$iPosFirstLine = stripos( $match, "\n" );
		$sFirstLines = substr( $match, 0, $iPosFirstLine );
		$sContent = trim( substr( $match, $iPosFirstLine ) );
		unset( $match );

		// treatment of first-line
		$sFirstLines = trim( substr( $sFirstLines, strlen( $this->_sName ) + 1 ) );
		$sFirstLines = trim( rtrim( $sFirstLines, '>' ) );
		$oAttributs = explode( ' ', $sFirstLines );
		foreach($oAttributs as $sKeyVal ){
			if( trim( $sKeyVal ) == '' || stripos( $sKeyVal, '=' ) === false ){
				continue;
			}
			list( $sKey, $sVal ) = explode( '=', $sKeyVal );
			$sVal = trim( $sVal, '"' );
			if( $sKey == 'content' || !array_key_exists( $sKey, $opt ) ){
				continue;
			}

			// change a default value
			if( is_bool( $opt[ $sKey ] ) ){
				$opt[ $sKey ] = ( strtolower( $sVal ) == 'true' );
			}else if( is_int( $opt[ $sKey ] ) ){
				$opt[ $sKey ] = intval( $sVal );
			}else{
				$opt[ $sKey ] = $sVal;
			}
		}

		// anonymous function recovery options
		$fGetOptions = function( $sOptions, $oFilters = NULL ){
			$oOptions = array();
			do{
				$sOptions = trim( $sOptions, ',' );
				if( $sOptions == '' ){
					break;
				}
				$iPosStop = stripos( $sOptions, '=' );
				if( $sOptions === false ){
					break;
				}
				$sKey = trim( substr( $sOptions, 0, $iPosStop ) );
				$sOptions = trim( substr( $sOptions, $iPosStop + 1 ) );

				$iPosStop = stripos( $sOptions, ',' );
				if( $iPosStop === false ){
					$iPosStop = strlen( $sOptions );
				}
				$sValue = trim( substr( $sOptions, 0, $iPosStop ) );

				if( substr( $sOptions, 0, 1 ) == '"' ){
					$iPosStop = stripos( $sOptions, '"', 1 );
					$sValue = trim( substr( $sOptions, 0, $iPosStop ), '"' );
					$iPosStop++;
				}

				// control of coherence options
				if( !is_null( $oFilters ) && !in_array( $sKey, $oFilters ) ){

					// error, the option is not found
					echo 'Syntax error : the option is not found : <pre style="color:red"> key : '.$sKey.', value : '.$sOptions."</pre>\n";
					$sOptions = trim( substr( $sOptions, $iPosStop ) );
					continue;
				}

				// recording option
				$oOptions[ $sKey ] = $sValue;
				$sOptions = trim( substr( $sOptions, $iPosStop ) );

			}while( true );

			return $oOptions;
		};

		// analysis and processing of content
		$oContent = array();
		$oLines = explode( "\n", $sContent );
		$sContext = '';
		foreach( $oLines as $sLine ){

			// recovery of the line
			$sLine = trim( $sLine );
			if( $sLine == '' || substr( $sLine, 0, 1 ) == '#' ){
				continue;
			}

			// determine if the context has to be taken into account
			if( strlen( $sLine ) > 2 && substr( $sLine, 0, 2 ) == '==' ){

				// recovered and the control context
				$sContext = trim( substr( $sLine, 2 ) );
				$iPosSep = stripos( $sLine, ':' );
				if( $iPosSep !== false ){
					$sContext = trim( substr( $sLine, 2, $iPosSep - 2 ) );
				}
				if( !array_key_exists( $sContext, $this->_oTagsContent ) ){

					// error, the context was not found
					echo 'Syntax error : the context was not found : <pre style="color:red"> context : '.$sContext.', line : '.$sLine."</pre>\n";
					continue;
				}

				// if there are options
				$oOptions = array();
				if( $iPosSep !== false ){
					$sOptions = substr( $sLine, $iPosSep + 1 );
					$oOptions = $fGetOptions( $sOptions, $this->_oTagsContent[ $sContext ] );
				}

				// adding the new context
				$oContent[] = array( 'type'=>$sContext, 'options'=>$oOptions, 'data'=>NULL );
				continue;
			}

			// recovery of the element
			$oElement = &$oContent[ count( $oContent ) - 1 ];

			// if the line contains options
			$oOptions = NULL;
			$iPosSep = stripos( $sLine, ':' );
			if( $iPosSep !== false && array_key_exists( $oElement[ 'type' ].'_items', $this->_oTagsItemsContent ) ){
				$sOptions = trim( trim( substr( $sLine, $iPosSep ), ':' ) );
				$sLine = substr( $sLine, 0, $iPosSep );
				$oOptions = $fGetOptions( $sOptions, $this->_oTagsItemsContent[ $oElement[ 'type' ].'_items' ] );
			}

			// get last context
			if( $oElement[ 'type' ] == 'line' ){
				if( $oElement[ 'data' ] == NULL ){
					$oElement[ 'data' ] = array();
				}

				$oInfos = explode( ',', $sLine );
				$oLine = array( 'number'=>$oInfos[ 0 ] );
				if( count( $oInfos ) > 1 ){
					$oLine[ 'label' ] = $oInfos[ 1 ];
				}
				if( count( $oInfos ) > 2 ){
					$oLine[ 'title' ] = $oInfos[ 2 ];
				}
				
				// propagation properties
				$oLine[ 'options' ] = array();
				foreach( array( 'color', 'case', 'labelLeft', 'colorLabelLeft', 'labelRight', 'colorLabelRight' ) as $sProp ){
					if( !isset( $oElement[ 'options' ][ $sProp ] ) ){
						$oElement[ 'options' ][ $sProp ] = $opt[ $sProp ];
						$oLine[ 'options' ][ $sProp ] = $oElement[ 'options' ][ $sProp ];
					}
					$oLine[ 'options' ][ $sProp ] = $oElement[ 'options' ][ $sProp ];
				}
				if( !is_null( $oOptions ) ){
					foreach( $oOptions as $sKey=>$oValue ){
						$oLine[ 'options' ][ $sKey ] = $oValue;
					}
				}
				$oElement[ 'data' ][ intval( $oInfos[ 0 ] ) ] = $oLine;

			}else if( $oElement[ 'type' ] == 'text' ){
				$oElement[ 'data' ] .= $sLine;
			}
		}

		// update content
		$opt[ 'content' ] = $oContent;
		return $opt;
	}
	
	/*
	 * Create output
	 */
	function render($mode, &$renderer, $opt) {
		if( $mode == 'metadata' ){ return false; }

		// determines the maximum number of elements in width &
		// determine the position of the minimum and maximum index
		$iNbrElementsWidth = 0;
		$oElements = $opt[ 'content' ];
		foreach( $oElements as &$oElement ){
			if( $oElement[ 'type' ] != 'line' ){
				continue;
			}
			$MinIndex = 1000;
			$iMaxIndex = 0;
			if( isset( $oElement[ 'data' ] ) ){
				foreach( $oElement[ 'data' ] as $iLine=>$oLine ){
					if( $MinIndex > $iLine ){
						$MinIndex = $iLine;
					}
					if( $iMaxIndex < $iLine ){
						$iMaxIndex = $iLine;
					}
				}
			}
			$iDiff = ( $iMaxIndex - $MinIndex ) + 1;
			if( $iNbrElementsWidth < $iDiff ){
				$iNbrElementsWidth = $iDiff;
			}
			if( isset( $oElement[ 'options' ][ 'number' ] ) && $oElement[ 'options' ][ 'number' ] > $iNbrElementsWidth ){
				$iNbrElementsWidth = $oElement[ 'options' ][ 'number' ];
			}
			
			// re-index elements
			if( isset( $oElement[ 'data' ] ) ){
				ksort( $oElement[ 'data' ] );
				$oTmpData = array();
				for( $i=$MinIndex; $i<=$iMaxIndex; $i++ ){
					$oTmpData[ $i ] = isset( $oElement[ 'data' ][ $i ] ) ?
						$oElement[ 'data' ][ $i ] :
						array( 'number'=>$i, 'label'=>'', 
							'options'=>array( 'color'=>$oElement[ 'options' ][ 'color' ], 'case'=>$oElement[ 'options' ][ 'case' ],
							'labelLeft'=>$oElement[ 'options' ][ 'labelLeft' ], 'colorLabelLeft'=>$oElement[ 'options' ][ 'colorLabelLeft' ],
							'labelRight'=>$oElement[ 'options' ][ 'labelRight' ], 'colorLabelRight'=>$oElement[ 'options' ][ 'colorLabelRight' ] ) );
				}			
				$oData = array();
				foreach( $oTmpData as $oLine ){
					$oData[ count( $oData ) ] = $oLine;
				}
				$oElement[ 'data' ] = $oData;
			}
		}

		// if there are groups
		$iWidthGroup = 0;
		if( $opt[ 'group' ] > 0 ){
			$iWidthGroup = floor( $iNbrElementsWidth / $opt[ 'group' ] ) * $opt[ 'groupSeparatorWidth' ];
			if( $iNbrElementsWidth % $opt[ 'group' ] == 0 ){
				$iWidthGroup -= $opt[ 'groupSeparatorWidth' ];
			}
		}

		// calculates the width
		$iGroup = $opt[ 'group' ];
		$iWidthSvg = $iWidthGroup +
			( $opt[ 'showEars' ] ? ( $opt[ 'elementWidth' ] * 4 ) : ( $opt[ 'elementSeparatorWidth' ] * 2 ) ) + // if show Ears
			( $iNbrElementsWidth * $opt[ 'elementWidth' ] ) +
			( $iNbrElementsWidth > 1 ? ( ( $iNbrElementsWidth - 1 ) * $opt[ 'elementSeparatorWidth' ] ) : 0 );

		// calculates the height
		$iHeightSvg = 0;
		foreach( $oElements as &$oElement ){
			$iHeightSvg += $opt[ 'elementSeparatorHeight' ];
			if( $oElement[ 'type' ] == 'line' ){
				$iHeightSvg += $opt[ 'elementHeight' ];
			}else if( $oElement[ 'type' ] == 'text' ){
				if( isset( $oElement[ 'options' ][ 'size' ] ) ){
					$iHeightSvg += $oElement[ 'options' ][ 'size' ];
				}else{
					$iHeightSvg += $opt[ 'textSize' ];
				}
			}else if( $oElement[ 'type' ] == 'heightBar' ){
				$iBarHeight = $opt[ 'barHeight' ];
				if( isset( $oElement[ 'options' ][ 'height' ] ) ){
					$iBarHeight = $oElement[ 'options' ][ 'height' ];
				}
				$iHeightSvg += $iBarHeight;
			}
		}
		
		// the last element
		if( count( $oElements ) > 0 ){
			$iHeightSvg += $opt[ 'elementSeparatorHeight' ];
		}
		
		$sPathTemplateClass = dirname( __FILE__ ).DIRECTORY_SEPARATOR.'tpl'.DIRECTORY_SEPARATOR;;
		$fDrawCase = function( $oCase, $iX, $iY ) use ( $opt, $sPathTemplateClass ){
			
			// search the associated class
			$sCase = $oCase[ 'options' ][ 'case' ];
			if( !file_exists( $sPathTemplateClass.'switchpanel.case.'.$sCase.'.class.php' ) ){
				$sCase = $opt[ 'case' ];
			}

			require_once( $sPathTemplateClass.'switchpanel.case.'.$sCase.'.class.php' );
			$sClassName = 'switchpanel_case_'.$sCase;

			return $sClassName::getSvg( $oCase, $iX, $iY, $opt );
		};
		
		// construction of SVG
		$sSvg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="'.$iHeightSvg.'px" width="'.$iWidthSvg.'px">'.
			'<metadata>image/svg+xml</metadata>'.
			'<rect fill="'.$opt[ 'switchColor' ].'" height="'.$iHeightSvg.'px" width="'.$iWidthSvg.'px" x="0" y="0" rx="'.( $opt[ 'showEars' ] ? 10 : 5 ).'" ry="'.( $opt[ 'showEars' ] ? 10 : 5 ).'" />';
		
		// inclusion of the logo and bolts
		if( $opt[ 'showEars' ] ){
			require_once( $sPathTemplateClass.'switchpanel.screw.none.class.php' );
			if( !in_array( $opt[ 'logo' ], array( '', 'none' ), true ) ){
				if( $opt[ 'logoLink' ] != '' ){
					$sSvg .= '<a xlink:href="'.$opt[ 'logoLink' ].'" target="'.( $opt[ 'target' ] ).'" style="text-decoration:none">';
				}
				$sSvg .= '<image x="'.( ( $opt[ 'elementWidth' ] * 2 ) - ( $opt[ 'elementSeparatorWidth' ] + 30 ) ).'" y="'.$opt[ 'elementSeparatorHeight' ].'" width="30" height="30" xlink:href="'.$opt[ 'logo' ].'" />';
				if( $opt[ 'logoLink' ] != '' ){
					$sSvg .= '</a>';
				}
			}
			$iHeightScrew = $iHeightSvg - ( ( $opt[ 'elementSeparatorHeight' ] * 2 ) + $opt[ 'screwHeight' ] );
			$iNbrScrews = floor( $iHeightScrew / $opt[ 'screwHeightSpace' ] );
			if( $iNbrScrews == 0 ){
				$iNbrScrews++;
			}
			$iHeightScrew = $iHeightScrew / $iNbrScrews;
			$iNbrScrews++;
			if( $iNbrScrews == 1 ){
				$iNbrScrews++;
				$iHeightScrew = $iHeightSvg - ( ( $opt[ 'elementSeparatorHeight' ] * 2 ) + $opt[ 'screwHeight' ] );
			}
			
			$iPosHeightScrew = $opt[ 'elementSeparatorHeight' ];
			for( $i=1; $i<=$iNbrScrews; $i++ ){
				$sSvg .= switchpanel_screw_none::getSvg( $opt[ 'elementSeparatorWidth' ], $iPosHeightScrew, $opt ).
					switchpanel_screw_none::getSvg( ( $iWidthSvg - $opt[ 'elementSeparatorWidth' ] - $opt[ 'screwWidth' ] ), $iPosHeightScrew, $opt );
				$iPosHeightScrew += $iHeightScrew;
			}
		}	
		
		// drawing of the elements
		$iIndexY = 0;
		$bFirstLine = true;
		foreach( $oElements as &$oElement ){
			$iIndexX = $opt[ 'showEars' ] ? ( $opt[ 'elementWidth' ] * 2 ) : $opt[ 'elementSeparatorWidth' ];
			$iIndexY += $opt[ 'elementSeparatorHeight' ];
			if( $oElement[ 'type' ] == 'line' ){
				$oCases = $oElement[ 'data' ];
				for( $i=0; $i<$iNbrElementsWidth; $i++ ){
					$oCase = array( 'case'=>'none' );
					if( isset( $oCases[ $i ] ) ){
						$oCase = $oCases[ $i ];
					}					
					$sSvg .= $fDrawCase( $oCase, $iIndexX, $iIndexY );
					if( $i - 1 < $iNbrElementsWidth ){
						$iIndexX += $opt[ 'elementSeparatorWidth' ];
					}
					$iIndexX += $opt[ 'elementWidth' ];

					// if there are groups
					if( $opt[ 'group' ] > 0 && ( $i + 1 < $iNbrElementsWidth ) && ( ( $i + 1 ) % $iGroup ) == 0 ){
						$iIndexX += $opt[ 'groupSeparatorWidth' ];
					}
				}
				
				if( $opt[ 'showEars' ] ){
					if( isset( $oElement[ 'options' ][ 'labelLeft' ] ) && trim( $oElement[ 'options' ][ 'labelLeft' ] ) != '' ){
						$iMoveX = 0;
						if( $bFirstLine && !in_array( $opt[ 'logo' ], array( '', 'none' ), true ) && $iIndexY == $opt[ 'elementSeparatorHeight' ] ){
							$iMoveX = $opt[ 'elementWidth' ] - $opt[ 'elementSeparatorWidth' ];
						}
						$sSvg .= '<text x="'.( $opt[ 'elementWidth' ] + ( $opt[ 'elementWidth' ] / 2 ) - $opt[ 'elementSeparatorWidth' ] - $iMoveX ).'" y="'.( $iIndexY + ( $opt[ 'elementHeight' ] / 1.5 ) + $opt[ 'elementSeparatorHeight' ] ).'" '.
							'style="fill:'.$oElement[ 'options' ][ 'colorLabelLeft' ].';" font-size="22" '.
							'text-anchor="middle">'.$oElement[ 'options' ][ 'labelLeft' ].'</text>';
					}
					if( isset( $oElement[ 'options' ][ 'labelRight' ] ) && trim( $oElement[ 'options' ][ 'labelRight' ] ) != '' ){
						$sSvg .= '<text x="'.( $iIndexX + ( $opt[ 'elementWidth' ] / 2 ) ).'" y="'.( $iIndexY + ( $opt[ 'elementHeight' ] / 1.5 ) + $opt[ 'elementSeparatorHeight' ] ).'" '.
								'style="fill:'.$oElement[ 'options' ][ 'colorLabelRight' ].';" font-size="22" '.
								'text-anchor="middle">'.$oElement[ 'options' ][ 'labelRight' ].'</text>';
					}
				}				
				$iIndexY += $opt[ 'elementHeight' ];
				$bFirstLine = false;
			}else if( $oElement[ 'type' ] == 'text' ){
				require_once( $sPathTemplateClass.'switchpanel.text.none.class.php' );
				$sSvg .= switchpanel_text_none::getSvg( $oElement, $iIndexX, $iIndexY, $opt, $iWidthSvg );
				$iHeightText = $opt[ 'textSize' ];
				if( isset( $oElement[ 'options' ][ 'size' ] ) ){
					$iHeightText = $oElement[ 'options' ][ 'size' ];
				}
				$iIndexY += $iHeightText;
			}else if( $oElement[ 'type' ] == 'heightBar' ){
				$iBarHeight = $opt[ 'barHeight' ];
				if( isset( $oElement[ 'options' ][ 'height' ] ) ){
					$iBarHeight = $oElement[ 'options' ][ 'height' ];
				}
				$iIndexY += $iBarHeight;
			}
		}
		$sSvg .= '</svg>';
		
		// generation rendering
		if ($mode != 'odt') {
			$renderer->doc .= '<div style="overflow-x:auto;">'.$sSvg.'</div>';
		} else {
			// When exporting to ODT format always make the switchpannel as wide
			// as the whole page without margins (but keep the width/height relation!). 
			$widthInCm = $renderer->_getAbsWidthMindMargins();
			$heightInCm = $widthInCm * ($iHeightSvg/$iWidthSvg);
			$renderer->_addStringAsSVGImage($sSvg, $widthInCm.'cm', $heightInCm.'cm');
		}
		return true;
	}
}
