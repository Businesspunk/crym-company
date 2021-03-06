function isObject (value) {
	return typeof value === 'object';
}

function removeA(arr) {
	var what, a = arguments, L = a.length, ax;
	while (L > 1 && arr.length) {
		what = a[--L];
		while ((ax= arr.indexOf(what)) !== -1) {
			arr.splice(ax, 1);
		}
	}
	return arr;
}

function removeFromArray( array, item )
{
	var data = [];
	console.log(array, item);

	for (let i = 0; i < array.length; i++) {
		if( array[i].id != item.id || array[i].type != item.type ){
			data.push(array[i]);
		}
	}

	return data;
}

function setGetParametr(parameterName, value) {
	var items = location.search.substr(1).split("&");
	items = items[0] == "" ? [] : items; 
	var result = "", query = "", isFind = false;

	console.log(items);
	
	// find
	for (var index = 0; index < items.length; index++) {
        let tmp = items[index].split("=");
        if (tmp[0] === parameterName){ 
			isFind = true;
		};
	}
	
	//increase
	if( isFind ){
		for (var index = 0; index < items.length; index++) {
			let tmp = items[index].split("=");
			if (tmp[0] === parameterName){ 
				tmp[1] = value;
			};
			query += tmp.join('=');
		}
	}else{
		items.push( parameterName + "=" + value);
		query = items.join('&');
	}

	return window.location.protocol + "//" + window.location.host + window.location.pathname + "?" + query;
}

function getPosts(page, type, place, btn){
	var res;
	$.ajax({
		type: "get",
		data: {
			page: page,
			type: type
		},
		success: function(e){
			place.append(e.content);
			if( !e.hasMorePages ){
				btn.slideUp();
			}
		}
	});
	
}

function removeA(arr) {
	var what, a = arguments, L = a.length, ax;
	while (L > 1 && arr.length) {
		what = a[--L];
		while ((ax= arr.indexOf(what)) !== -1) {
			arr.splice(ax, 1);
		}
	}
	return arr;
  }
  
