(function($){$(function(){
        
//comment city        
 var ajaxurl=php_vars.url;       
 $('#city_chacge').change(function(){
      var id_city = $('#city_chacge').val();
     $.ajax({                        
			url:ajaxurl, // обработчик
                        data : {
                            'action': 'city_chacge',
                            'id': id_city
                            },
			type:'POST', // тип запроса
			success:function(response){
				if( response ) { 
                                        $('#servise_n').html(response);                                        
				} 
			}
		});
 });
 $(document).on('change', '#metro', function(){ 
      ajax_filter();
 });
 $(document).on('change', '#highway', function(){
      ajax_filter();
 });
  $(document).on('change', '#district', function(){
      ajax_filter();
 });
  $(document).on('change', '#start', function(){
      ajax_filter();
 });
  $(document).on('change', '#finish', function(){
      ajax_filter();
 });
  $(document).on('change', '#title', function(){
      ajax_filter();
 });
  $(document).on('change', 'label[for="off_serv"]', function(){
      ajax_filter();
 });
  $(document).on('change', 'label[for="unoff_serv"]', function(){  
      ajax_filter();
 });
 function ajax_filter(){
    var metro = $('#metro').val();
    var highway = $('#highway').val();
    var district = $('#district').val();
    var start = $('#start').val();
    var finish = $('#finish').val();
    var title = $('#title').val();
    var status = $('#off_serv').prop("checked");
    var no_status = $('#unoff_serv').prop("checked");
     $.ajax({                        
			url:ajaxurl, // обработчик
                        data : {
                            'action': 'filter_autoservise',
                            'metro': metro,
                            'highway':highway,
                            'start':start,
                            'finish':finish,
                            'district':district,
                            'title':title,
                            'status':status,
                            'no_status':no_status,
                            },
			type:'POST', // тип запроса
			success:function(response){
				if( response ) { 
                                        $('.list-serv').html(response);
                                        page=2;
				} 
			}
		});
 }
//more comment      
    
   var page=2;
   
   $('#more_comment').click(function(e){
       e.preventDefault();
       
       $.ajax({                        
			url:ajaxurl, // обработчик
                        data : {
                            'action': 'more_comment',
                            'page':page,
                            'id' : php_vars.id_post,
                            },
			type:'POST', // тип запроса
			success:function(response){
				if( response ) { 
                                        $('.action_line').before(response);
                                        page=page+1;                                        
				} else{
                                    $('#more_comment').hide();
                                }
			}
		});
   })
   //more autoservice
    $(document).on('click', '#more-autoservise', function(e){
       e.preventDefault();
       console.log(page);
       var metro = $('#metro').val();
       var highway = $('#highway').val();
       var start = $('#start').val();
       var finish = $('#finish').val();
       var district = $('#district').val();
       var title = $('#title').val();
       var status = $('#off_serv').prop("checked");
       var no_status = $('#unoff_serv').prop("checked");
       $.ajax({                        
			url:ajaxurl, // обработчик
                        data : {
                            'action': 'more_autoservise',
                            'page':page,
                            'metro' : metro,
                            'highway':highway,
                            'start':start,
                            'finish':finish,
                            'district':district,
                            'title':title,
                            'status':status,
                            'no_status':no_status,
                            },
			type:'POST', // тип запроса
			success:function(response){
				if( response ) { 
                                        $('.list-serv-more').before(response);
                                        page=page+1;                                        
				} else{
                                    $('#more-autoservise').hide();
                                }
			}
		});
   })
   
    $(function() {
        $('[data-toggle="popover"]').popover()
    })

    // slider index page
    if ($('.slider-index').length) {
        $('.slider-index').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            arrows: false,
            swipe: true,
            speed: 500,
            fade: true,
            autoplay: true,
            autoplaySpeed: 2000,
        })
    }

    $('.mini-tabs-nav a').click(function(e) {
        e.preventDefault()
        $(this).tab('show')
        $(this).parent('div').addClass('active').siblings('div').removeClass('active');
        $('.mini-tabs-block > div').eq($(this).parent('div').index()).addClass('active').siblings('div').removeClass('active');
    })

    $('.list-service-preview').scroller({
    });

    $('.slick-review').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        swipe: true
    });

    $('.slide-full').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        swipe: true,
        fade: true
    });

    $('.modal-slide').slick({
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        swipe: true
    });

    $('#brandModal').on('show.bs.modal', function () {
      $(this).find('.slick-next').click();
      $(this).find('.slick-prev').click();
    });

    $('#modelModal').on('show.bs.modal', function () {
      $(this).find('.slick-next').click();
      $(this).find('.slick-prev').click();
    });

    $('#videoModal').on('hide.bs.modal', function () {
      $(this).find('iframe').attr('src', '');
    });
    $('#videoModal').on('show.bs.modal', function () {
      $(this).find('iframe').attr('src', 'https://www.youtube.com/embed/X-I19WBDEvw?rel=0&amp;showinfo=0');
    });

    $('.mobile-menu_open').click(function() {
        $('.mobile-menu').fadeIn(400);
        return false;
    });

    $('.mobile-menu .cls').click(function() {
        $('.mobile-menu').fadeOut(400);
        return false;
    });

    $('.click-next').click(function() {
        $('.slick-dots li.slick-active').next('li').find('button').click();
        return false;
    });

    $( "#stepsPrice, #stepsYear" ).click(function() {
        $(this).next('.show-range').show();
    });

    $('body').click(function() {
        $('.show-range').hide();
    });

    $('.show-range, #stepsPrice, #stepsYear').click(function (e){
        e.stopPropagation();
    })

    $('#stepsYear').mask('9999 - 9999 гг');

    $( ".slider-year" ).slider({
          range: true,
          min: 1970,
          max: 2016,
          values: [ 1970, 2016 ],
          slide: function( event, ui ) {
            $( "#stepsYear" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ]  + " гг");
          }
        });
    $( "#stepsYear" ).val( $( ".slider-year" ).slider( "values", 0 ) + " - " + $( ".slider-year" ).slider( "values", 1 ) + " гг");

    $( ".slider-price" ).slider({
          range: true,
          min: 0,
          max: 50000,
          step: 10,
          values: [ 970, 21016 ],
          slide: function( event, ui ) {
            $( "#stepsPrice" ).val("от " + ui.values[ 0 ] + " - до " + ui.values[ 1 ]  + " руб.");
          }
        });
    $( "#stepsPrice" ).val( "от " + $( ".slider-price" ).slider( "values", 0 ) + " - до " + $( ".slider-price" ).slider( "values", 1 ) + " руб.");
    
    
    function sendToGa() {
	console.log("GA test");
	console.log(typeof(ga));
    if ((typeof (ga) !== "undefined") && ($('input[name="scenario"]').val() !== 'mainPageReturnedUser')) {
		console.log("GA ok!");
        return true;
    }
    else {
        return false;
    }
}

