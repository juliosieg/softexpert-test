function bloqueia(seletor, trueFalse, effect) {

    if (trueFalse) {
        run_waitMe(seletor);
    } else {
        $(seletor).waitMe('hide');
    }


    function run_waitMe(seletor) {
        $(seletor).waitMe({
            effect: effect,
            source: '../images/privilegios.png',
            bg: '#fff',
            color: '#000'
        });
    }
}

function bloqueiaMsgAguarde(seletor, trueFalse, effect) {
    if (trueFalse) {
        run_waitMe(seletor);
    } else {
        $(seletor).waitMe('hide');
    }


    function run_waitMe(seletor) {
        $(seletor).waitMe({
            effect: effect,
            text: 'Aguarde',
            bg: 'rgba(255,255,255,0.7)',
            color: '#000'
        });
    }
}