function showErrors( messages ){
	$errorModal = $('#errorModal');
	$insertion = $errorModal.find('.insertion');
	$insertion.empty();
	$clone = $errorModal.find('.alert').clone().removeClass('d-none');

	messages.forEach(function(el){
		$insertion.append( $clone.text(el) );
	});

	$errorModal.modal();
}
$(document).ready(function(){

	(function(){
		$input = $('input[name=category_id]:checked');
		if( $input.length ){
			var value = $input.data('maincat');
			$('.attributes').fadeOut();
			$items = $('.attributes .item[data-maincat='+value+']');
			if( $items.length ){
				$('.attributes').fadeIn(100, function(){
					$items.fadeIn();
				});
			}
		}
	}());

	$(' .attributes input[type=radio]').on('click', function(){     
        if($(this).attr("checked") == 'checked') {  
            $(this).removeAttr('checked');
        } else {
            $(this).attr('checked', 'checked')
        }
	});
	
	$('[name="category_id"]').click(function(e){
		$('.attributes').fadeOut();
		var maincat = $(this).data('maincat');
		$items = $('.attributes .item[data-maincat='+maincat+']');
		if( $items.length ){
			$('.attributes').fadeIn(100, function(){
				$items.fadeIn();
			});
		}
	})

	$('.like-link').click(function(e){
		e.preventDefault();

		var id = $(this).data('favorite-id');
		$symbol = $('[data-favorite-id='+id+']');

		var res = Cookies.getJSON('favorite');
		res = res ? res : [];
		console.log(res.includes(id));
		$.post(routes_variable[0], {id: id, isAdded: res.includes(id) ? 1 : 0 }, function(){
		
			if( res.includes(id) ){
				removeA(res, id);
			}else{
				res.push(id);
			}
		
			Cookies.set('favorite', res, { expires: 180 });
			$symbol.toggleClass('active');
		});
	})

		$('.showMorePosts').click(function(e){
			e.preventDefault();
			$btn = $(this);
			var page = $btn.data('page');
			var type = $btn.data('type');
			getPosts( page, type, $btn.prev('.items.objects'), $btn);

			type = "page_" + type;
			var newurl = setGetParametr( type, page );
			window.history.pushState({ path: newurl }, '', newurl);

			++$btn.data().page;
		})
	
	$('.single_home .right .sticky').css( 'top' , $('header').height() + 20);


	$( "#salutation, #salutation_2, .add_post" ).selectmenu({});

	function refreshActiveServicePlan(){

		$('form.added_post .service .table .ui_radio input').each(function(){
			$(this).closest('.row').removeClass('active_row');
			if( $(this).is(':checked') ) {
				$(this).closest('.row').addClass('active_row');
			}
		})
	}

	$('section.add_choose .table.mobile .row').click(function(e){
		if( $('section.add_choose .table.mobile .row .button').has(e.target).length == 0 ){

			$(this).find('.icon_wrap i').toggleClass('active');

			$(this).next('.added_info').slideToggle(300);
		}
	})

	refreshActiveServicePlan();
	$('form.added_post .service .table .ui_radio input').change(refreshActiveServicePlan);

	$('section.first .second').slick({
	  slidesToShow: 7,
	  slidesToScroll: 1,
	  nextArrow: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
	  prevArrow: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
      infinite: true,
	  responsive: [
	    {
	      breakpoint: 1400,
	      settings: {
	        slidesToShow: 6,
	      }
	    },
	    {
	      breakpoint: 1000,
	      settings: {
	        slidesToShow: 5,
	      }
	    },
	    {
	      breakpoint: 700,
	      settings: {
	        slidesToShow: 4,
	      }
	    },
	    {
	      breakpoint: 550,
	      settings: {
	        slidesToShow: 3,
	      }
	    },
	    {
	      breakpoint: 400,
	      settings: {
	        slidesToShow: 2,
	      }
	    },

	  ]
	});

	$('header .account').click(function(e){
		$('.menu_account').fadeToggle(100);
	})

	$(document).click(function (e){
		var div = $(".menu_account"); 
		var div2 = $('.account');
		if ( !div.is(e.target ) 
		    && div.has(e.target).length === 0 && div2.has(e.target).length === 0 ) { 
			div.fadeOut(100);
		}
	});

	$('header .second').scroolly([
		{
			to: 'con-top',
			css: {
                position: 'static',
            }
		},
        {
            from: 'con-top = vp-top',
            to: 'doc-bottom',
            onTopIn: function($el){
            	$( 'header .wrap_before_second' ).height( $el.height() );
            },
            css: {
                position: 'fixed',
                top: '0',
                zIndex: '20',
                width: '100%'
            }
        },

    ], $('header .wrap_before_second'));



    $('.show_mobile_menu').click(function(){
    	$('.mobile_menu').addClass('active_mob_menu');
    	$('header, main, footer').addClass('blur');
    })
    $('.close_mob_menu').click(function(){
    	$('header, main, footer').removeClass('blur');
    	$('.mobile_menu').removeClass('active_mob_menu');
    })

    $(document).click(function(e){
    	if( 
    		$('.mobile_menu').hasClass('active_mob_menu') && 
    		$('.show_mobile_menu').has(e.target).length == 0 &&
    		$('.mobile_menu').has(e.target).length == 0
    	)
    	{
    		$('header, main, footer').removeClass('blur');
	    	$('.mobile_menu').removeClass('active_mob_menu');
    	}
    })

    $('.myPostsChangeType').click(function(e){
    	e.preventDefault();
    	$('.myPostsChangeType').removeClass('active');
    	$(this).addClass('active');

    	var targetClass = $(this).data('target');

    	$('.my-posts .contt .active, .my-posts .contt .close').fadeOut(100);

    	setTimeout(function(){
	    	$('.my-posts .contt').find(targetClass).fadeIn(300);
    	},100)
    })

    // Regular dialog messenger style
    $dialog = $('.my-messages .dialog');
    $chat = $dialog.find('.messages');
    $chatManager = $dialog.find('.left');
    function regularDialogMessenger(){
    	var mainHeight = $chat.closest('.right').height() - 1;

    	if( $chat.height() < mainHeight ){
	    	$chat.height(mainHeight);
    	}

    	if( $chatManager.height() < mainHeight ){
	    	$chatManager.height(mainHeight);
    	}

    }
    regularDialogMessenger();
    // /Regular dialog messenger style

    

    $('.dialog .showMenuDialog').click(function(){
		$(this).closest('.dialog').addClass('active_menu') ;
    })

    $(document).click(function(e){
    	$dialogsMenu = $('.dialog .left');

    	if( 
    		$dialogsMenu.has(e.target).length == 0 &&
    		$('.dialog .showMenuDialog').has( e.target ).length == 0 &&
    		!$('.dialog .showMenuDialog').is(e.target)
    	  ){
    		$('.dialog').removeClass('active_menu') ;
    	}
   
    })

    $('.dialog .itemDialogMenu').click(function(e){
    	$('.dialog .itemDialogMenu').removeClass('active');
    	$(this).addClass('active');
    	e.preventDefault();
    	var eq = $(this).data('eq');
    	$('.dialog .messages_wrap .ms_www').fadeOut(50);

    	setTimeout(function(){
    		$(`.dialog .messages_wrap .ms_www[data-eq=${eq}]`).fadeIn(200);
    	},200)


    })
    $('.dialog .left a.itemDialogMenu').first().addClass('active');

    var heights = $("section.profile .body .hiddable").map(function ()
    {
        return $(this).height();
    }).get();

    maxHeight = Math.max.apply(null, heights);
    $('section.profile .body').height(maxHeight);
    // My Profile
            $clicked = $('section.profile .container .right .head a');

            $clicked.click(function(e){
                e.preventDefault();
                $clicked.removeClass('active');
                $(this).addClass('active');

                var needClass = $(this).data('target');
                $act = $('section.profile .container .right .body').find(needClass);

                $('section.profile .container .right .body .hiddable').fadeOut(50, function(){
                    $act.fadeIn(50);					
				});

            })

    // /My Profile


    // Popup
        /* $(".modal2").each( function(){
            $(this).wrap('<div class="overlay"></div>')
        }); */

        $(".open-modal").on('click', function(e){
            e.preventDefault();
            e.stopImmediatePropagation;
            
            var $this = $(this),
					modal = $($this).data("modal");

            $(".close-modal").each(function(){
                $o = $(this);
                if( !$o.closest('.modal2').is( $(modal) ) ){
                    $o.click();
                }
            });

            
            $(modal).parents(".overlay").addClass("open");
            setTimeout( function(){
                $(modal).addClass("open");
            }, 300);
            
            $(document).on('click', function(e){
                var target = $(e.target);
                
                if ($(target).hasClass("overlay")){
                    $(target).find(".modal2").each( function(){
                        $(this).removeClass("open");
                    });
                    setTimeout( function(){
                        $(target).removeClass("open");
                    }, 120);
                }
                
            });
            
        });

        $(".close-modal").on('click', function(e){
            e.preventDefault();
            e.stopImmediatePropagation;
            
            var $this = $(this),
                    modal = $($this).data("modal");
            
            $(modal).removeClass("open");
            setTimeout( function(){ 
                $(modal).parents(".overlay").removeClass("open");
            }, 120);
            
        });
    // /Popup
})