function send_goal(frm){
    if (sendToGa()) {
		console.log("GA send event!");
		console.log("start-----");
		console.log(ga);
		console.log("end-----");
		ga('send',
            'event', {
            eventCategory: 'form',
            eventAction: "landingap-"+frm,
            eventValue: 1
        });
		//console.log(tt);
        /*ga('send',{
            hitType: 'event',
            eventCategory: 'form',
            eventAction: "landingap-"+frm,
            eventValue: 1
        });*/
		/*ga('send',{
            'hitType': 'event',
            'eventCategory': 'form',
            'eventAction': "landingap-"+frm,
            'eventLabel': '',
            'eventValue': 1
        });*/
		/*ga('send',
            'event',
            'form',
            "landingap-"+frm,
            'Пользователь отправил заявку из '+frm,
            1
        );*/
    }
	else{
		console.log("GA NOT send event!");
	}
    console.log("landingap-"+frm);
    if ( typeof(yaCounter25138733) != 'undefined')
    {
        yaCounter25138733.reachGoal("landingap-"+frm);
    }
    console.log("landingap-"+frm);
    return true;
}


function send_ajax_form(frm){
    console.log("form= "+frm);
    var info=$("#"+frm).serialize();

    var inforeq="";

    inforeq=info;
    console.log("inforeq= "+inforeq);
    $.post("http://autostekloff.ru/landap/index1ap.php", inforeq,
        function(data){
            $("#thanksModal").modal('show');
        }
    );
}

function send_form(frm) {
    var $form = $("#"+frm);
    console.log("!!!form= "+frm);

    var	ok = true,
        $name = $form.find("#name-form1"),
        $phone = $form.find("#phone-form1"),
        $brand=$form.find("#brand-form1");

    console.log("name "+$name);
    console.log("phone "+$phone);
    console.log("brand "+$brand);

    //alert($name.hasClass('required'));
    if ($name.length && $name.hasClass('required') && $name.val().length === 0) {
        ok = false;
        $name.addClass("has-error");
        $name.focus();
    } else{
        $name.removeClass("has-error");
        ok = true;
    }

    if ($phone.length && $phone.hasClass('required') && $phone.val().length === 0) {
        $phone.addClass("has-error");
        ok = false;
        if ($name.length && $name.hasClass('required') && $name.val().length === 0)
        {
            $name.addClass("has-error");
            $name.focus();
        }
        else{
            $phone.focus();
        }
    } else{
        $phone.removeClass("has-error");
        ok = true;
    }

    if (ok) {
        //$form.submit();
        //return true;
        //denis send_goal(frm);
        //denis send_ajax_form(frm);
        $("#thanksModal").modal('show');//denis
        $name.val('');
        $phone.val('');
        $brand.val('');
        return false;
    }
    else{
        if (sendToGa()) {
            ga('send',{
                'hitType': 'event',
                'eventCategory': 'form',
                'eventAction': frm+"-error",
                'eventLabel': 'Ошибка заполнения. Попытка отправки из '+frm,
                'eventValue': 1
            });
        }
        return false;
    }
}


