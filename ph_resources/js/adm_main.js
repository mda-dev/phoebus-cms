//slug character arrays
slugArray = function(){

	$a = [
		'À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß',
		'à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ','Ā',
		'ā','Ă','ă','Ą','ą','Ć','ć','Ĉ','ĉ','Ċ','ċ','Č','č','Ď','ď','Đ','đ','Ē','ē','Ĕ','ĕ','Ė','ė','Ę','ę','Ě','ě','Ĝ','ĝ','Ğ',
		'ğ','Ġ','ġ','Ģ','ģ','Ĥ','ĥ','Ħ','ħ','Ĩ','ĩ','Ī','ī','Ĭ','ĭ','Į','į','İ','ı','Ĳ','ĳ','Ĵ','ĵ','Ķ','ķ','Ĺ','ĺ','Ļ','ļ','Ľ',
		'ľ','Ŀ','ŀ','Ł','ł','Ń','ń','Ņ','ņ','Ň','ň','ŉ','Ō','ō','Ŏ','ŏ','Ő','ő','Œ','œ','Ŕ','ŕ','Ŗ','ŗ','Ř','ř','Ś','ś','Ŝ','ŝ',
		'Ş','ş','Š','š','Ţ','ţ','Ť','ť','Ŧ','ŧ','Ũ','ũ','Ū','ū','Ŭ','ŭ','Ů','ů','Ű','ű','Ų','ų','Ŵ','ŵ','Ŷ','ŷ','Ÿ','Ź','ź','Ż',
		'ż','Ž','ž','ſ','ƒ','Ơ','ơ','Ư','ư','Ǎ','ǎ','Ǐ','ǐ','Ǒ','ǒ','Ǔ','ǔ','Ǖ','ǖ','Ǘ','ǘ','Ǚ','ǚ','Ǜ','ǜ','Ǻ','ǻ','Ǽ','ǽ','Ǿ','ǿ']

	$b = [
		'A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','ss',
		'a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A',
		'a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G',
		'g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L',
		'l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s',
		'S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z'
		,'Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o']


	$c = [];
		for(var i = 0; i < $a.length; i++){
			$c[$a[i]] = $b[i];
		}

	return $c;
}




//hide phoebus version notice
$("#ph-hide-notice").on("click", function(){
	$(this).fadeOut(800, function(){

		var CookieDate = new Date;
		CookieDate.setFullYear(CookieDate.getFullYear( )+1);
		//console.log(CookieDate.toGMTString());
		version = $(this).attr("href").replace("#", "");
		document.cookie="ph_hide_new_ver_notice=" + version + '; expires=' + CookieDate.toGMTString() + '; path='+ window.location.pathname;
		$("#hide-version-notice").fadeOut(800)
	});
	
	return false;
});


//initialize ck editor on content textfields
if( $("textarea[name*='content']").attr("id")){
	$name = $("textarea[name*='content']").attr("name");
	CKEDITOR.replace( $name );
}

//small javascript back link
$(".error-link.back").click(function(){
	window.history.go(-1);
	return false;
});


//Automatic slug generation
$("input[name*='_title']").on("blur", function(e){
	$slugField = $("input[name*='_slug']");
	match      = new slugArray();
	val        = $(this).val();
	slugVal    = new String();

	for (i = 0; i < val.length; i++){
		ch = val.charAt(i);

		if(match[ch]){
			slugVal += match[ch];
		}else{
			switch (ch){
				case " ":
					slugVal += "-";
					break;
				default:
					if( /^[a-zA-Z0-9_-]+$/.test(ch)){
						slugVal += ch;
					}
					break;
			}
		}
	}
	$slugField.val(slugVal);
});

//bind add new gallery item
$("#add-gallery-item").click(function(){
    // get number of blocks
    var count = $(".control-group.block1").length;

    // clone control hidden blocks blocks
    $newBlock1 = $(".control-group.hidden.block1").clone().removeClass("hidden");
    $newBlock2 = $(".control-group.hidden.block2").clone().removeClass("hidden");

    //change label name for block1
    $newBlock1.find("label").text("Item #"+ count);

    //change 'name' attribute for title field
    $name = $newBlock1.find("input").attr("name").replace("[0]", "[" + (count-1) + "]");
    $newBlock1.find("input").attr("name",$name);

    //change 'name' attribute for url field
    $url = $newBlock2.find("input").attr("name").replace("[0]", "[" + (count-1) + "]")
    $newBlock2.find("input").attr("name",$url);

    //apeend the new item blocks
    $("#gal_form").append($newBlock1);
    $("#gal_form").append($newBlock2).append("<hr class='soft small'></hr>");

return false;
})

//bind all .remove-item buttons
$("#gal_form, #post_form").on("mouseenter", ".btn.remove-item", function(event){$(this).tooltip("show")});
$("#gal_form, #post_form").on("click", ".btn.remove-item", function(event){ 
    Parent = $(this).parent().parent().parent();
    //remove ending hr
    Parent.next().next("hr").fadeOut("fast", function(){ $(this).remove() });
    //remove block2
    Parent.next().fadeOut("fast", function(){ $(this).remove() });
    //remove block1
    Parent.fadeOut("fast", function(){ $(this).remove() });

    return false;
});

//bind all .select-img buttons
$("#gal_form, #post_form").on("mouseenter", ".btn.select-img", function(event){$(this).tooltip("show")});
$("#gal_form, #post_form").on("click", ".btn.select-img", function(event){
    //set data for url filed (used for returning data from modal)
    $(this).prev("input").data("waiting-for-url", true); 
    //show modal box
    $("#imageModal").modal("show");
    return false;
});

//bind modal box save button
$("#img-select-save").click(function(){
    //get selected radio
    value = $("input[type=radio]:checked","#imageModal").val();
    //get filed that is waiting for value from the modal box
    input = $("#gal_form input, #post_form input").filter(function(){return $.data(this, "waiting-for-url");});
    //if a radio was selected set the value of the waiting field
    if(value){ input.val(value); }
})

//bind modal box when finished hiding
$("#imageModal").on("hidden", function(){
    //remove waiting status from the field
    $("#gal_form input, #post_form").filter(function(){return $.data(this, "waiting-for-url");}).removeData("waiting-for-url");
    // uncheck any radio buttons in the modal
    $("input:checked", $(this)).attr("checked",false);
})

//bind modal box when finished showing
$("#imageModal").on("shown", function(){
    //get value of waiting element
    var inputVal = $("#gal_form input").filter(function(){return $.data(this, "waiting-for-url");}).val();
    //check the radio that the same value as the waiting element
    $("input[value='"+ inputVal +"']", $(this)).prop('checked', true);
})
