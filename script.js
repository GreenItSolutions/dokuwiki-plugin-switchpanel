function patchpanel_create_tooltip_div() {
	var tooltip = document.getElementById("patchpanel_tooltip");
	if (!tooltip) {
		tooltip = document.createElement('div');
		tooltip.setAttribute("id", "patchpanel_tooltip");
		document.body.appendChild(tooltip);
	}
}

function patchpanel_toggle_vis(element,vis_mode) {
	element.style.display = patchpanel_toggle(element.style.display,"none",vis_mode);
	return element.style.display!="none";
}

function patchpanel_toggle(v,a,b) {
	return (v==a)?b:a;
}