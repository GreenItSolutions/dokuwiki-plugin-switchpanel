<?php
	class switchpanel_screw_none{
		public static function getSvg( $iX, $iY, $opt ){
			return '<rect fill="'.$opt[ 'screwColor' ].'" x="'.$iX.'" y="'.$iY.'" width="'.$opt[ 'screwWidth' ].'" height="'.$opt[ 'screwHeight' ].'" ry="9"></rect>';
		}
	}