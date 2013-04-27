function addLink(){

	var url = jQuery('#altp_url').val();
	var name = jQuery('#altp_name').val();
	var window = jQuery('#altp_window').val();
	var desc = jQuery('#altp_desc').val();
	
	if(url != '' && name != ''){ //check if both url and name have been filled out
		
		jQuery('#altp_links').append('<div class="altp_link_container"><a class="altp_link" href="'+url+'" target="'+window+'">'+name+'</a><p class="altp_link_desc">'+desc+'</p></div>'); //append the new link
		
		getLinkHtml()
		
		addRemoveDiv();		
	
	}else{
		alert('Please fill in both the name and url of your new link.');
	}
	
}

function removeLink(link){

	link.parent().remove(); //remove the clicked link
	
	getLinkHtml();
	
	addRemoveDiv();
	
}

function getLinkHtml(){

	jQuery('.altp_remove').remove(); //remove all delete divs
	
	var links = jQuery('#altp_links').html(); //grab the html of the links (now without the remove div)
	
	jQuery('#altp_links_html').val(links); //add the html to the input

}

function addRemoveDiv(){
	jQuery('.altp_link_container').each(function(){
		jQuery(this).prepend('<div onClick="removeLink(jQuery(this));" class="altp_remove"></div>');
	}); //add the remove div to each link
}