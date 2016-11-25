 jQuery(function($){
        $("#dataInicio").mask("99/99/9999");
        $("#dataFim").mask("99/99/9999");
        $("#dataRecisao").mask("99/99/9999");
        $("#cnpj").mask("99.999.999/9999-99");  
        $("#telefone").mask("(99)99999999");
        $("#carga").mask("99",{placeholder:" "});
        $("#cpf").mask("999.999.999-99");
    }
    );
    
 $.validator.methods.email = function( value, element ) {
  return this.optional( element ) || /[a-z]+@[a-z]+\.[a-z]+/.test( value );
}
  