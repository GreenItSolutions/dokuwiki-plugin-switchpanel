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
			.css( { left: oEvent.clientX + 10, top: oEvent.clientY + 10, display: 'block' } );
	};
	
	this.hideToolTip = function(){
		jQuery( '#switchpanel_tooltip' ).css( { display: 'none' } );
	};
}

jQuery( document ).ready( function(){
	window.oSwitchPanel = new switchpanel();
} );