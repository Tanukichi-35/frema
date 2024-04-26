const onImg =  '../../img/star_on.jpg'
const offImg =  '../../img/star_off.jpg'

// お気に入りボタン
$('.img__like').on('click', function () {
    let postURL = "/likeOn";
    let obj = $(this);
    let isOn = obj.attr('src').includes('star_on');
    if (isOn) {
        postURL = "/likeOff";
    }
    let number = Number($('.small__like-number').text());

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: postURL,
        type: "POST",
        data: {
            "item_id": obj.data('item_id')
        },
    }).done(function (res) {
        console.log('success', res);
        if (isOn) {
            obj.attr('src', '../../img/star_off.jpg');
            number--;
        }
        else {
            obj.attr('src', '../../img/star_on.jpg');
            number++;
        }
        $('.small__like-number').text(number);
    }).fail(function(XMLHttpRequest, textStatus, errorThrown){
        console.log(XMLHttpRequest.status);
        console.log(textStatus);
        console.log(errorThrown);
    });
});

// コメントボタン
$('.img__comment').on('click', function () {
    $('.div__purchase-form').toggle();
    $('.div__comment-form').toggle();
});