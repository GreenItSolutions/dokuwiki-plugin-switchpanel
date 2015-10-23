<?php
	class switchpanel_text_none{
		public static function getSvg( $oText, $iX, $iY, $opt, $iWidthSvg ){
			$iHeightText = $opt[ 'textSize' ];
			if( isset( $oText[ 'options' ][ 'size' ] ) ){
				$iHeightText = $oText[ 'options' ][ 'size' ];
			}
			$sTextBgColor = $opt[ 'textBgColor' ];
			if( isset( $oText[ 'options' ][ 'bgColor' ] ) ){
				$sTextBgColor = $oText[ 'options' ][ 'bgColor' ];
			}
			$sTextColor = $opt[ 'textColor' ];
			if( isset( $oText[ 'options' ][ 'color' ] ) ){
				$sTextColor = $oText[ 'options' ][ 'color' ];
			}
			$sBrColor = $opt[ 'textBrColor' ];
			if( isset( $oText[ 'options' ][ 'brColor' ] ) ){
				$sBrColor = $oText[ 'options' ][ 'brColor' ];
			}
			$sBrRadius = $opt[ 'textBrRadius' ];
			if( isset( $oText[ 'options' ][ 'brRadius' ] ) ){
				$sBrRadius = $oText[ 'options' ][ 'brRadius' ];
			}
			$sBrRadiusSvg = '';
			if( !in_array( $sBrRadius, array( '', 'none' ), true ) ){
				$sBrRadiusSvg = ' rx="'.$sBrRadius.'" ry="'.$sBrRadius.'"';
			}

			// CSS style
			$sTagStyleText = '';
			$sTagStyleBack = '';
			if( !in_array( $sTextColor, array( '', 'none' ), true ) ){
				$sTagStyleText .= 'fill:'.$sTextColor.';';
			}
			if( !in_array( $sBrColor, array( '', 'none' ), true ) ){
				$sTagStyleBack .= 'stroke:'.$sBrColor.';';
			}
			
			$sSvg = '';
			if( !in_array( $sTextBgColor, array( '', 'none' ), true ) ){
				$sSvg .= '<rect style="'.$sTagStyleBack.'" fill="'.$sTextBgColor.'" x="'.$iX.'" y="'.$iY.'" width="'.( $iWidthSvg - ( $iX * 2 ) ).'" height="'.$iHeightText.'"'.$sBrRadiusSvg.'/>';
			}
			$sSvg .= '<text style="'.$sTagStyleText.'" font-size="'.$iHeightText.'" fill="black" y="'.( ( $iY + $iHeightText ) - ( $opt[ 'elementSeparatorWidth' ] / 2 ) ).'" x="'.( $iX + ( $opt[ 'elementSeparatorWidth' ] / 2 ) ).'">'.$oText[ 'data' ].' </text>';
			
			return $sSvg;
		}
	}