var maskTelCel = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    optionsTelCel = {
        onKeyPress: function (val, e, field, options) {
            field.mask(maskTelCel.apply({}, arguments), options);
        }
    };
document.addEventListener('DOMContentLoaded' , function(){
    console.log('TEste Global');
    $('.mask-data').mask('99/99/9999');
    $('.mask-mesano').mask('99/9999');
    $('.mask-diames').mask('99/99');
    $('.mask-ano').mask('9999');
    $('.mask-cnpj').mask('99.999.999/9999-99');
    $('.mask-cpf').mask('999.999.999-99');
    $('.mask-rg').mask('99.999.999-A');
    $('.mask-telefone').mask('(99) 9999-9999');
    $('.mask-celular').mask('(99) 99999-9999');
    $('.mask-cep').mask('99999-999');
    $('.mask-idade').mask('999');
    $('.mask-telcel').mask(maskTelCel, optionsTelCel);

    /**$('.mask-reais').maskMoney({prefix:'R$ ', thousands:'.', decimal:',', affixesStay: false});
    $('.mask-reais-int').maskMoney({prefix:'R$ ', thousands:'.', affixesStay: false, precision: 0, decimal:',', allowZero : true});
    $('.mask-reais-double').maskMoney({prefix:'R$ ', thousands:'.', affixesStay: false, precision: 2, decimal:',', allowZero : true});
    $('.mask-porcentagem').maskMoney({prefix:'', suffix:'%', decimal:',', affixesStay: false, precision: 0});
    $('.mask-porcentagem-2').maskMoney({prefix:'', suffix:'%',thousands:'.', decimal:'.', affixesStay: true, precision: 2});
    $('[data-toggle="tooltip"]').tooltip();
    */

    Inputmask('currency', {
        prefix: 'R$ ',
        radixPoint: ',',
        groupSeparator: '.',
        digits: 2,
        rightAlign: false,
        numericInput: true
    }).mask('.mask-reais')


})