function send_form2(frm) {
    var $form = $("#"+frm);
    console.log("!!!form= "+frm);

    var	ok = true,
        $name = $form.find("#name-quest"),
        $email=$form.find("#mail-quest");

    console.log("name "+$name);
    console.log("email "+$email);


    //alert($name.hasClass('required'));
    if ($name.length && $name.hasClass('required') && $name.val().length === 0) {
        ok = false;
        $name.addClass("has-error");
        $name.focus();
    } else{
        $name.removeClass("has-error");
        ok = true;
    }

    if ($email.length && $email.hasClass('required') && $email.val().length === 0) {
        $email.addClass("has-error");
        ok = false;
        if ($name.length && $name.hasClass('required') && $name.val().length === 0)
        {
            $name.addClass("has-error");
            $name.focus();
        }
        else{
            $email.focus();
        }
    } else{
        $email.removeClass("has-error");
        ok = true;
    }

    if (ok) {
        //$form.submit();
        //return true;
        send_goal(frm);

        send_ajax_form(frm);
        $("#questModal").modal('hide');
        $name.val('');
        $email.val('');

        return false;
    }
    else{
        if (sendToGa()) {
            ga('send',{
                'hitType': 'event',
                'eventCategory': 'form',
                'eventAction': frm+"-error",
                'eventLabel': 'Ошибка заполнения. Попытка отправки из '+frm,
                'eventValue': 1
            });
        }
        return false;
    }
}

function send_form3(frm) {
    var $form = $("#"+frm);
    console.log("!!!form= "+frm);

    var	ok = true,
        $name = $form.find("#name-callback"),
        $phone = $form.find("#phone-callback");

    console.log("name "+$name);
    console.log("phone "+$phone);

    //alert($name.hasClass('required'));
    if ($name.length && $name.hasClass('required') && $name.val().length === 0) {
        ok = false;
        $name.addClass("has-error");
        $name.focus();
    } else{
        $name.removeClass("has-error");
        ok = true;
    }

    if ($phone.length && $phone.hasClass('required') && $phone.val().length === 0) {
        $phone.addClass("has-error");
        ok = false;
        if ($name.length && $name.hasClass('required') && $name.val().length === 0)
        {
            $name.addClass("has-error");
            $name.focus();
        }
        else{
            $phone.focus();
        }
    } else{
        $phone.removeClass("has-error");
        ok = true;
    }

    if (ok) {
        //$form.submit();
        //return true;
       //denis send_goal(frm);
       //denis send_ajax_form(frm);
        $("#thanksModal").modal('show');//denis
        $("#callbackModal").modal('hide');
        $name.val('');
        $phone.val('');
        return false;
    }
    else{
        if (sendToGa()) {
            ga('send',{
                'hitType': 'event',
                'eventCategory': 'form',
                'eventAction': frm+"-error",
                'eventLabel': 'Ошибка заполнения. Попытка отправки из '+frm,
                'eventValue': 1
            });
        }
        return false;
    }
}

$(document).ready(function() { 
    
	$("#phone-form1").mask("+7 999 999 99 99");
	$("#phone-callback").mask("+7 999 999 99 99");

    $("#btn-send-form1").click(function(event){
        event.preventDefault();
        send_form("form-1");
        return false;
    });

    //$("#btn-request-call-me").click(function(event){
    //    event.preventDefault();
    //    send_form("form-callback");
    //    //$("#thanksModal").modal('show');
    //    //$("#callbackModal").modal('hide');
    //    return false;
    //});

    $("#btn-request-quest").click(function(event){
        event.preventDefault();
        send_form2("form-quest");
        return false;
    });



    $("#btn-request-call-me").click(function(event){
        event.preventDefault();
        send_form3("form-callback");
        return false;
    });

    $("#btn-thanks-close").click(function(event){
        event.preventDefault();
        $("#thanksModal").modal('hide');
    });

    $("#btn-callbackopen").click(function(event){
        send_goal("callbackopen");
    });
    $("#btn-questopen").click(function(event){
        send_goal("questopen");
    });
    $('#partner-reg').click(function(event){
        event.preventDefault();
        console.log('11111111111');
        $("#thanksModal").modal('show');
        return false;
    })
    
    $('#btn-send-formnew').click(function(event){
        event.preventDefault();
        console.log('11111111111');
        $("#thanksModal").modal('show');
        $('#serviseModal').hide();
        return false;
    })
    //form-quest
});



  })
})(jQuery);
