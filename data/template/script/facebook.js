$(document).ready(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1&appId=290595207712125";
    fjs.parentNode.insertBefore(js, fjs);    
}(document, 'script', 'facebook-jssdk'));