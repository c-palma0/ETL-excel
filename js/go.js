$(document).ready(function(){
  
    $("#go").on("click",function (e){
        e.preventDefault();
      console.log('hola')
       $("body").waitMe({
                        effect: 'timer',
                        text: 'Procesando información.',
                        bg: 'rgba(64,64,64,0.9)',
                        color: '#fff',
                        maxSize: '',
                        source: '../js/waitMe/img.svg',
                        textPos: 'vertical',
                        fontSize: '25px',
                        onClose: function() {}
                    });
                      setTimeout(function(){
                        $("body").waitMe('hide');
                    },30000);
        $.ajax({
            url:"http://127.0.0.1:8081/all",
            dataType:'html',
            headers: {"Access-Control-Allow-Origin": "*", "Access-Control-Allow-Headers": "access-control-allow-origin, access-control-allow-headers"},
            type:'get',
            contentType: 'application/x-www-form-urlencoded',
            success: function(data){            
                var datos = data.info;
                     console.log(data);
                      if(data){
                                window.location.replace("http://localhost:8080/etl/etl.php");
                            }
                    },
            error: function(error){
                console.log(error);    
                    }
            });
    });

});
