// 価格入力
$('.input__price').on('focusin', function () {
    this.value = this.value.replace('¥', '');
    $(this).select();
});
$('.input__price').on('change', function () {
    let price = Number(this.value);
    if (Number.isInteger(price) && price > 0) {
        this.value = '¥' + price.toLocaleString();
    }
    else {
        this.value = '¥0';
    }
});