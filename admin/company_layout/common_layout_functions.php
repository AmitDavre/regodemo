<?php

	// SAVED ADMIN DASHBOARD LAYOUT
	$savedAdminDashboardlayout = getSavedAdminDashboardLayout();
	// SAVED HEADER LAYOUT
	$savedHeaderlayout = getSavedHeaderScreenLayout();	
	// DEFAULT FONTS SAVED IN DATABASE 
	$savedDefaultFonts = getDefaultFonts();
	// GET TYPE OF SET 
	$savedlayoutSetName = getSavedLayout();
	// GET COLORS WHERE COLOR SET AND TYPE OF SET 
	$savedAdminColors = getSavedAdminLayoutColors($savedlayoutSetName['color_set'],$savedlayoutSetName['typeofcolorset']);


	
?>