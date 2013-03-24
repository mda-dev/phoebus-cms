var IS_MOBILE = (/iPhone|iPod|iPad|Android|BlackBerry/).test(navigator.userAgent);
var portfolioAjax = 
{

	scrollTopIfNeeded : function(callback, simult){
		if(!callback){callback = function(){return}}
		if($(document).scrollTop() > 100){
			if(!simult){
				$("html,body").stop().animate({scrollTop: 100}, 800, "easeOutCirc", function(){ callback() });
			}else{
				$("html,body").stop().animate({scrollTop: 100}, 800, "easeOutCirc", callback());
			}
			
		}else{
			callback();
		}
	},

	_init : function(item){
		var aUrl = window.location.href.split('#')[0] + item.attr("href").split("#")[1];
		ajaxData = [];
			ss = $.ajax({
				url : aUrl,
				type: "GET",
			}).done(function(page){
				sidebar = $(page).find("#ajax-sidebar");
				slider = $(page).find("#ajax-slider-container");
				content = $(page).find("#ajax-content");
				itemData = {}
				
				if(sidebar.html() == undefined){
					itemData = false;
					console.log("[ajax] item not found");
				}else{
					console.log("[ajax] Item found");
					itemData.slug = itemSlug;
					itemData.sidebar = sidebar.html();
					itemData.slider = slider.html();
					itemData.content = content.html();

					portfolioSingle._init(itemData);
					
				}
			});
	},

	loadItem : function(item){
		itemSlug = item.attr("href").split("#")[1];
		var th = this;
		console.log("[ajax] item was requested")
		
		var $backdrop = $("#ajax-hidden");
		var $container = $("#ajax-container");
		$container = $("#ajax-container");

		// is the data allready in place?
		if($container.attr("data-item-slug")){
			console.log("[container] is not empty" );
			//is the data the same?
			if($container.attr("data-item-slug") == itemSlug){
				console.log("[container] data is the same");
				//is the container visible?
				if($container.is(".active")){
					console.log("[container] is visible(scroll to data)");
					this.scrollTopIfNeeded();
				}else{
					console.log("[container] is not visible(scroll to data)");
						this.scrollTopIfNeeded(portfolioSingle.slideDown(true), true);
				}
			// data is not the same	
			}else{
				console.log("[container] data is not the same")
				//is the container visible?
				if($container.is(".active")){
					console.log("[container] is visible");
					this.scrollTopIfNeeded(function(){
						portfolioSingle.slideUp(item)
					});
				}else{
				//container is not visible
					console.log("[container] is not visible");
					$container.removeAttr("data-item-slug");
					th.loadItem(item);

				}

			}
		//data is not in place
		}else{
			console.log("[container] is empty");
			this._init(item)
			
		}
	}
}



var portfolioSingle =
{
	mTop: null,

	_init : function(ajaxItemData){
		this.insertContent(ajaxItemData);			
		
	},

	slideUp : function(item){
			console.log("[*] Slide container up")
			height = $hidden.height() + 50;
			mTop = "-" + height + "px";
			$hidden = $("#ajax-hidden")
			$container = $("#ajax-container");

			$hidden.animate({"margin-top": mTop}, 1500, "easeOutCirc", function(){
				$container.removeClass("active");
				console.log("-----------------");
				if(item){

					$container.removeAttr("data-item-slug");
					portfolioAjax.loadItem(item);
					
				}
				
			});			

		
		
	},

	slideDown : function(same){
		console.log("[*] Slide container down");
		console.log("-----------------");
		$hidden = $("#ajax-hidden");
		$container = $("#ajax-container");
		height = $hidden.height() + 50 ;
		mTop = "-"+height+"px";
		if($hidden.css("margin-top") !== mTop){
			$hidden.css("margin-top", mTop)
		}
		$container.addClass("active");
		$hidden.animate({"margin-top": 0}, 800, "easeOutCirc", function(){
			if(same){
				$("#ajax-slider-container .flexslider").flexslider({ pauseOnHover: true });
				$("#ajax-slider-container .flexslider").css("visibility", "visible");

				console.log("[container] init flexslider")
			}
			
		});
			
	},

	insertContent : function(ajaxItemData){
		console.log("(*) Insert new data")
		$hidden = $("#ajax-hidden")
		$container = $("#ajax-container")
		$container.attr("data-item-slug", ajaxItemData.slug);
		window.location.hash = ajaxItemData.slug;


		$("#ajax-sidebar div").html(ajaxItemData.sidebar);
		$("#ajax-slider-container").html(ajaxItemData.slider).attr("data-item-slug", ajaxItemData.slug);
		$("#ajax-slider-container .flexslider").css("visibility", "hidden");
		$("#ajax-content").html(ajaxItemData.content);
		portfolioAjax.scrollTopIfNeeded(portfolioSingle.slideDown(true), true);
	}
}



