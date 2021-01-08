//подгрузка  коментариев  через  setInterval
function load(timeout, count) {
    i = 0, count = count ? count : 500;
    i = 0, timeout = timeout ? timeout : 1000;
    id = setInterval(function () {
        $('.v-button__title:last').click();
        height = document.body.scrollHeight;
        window.scrollTo(0, height);
        if (++i > count) {
            clearInterval(id)
        }
        console.dir({"i": i, "осталось": count - i, "из": count, "intervalID": id, "задержка": timeout});
    }, timeout);
}

// сортировка  подгруженных коментов в  обратном  порядке  вырезание  текста
function parse() {
    arr = [];
    jQuery('#js-app > div.l-wrapper > div.l-container.js-coupe-invertedTarget.js-statistics > div.l-content-wrap > div.l-content > div.js-comments.profile__content > div > ul > li > div.comment > div.comment__body > div.comment__row.comment__row_type_actions > span > span').each((e, el,) => {
        arr.push({
            "num": $(el).text(),
            "text": $(el).closest('.comment__body').find('.comment__row.comment__row_type_message').text(),
            "time": $(el).closest('.comment__body').find('.comment__time').text(),
            "content": $(el).closest('.comment').find('.comment__content').html(),
        });
    })
    arr.sort((a, b) => parseInt(a.num) - parseInt(b.num)).reverse();
    return arr
}

//прокрутка вниз не работает
/*var height = 15;
var attempt = 4;
var intS = 0;
//https://ru.stackoverflow.com/questions/628058/javascript-Прокрутить-страницу-вниз
function scrollToEndPage() {
    console.log("hight:" + height + " scrollHeight:" + document.body.scrollHeight + " att:" + attempt  );

    if (height < document.body.scrollHeight)
    {
        //height = document.body.scrollHeight;
        window.scrollTo(0, height);
        attempt++;
        height = parseInt(height) + attempt;
    }
    esle
    {
        clearInterval(intS);
    }
}
//intS = setInterval(scrollToEndPage,100);
*/
$.getScript('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js');
$.getScript('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/ru.js');
Arr = [];
monthes = {};
debugger;
$.each(arr, function (i, v) {
    s = v.time.toString().split(' ')
    if (!jQuery.isArray(s)) {
        console.warn(v.time.toString())
        return;
    }

    n = s[0].toString().trim();
    a = s[1].toString().trim();
    b = s[2].toString().trim();
    if ((a == 'дней') && (b == 'назад')) {
        d = new Date('-' + n);

    }
    if ((/[а-яё\.]{3,5}/.test(a))) {
        monthes[a] = v

    }
})