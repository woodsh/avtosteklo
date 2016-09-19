(function($){$(function(){
    
$(document).ready(function() { 
    var    adres;
    var    cord;    
    if(!$.cookie('city')){
    ymaps.ready(init);
        function init() {
        ymaps.geolocation.get({
                // Выставляем опцию для определения положения по ip
                provider: 'yandex',               
               
            }).then(function (result) {
                // Выведем в консоль данные, полученные в результате геокодирования объекта.
                    cord=result.geoObjects.get(0).properties.get('boundedBy');
                    adres=result.geoObjects.get(0).properties.get('metaDataProperty').GeocoderMetaData.AddressDetails.Country.AddressLine;
                  var ajaxurl=php_vars.url;
                $.ajax({   
                        
			url:ajaxurl, // обработчик
                        data : {'action': 'autoservise_home',
                                'city': adres,
                                'cord':cord
                            },
			type:'POST', // тип запроса
			success:function(response){
				if( response ) { 
                                      $('#maps').html(response);
				} else {
					
				}
			}
        });   
            });
        }
    }else{
        var ajaxurl=php_vars.url;
         $.ajax({   

                 url:ajaxurl, // обработчик
                 data : {'action': 'autoservise_home',
                         'city': $.cookie('city'),
                         'cord':cord
                     },
                 type:'POST', // тип запроса
                 success:function(response){
                         if( response ) { 
                               $('#maps').html(response);
                         } else {

                         }
                 }
         });
    }   
       

  
});

  })
})(jQuery);
