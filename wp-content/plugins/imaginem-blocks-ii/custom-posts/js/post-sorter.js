jQuery(document).ready(function($) {
	var fullscreenList = jQuery('#portfolio-list');
	var portfolioList = jQuery('#portfolio-list');
	var eventList = jQuery('#portfolio-list');
	var proofingList = jQuery('#proofing-list');
 
	fullscreenList.sortable({
		update: function(event, ui) {
			jQuery('#loading-animation').show(); // Show the animate loading gif while waiting
 
			opts = {
				url: ajaxurl, // ajaxurl is defined by WordPress and points to /wp-admin/admin-ajax.php
				type: 'POST',
				async: true,
				cache: false,
				dataType: 'json',
				data:{
					action: 'fullscreen_sort', // Tell WordPress how to handle this ajax request
					order: fullscreenList.sortable('toArray').toString() // Passes ID's of list items in	1,3,2 format
				},
				success: function(response) {
					jQuery('#loading-animation').hide(); // Hide the loading animation
					return; 
				},
				error: function(xhr,textStatus,e) {  // This can be expanded to provide more information
					//alert('There was an error saving the updates '+textStatus+" "+e);
					jQuery('#loading-animation').hide(); // Hide the loading animation
					return; 
				}
			};
			jQuery.ajax(opts);
		}
	});	
	portfolioList.sortable({
		update: function(event, ui) {
			jQuery('#loading-animation').show(); // Show the animate loading gif while waiting
 
			opts = {
				url: ajaxurl, // ajaxurl is defined by WordPress and points to /wp-admin/admin-ajax.php
				type: 'POST',
				async: true,
				cache: false,
				dataType: 'json',
				data:{
					action: 'portfolio_sort', // Tell WordPress how to handle this ajax request
					order: fullscreenList.sortable('toArray').toString() // Passes ID's of list items in	1,3,2 format
				},
				success: function(response) {
					jQuery('#loading-animation').hide(); // Hide the loading animation
					return; 
				},
				error: function(xhr,textStatus,e) {  // This can be expanded to provide more information
					//alert('There was an error saving the updates '+textStatus+" "+e);
					jQuery('#loading-animation').hide(); // Hide the loading animation
					return; 
				}
			};
			jQuery.ajax(opts);
		}
	});		
	eventList.sortable({
		update: function(event, ui) {
			jQuery('#loading-animation').show(); // Show the animate loading gif while waiting
 
			opts = {
				url: ajaxurl, // ajaxurl is defined by WordPress and points to /wp-admin/admin-ajax.php
				type: 'POST',
				async: true,
				cache: false,
				dataType: 'json',
				data:{
					action: 'event_sort', // Tell WordPress how to handle this ajax request
					order: fullscreenList.sortable('toArray').toString() // Passes ID's of list items in	1,3,2 format
				},
				success: function(response) {
					jQuery('#loading-animation').hide(); // Hide the loading animation
					return; 
				},
				error: function(xhr,textStatus,e) {  // This can be expanded to provide more information
					//alert('There was an error saving the updates '+textStatus+" "+e);
					jQuery('#loading-animation').hide(); // Hide the loading animation
					return; 
				}
			};
			jQuery.ajax(opts);
		}
	});		
	proofingList.sortable({
		update: function(event, ui) {
			jQuery('#loading-animation').show(); // Show the animate loading gif while waiting
 
			opts = {
				url: ajaxurl, // ajaxurl is defined by WordPress and points to /wp-admin/admin-ajax.php
				type: 'POST',
				async: true,
				cache: false,
				dataType: 'json',
				data:{
					action: 'proofing_sort', // Tell WordPress how to handle this ajax request
					order: proofingList.sortable('toArray').toString() // Passes ID's of list items in	1,3,2 format
				},
				success: function(response) {
					jQuery('#loading-animation').hide(); // Hide the loading animation
					return; 
				},
				error: function(xhr,textStatus,e) {  // This can be expanded to provide more information
					//alert('There was an error saving the updates '+textStatus+" "+e);
					jQuery('#loading-animation').hide(); // Hide the loading animation
					return; 
				}
			};
			jQuery.ajax(opts);
		}
	});		
});