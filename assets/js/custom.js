const inputCPF = document.querySelector('#cpf'); 
const inputCEP = document.querySelector('#cep'); 

inputCPF.addEventListener('input', () => {
    let inputValue = inputCPF.value.replace(/\D/g, ''); 
    let formattedValue = '';

    for (let i = 0; i < inputValue.length; i++) {
        if (i === 3 || i === 6) {
            formattedValue += '.';
        } else if (i === 9) {
            formattedValue += '-';
        }
        formattedValue += inputValue.charAt(i);
    }

    inputCPF.value = formattedValue;
});

inputCEP.addEventListener('input', () => {
    let inputValue = inputCEP.value.replace(/\D/g, ''); 
    let formattedValue = '';

    for (let i = 0; i < inputValue.length; i++) {
        if (i === 5) {
            formattedValue += '-';
        } 
        formattedValue += inputValue.charAt(i);
    }

    inputCEP.value = formattedValue;
});



$(document).ready(function() {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#logradouro").val("");
        $("#bairro").val("");
        $("#city").val("");
        $("#state").val("");
        
    }
    
    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#logradouro").val("...");
                $("#bairro").val("...");
                $("#city").val("...");
                $("#state").val("...");
                

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#logradouro").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#city").val(dados.localidade);
                        $("#state").val(dados.uf);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});
$("#number").mask("(99) 99999-9999");


