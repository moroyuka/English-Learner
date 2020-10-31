
//スクロール
function getScrolled() {
    return ( window.pageYOffset !== undefined ) ? window.pageYOffset: document.documentElement.scrollTop;
   }
   
   //idを変数に
   var topButton = document.getElementById( 'page-top' );
   
   //スクロール２００より大きい時cssのfadeinが動く
   window.onscroll = function() {
     ( getScrolled() > 200 ) ? topButton.classList.add( 'fade-in' ): topButton.classList.remove( 'fade-in' );
   };
   
   //0.03秒ごとにスクロール量の1/2ずつtopに戻る→最後の方少しゆっくりめに見える
   function scrollToTop() {
     var scrolled = getScrolled();
     window.scrollTo( 0, Math.floor( scrolled / 2 ) );
     if ( scrolled > 0 ) {
       window.setTimeout( scrollToTop, 30 );
     }
   };
   
   //ボタン押された時
   topButton.onclick = function() {
     scrollToTop();
   };
   
   
   