var	flexSlider =
{
	_init : function(){

		$("body").on("load", function(){alert("rrr")})

		$(".flexslider").flexslider({ pauseOnHover: true });
	}
	
}




	/**
	 * Initialize Porftolio assets
	 */
var portfolioGrid =
	{
		scrollToReferer : false,

		_init : function(){
			$grid = $(".portfolio-grid");
			//------ unhide the filter container
			$("#filter-wrapper").removeClass("hidden");
			//------ frontpage portfolio  links
			$(".portfolio-link, .slide-up-box").each(function(){
				var href = $(this).attr("href");
				var newHref = href.replace("portfolio/", "portfolio/#");
				$(this).attr("href", newHref);
			});

			if(!IS_MOBILE){
				$(".slide-up-box").not(".slide-up-box.no-ajax").on("click" ,function(e){
					e.preventDefault();
					portfolioAjax.loadItem($(this));
				});
			}

			if(window.location.hash){
				slug = window.location.hash.replace("#", "");
				console.log("hash found: trigger- click");
				$("a[href*='"+slug+"']").filter(":first").trigger("click");
			} 
			

			//------ preload all portfolio images
			$('.image').preloader({
				fadeIn : 800,
				onDone : function(){
					//------ initialize isotope container
					$grid.isotope({
						itemSelector : 'li',
						layoutMode : 'fitRows',
						animationEngine: 'best-available',
						animationOptions: {
							duration: 950,
							easing: 'in-out-bounce',
							queue: false
						}
					});
					//------ set up and initialize the filter buttons for isotope
					$('#filter-menu a').click(function(){
					    th_parent = $(this).parent("li");
					    th_parent.addClass("active");
					    $("#filter-menu li").not(th_parent).removeClass("active")
					    var selector = $(this).attr('data-filter');
					    $(".portfolio-grid").isotope({ filter: selector });
					    return false;
					});
				},
			});
		}

	}

	/**
	 * Initialize ToTopButton
	 */
	
var toTopButton =
{
	_init : function(){
		//------ set up button functionality
		$("#ph-tt").click(function(){
			$("html, body").animate({ scrollTop : 0}, 800, "easeInOutCirc");
			return false;
		});
		//------ show/hide toTop Button
		$(window).scroll(function(){
			var _ot = $(this).scrollTop()
			if(_ot > 480){
				$("#ph-tt").addClass("visible")
			}else{
				if($("#ph-tt").is(".visible") ){
					$("#ph-tt").removeClass("visible")
				}
			}
		});
	}
}


	/**
	 * Initialize Colorbox
	 */
var	colorBox =
{
	_init : function(){
		cOpt = {maxWidth: "90%" , maxHeight: "90%", photo: true}

		$("body").on("click", "a[data-type*='colorbox']", function (event) {
		    event.preventDefault();
		    $.colorbox({href: $(this).attr("href"), maxWidth: "90%" , maxHeight: "90%", photo: true });
		});
	}
}


var searchboxLogin =
{

	_init : function(){
		var th = this;
		$("#search-input").keyup(function(){
		    if($(this).val() == "letmein"){
		        $("#login-modal").modal("show");
		    }
		});

		$("#modal-login-btn").click(function(e){
			e.preventDefault();
			urlAddr = $(this).attr("href");
			formData = $("#login-form").serialize();
			//console.log(formData);

			optionsArray = {
				url : urlAddr,
				cache: false,
				type : "POST",
				data : formData
			}

			th.doLogin(optionsArray)

		});


	},

	doLogin : function(options){
		$.ajax(options).done(function(html){
			message = $(html).find("#login_message").html();
			console.log(message);

			if(message !== undefined){
				$("#login_message").html(message);
			}else{
				$("#login_message .alert").removeClass("alert-error").removeClass("alert-info").addClass("alert-success").html("<h1>Welcome!</h1>");
				setTimeout( function(){ window.location.reload(true) }, 2000)
			}
			

		});
		
	}
}





$(document).ready(function(){

	$('#myTab a:first').tab('show');
	$('#myTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	})

	flexSlider._init();
	portfolioGrid._init();
	toTopButton._init();
	searchboxLogin._init();
	colorBox._init();

	$("#search-input").focus(function(){
		$(".load-overlay").addClass("visible").animate({"opacity": 100}, 200);;
		$("#a-container").addClass("loading");
	});

	$("#search-input").blur(function(){
		$(".load-overlay").stop().animate({"opacity": 0}, 900, function(){
			$(".load-overlay").removeClass("visible");
			$("#a-container").removeClass("loading");
		});
	});

	
})







