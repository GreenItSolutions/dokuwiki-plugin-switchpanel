<?php
	class switchpanel_case_serial{
		public static function getSvg( $oCase, $iX, $iY, $opt ){
			$sSvg = '';
			if( isset( $oCase[ 'options' ][ 'link' ] ) ){
				$sSvg .= '<a xlink:href="'.$oCase[ 'options' ][ 'link' ].'" target="'.( isset( $oCase[ 'options' ][ 'target' ] ) ? $oCase[ 'options' ][ 'target' ] : $opt[ 'target' ] ).'" style="text-decoration:none">';
			}
			if( isset( $oCase[ 'options' ][ 'text' ] ) ){
				$sLabel = str_replace( "\\", "\\'", isset( $oCase[ 'label' ] ) ? $oCase[ 'label' ] : '' );
				$sTitle = str_replace( "\\", "\\'", isset( $oCase[ 'title' ] ) ? $oCase[ 'title' ] : '' );
				$sText = str_replace( "\\", "\\'", $oCase[ 'options' ][ 'text' ] );
				$sLink = str_replace( "\\", "\\'", isset( $oCase[ 'options' ][ 'link' ] ) ? $oCase[ 'options' ][ 'link' ] : '' );
				$sSvg .= '<g onmousemove="window.oSwitchPanel.showToolTip(evt, \''.$sLabel.'\', \''.$sTitle.'\', \''.$sText.'\', \''.$sLink.'\')" onmouseout="window.oSwitchPanel.hideToolTip()">';
			}
			
			$sColor = $opt[ 'color' ];
			if( isset( $oCase[ 'options' ][ 'color' ] ) ){
				$sColor = $oCase[ 'options' ][ 'color' ];
			}
			
			$sSvg .= '<rect x="'.$iX.'" y="'.$iY.'" width="'.$opt[ 'elementWidth' ].'" height="'.$opt[ 'elementHeight' ].'" fill="'.$sColor.'"/>
				<rect x="'.$iX.'" y="'.$iY.'" width="'.$opt[ 'elementWidth' ].'" height="'.( $opt[ 'elementHeight' ] / 2.65 ).'" stroke-width="'.( $opt[ 'elementWidth' ] / 30 ).'" stroke="#000000" fill="#ffffff" ry="1.5" rx="1.5"/>
				<text x="'.( $iX + ( $opt[ 'elementWidth' ] / 2 ) ).'" y="'.( $iY + ( $opt[ 'elementHeight' ] / 3.6 ) ).'" style="font-weight:bold;" text-anchor="middle" font-family="sans-serif" font-size="'.( $opt[ 'elementWidth' ] * 0.27 ).'" fill="#000000">'.$oCase[ 'label' ].'</text>
				<path d="M'.( $iX + ( $opt[ 'elementWidth' ] / 6 ) ).','.( $iY + ( $opt[ 'elementHeight' ] / 1.9 ) ).' C'.( $iX + ( $opt[ 'elementWidth' ] ) ).','.( $iY + ( $opt[ 'elementHeight' ] / 1.9 ) ).' '.( $iX  ).','.( $iY + ( $opt[ 'elementHeight' ] / 1.25 ) ).' '.( $iX + ( $opt[ 'elementWidth' ] / 1.56 ) ).','.( $iY + ( $opt[ 'elementHeight' ] / 1.25 ) ).'" stroke="#3AC96F" fill="transparent"/>
				<path d="M'.( $iX + ( $opt[ 'elementWidth' ] / 6 ) ).','.( $iY + ( $opt[ 'elementHeight' ] / 1.8 ) ).' C'.( $iX + ( $opt[ 'elementWidth' ] ) ).','.( $iY + ( $opt[ 'elementHeight' ] / 1.8 ) ).' '.( $iX  ).','.( $iY + ( $opt[ 'elementHeight' ] / 1.20 ) ).' '.( $iX + ( $opt[ 'elementWidth' ] / 1.56 ) ).','.( $iY + ( $opt[ 'elementHeight' ] / 1.20 ) ).'" stroke="#26964F" fill="transparent"/>
				<path d="M'.( $iX + ( $opt[ 'elementWidth' ] / 6 ) ).','.( $iY + ( $opt[ 'elementHeight' ] / 1.7 ) ).' C'.( $iX + ( $opt[ 'elementWidth' ] ) ).','.( $iY + ( $opt[ 'elementHeight' ] / 1.7 ) ).' '.( $iX  ).','.( $iY + ( $opt[ 'elementHeight' ] / 1.15 ) ).' '.( $iX + ( $opt[ 'elementWidth' ] / 1.56 ) ).','.( $iY + ( $opt[ 'elementHeight' ] / 1.15 ) ).'" stroke="#156934" fill="transparent"/>
				<rect x="'.( $iX + ( $opt[ 'elementWidth' ] / 8 ) ).'" y="'.( $iY + ( $opt[ 'elementHeight' ] / 2 ) ).'" width="'.( $opt[ 'elementWidth' ] / 4 ).'" height="'.( $opt[ 'elementHeight' ] / 5 ).'" fill="#276921" ry="1.5" rx="1.5"/>
				<rect x="'.( $iX + ( $opt[ 'elementWidth' ] / 1.56 ) ).'" y="'.( $iY + ( $opt[ 'elementHeight' ] / 1.37 ) ).'" width="'.( $opt[ 'elementWidth' ] / 4 ).'" height="'.( $opt[ 'elementHeight' ] / 5 ).'" fill="#276921" ry="1.5" rx="1.5"/>';
			
			if( isset( $oCase[ 'title' ] ) ){
				$sSvg .= '<text x="'.( $iX + ( $opt[ 'elementWidth' ] / 2 ) ).'" y="'.( $iY + ( $opt[ 'elementHeight' ] / 1.25 ) ).'" text-anchor="middle" font-family="sans-serif" font-size="'.( $opt[ 'elementWidth' ] * 0.3 ).'" fill="#ffffff">'.$oCase[ 'title' ].'</text>';
			}
			if( isset( $oCase[ 'options' ][ 'text' ] ) ){
				$sSvg .= '</g>';
			}
			if( isset( $oCase[ 'options' ][ 'link' ] ) ){
				$sSvg .= '</a>';
			}
			
			return $sSvg;
		}
	}