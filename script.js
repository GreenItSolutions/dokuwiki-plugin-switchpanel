function switchpanel(){
	if( jQuery( '#switchpanel_tooltip' ).length == 0 ){
		jQuery( '<div id="switchpanel_tooltip"></div>' ).appendTo( 'body' );
	}
	
	this.showToolTip = function( oEvent, sLabel, sTitle, sText, sLink ){
		var sHtml = '';
		if( ( sLabel + sTitle ) != '' ){
			sHtml += '<div class="switchpanel_tooltip_title">' + sLabel + ( sTitle != '' ? ' : ' : '' ) + sTitle + '</div>';
		}
		sHtml += '<div class="switchpanel_tooltip_text">' + sText + '</div>';
		if( sLink != '' ){
			sHtml += '<div class="switchpanel_tooltip_link">' + sLink + '</div>';
		}
		jQuery( '#switchpanel_tooltip' )
			.html( sHtml )
			.css( { top: oEvent.clientY + 20, display: 'block' } );
		
		// calcul positioning coefficient to the left
		var iPosPopup = jQuery( oEvent.target ).attr( 'x' );
		var iWidthSvg = jQuery( oEvent.target ).closest( 'svg' ).attr( 'width' ).replace( 'px', '' );
		var iCoef = iPosPopup / iWidthSvg;
		
		// Move popup to the left
		jQuery( '#switchpanel_tooltip' )
			.css( { left: oEvent.clientX - ( jQuery( '#switchpanel_tooltip' ).width() * iCoef ) } );
	};
	
	this.hideToolTip = function(){
		jQuery( '#switchpanel_tooltip' ).css( { display: 'none' } );
	};
}

jQuery( document ).ready( function(){
	window.oSwitchPanel = new switchpanel();
} );
