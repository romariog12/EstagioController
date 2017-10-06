function excluirDocumento(idDocumento){
     var apagar = confirm('Deseja realmente excluir este registro?');
      if (apagar){
        $(".excluir-"+idDocumento)
            .removeClass("fa-trash")
            .addClass("fa-spinner fa-pulse fa-fw");
        $(".btn").attr("disabled",true);
        $.post(
        '',
        'json'
        ).always(function() {
             $("#"+idDocumento).hide('2000');
             $(".btn").attr("disabled",false);
        });			
      }else{
         event.preventDefault();
      }	   
 }
  function salvarDocumento(idDocumento){
    $(".salvar-"+idDocumento)
            .addClass("fa fa-spinner fa-pulse fa-fw");
    $(".btn").attr("disabled",true);
    $.post(
     'vagaPresencial/salvarDocumento',
        {
        idDocumento: function(){
                return idDocumento;
            },
        operacao1: function(){
            var  operacao1 = $("#list-"+idDocumento+" input[name='operacao1']");
                if(operacao1.is(":checked")){
                    return '1';  
                }
                else{
                    return '0';
                }   
          },
        operacao2: function(){
            var  operacao2 = $("#list-"+idDocumento+" input[name='operacao2']");
                if(operacao2.is(":checked")){
                    return '1';  
                }
                else{
                    return '0';
                }    
        },
        operacao3: function(){
            var  operacao3 = $("#list-"+idDocumento+" input[name='operacao3']");
                if(operacao3.is(":checked")){
                    return '1';  
                }
                else{
                    return '0';
                }  
        },
        operacao4: function(){
            var  operacao4 = $("#list-"+idDocumento+" input[name='operacao4']");
                if(operacao4.is(":checked")){
                    return '1';  
                }
                else{
                    return '0';
                }    
        }
    },
    'json'
    ).always(function(){
           var n = $( "#list-"+idDocumento+" input:checked").length;
            switch(n){
                case 1: $(".progress-"+idDocumento).css("width",'25%').html("25%") ;
                break
                     case 2: $(".progress-"+idDocumento).css("width",'50%').html("50%") ;
                     break
                          case 3: $(".progress-"+idDocumento).css("width",'75%').html("75%");
                          break
                               case 4: $(".progress-"+idDocumento).css("width",'100%').html("Processo Finalizado!") ;
                               break
                                    case 0: $(".progress-"+idDocumento).css("width",'10%').html("10%") ;
                                        break
              }
        $(".salvar-"+idDocumento).removeClass("fa fa-spinner fa-pulse fa-fw");
        $(".btn").attr("disabled",false);
      }
    );
 };
 function editarDocumento(idDocumento){
     $(".btn-edit").html("<i class='fa fa-spinner fa-pulse fa-fw'></i>");
     $.post(
        '',
        {
            idDocumento: function(){
                return idDocumento;
            },
            inicio: function(){
                return $("#editarInicio-"+idDocumento).val();},
            fim: function(){
                return $("#editarFim-"+idDocumento).val();},
            documento: function(){ 
                return $("#editarTipo-"+idDocumento).val();}
        },
        'json').always(
                  location.reload()
                );
 }