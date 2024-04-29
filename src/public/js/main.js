// フラッシュメッセージ
(function() {
    $(function(){
        $('#div__flash-message').fadeOut(3000);
        $('#div__flash-error').fadeOut(3000);
    });
})();

// 戻るボタンでブラウザの履歴を1つ戻る
function goBackPage() {
    window.history.back();
}

// ページバック時に更新
window.addEventListener('pageshow',()=>{
    const entries = window.performance.getEntriesByType('navigation')
    for (const entry of entries) {
        if (entry.type === 'back_forward') {
            location.reload();
        }
    }
});