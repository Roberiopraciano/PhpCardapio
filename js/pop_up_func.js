 $(window).load(function() {
                new $.popup({                
                    title       : '',
                    content         : '<a href="all_tours_list.html"><img src="img/popup_img.jpg" alt="" class="pop_img"><h3 id="pop_msg">This week special offer <strong>Free Delivery</strong> on all Menu & Orders!</h3></a><small>Autoclose delay in 5 seconds.</small>', 
					html: true,
					autoclose   : true,
					closeOverlay:true,
					closeEsc: true,
					buttons     : false,
                    timeout     : 5000 
                });
            });