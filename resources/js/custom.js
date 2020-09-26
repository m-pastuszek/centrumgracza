/**
 * Custom JS scripts
 */

// easyPieChart
$(function() {
    $('.easypiechart').easyPieChart();
});

// Cookie Info Pop-up
window.addEventListener("load", function(){
    window.cookieconsent.initialise({
        "palette": {
            "popup": {
                "background": "#3c404d",
                "text": "#d6d6d6"
            },
            "button": {
                "background": "#8bed4f"
            }
        },
        "position": "bottom-right",
        "content": {
            "message": "Czy wiesz, że używamy cookies (ciasteczek)? Korzystając ze strony wyrażasz zgodę na używanie cookies, zgodnie z aktualnymi ustawieniami przeglądarki.",
            "dismiss": "Ok, rozumiem!",
            "link": "Dowiedz się więcej.",
            "href": "/polityka-prywatnosci"
        }
    })});


// Twitter - embed tweets showing
window.twttr = (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
    if (d.getElementById(id)) return t;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js, fjs);

    t._e = [];
    t.ready = function(f) {
        t._e.push(f);
    };

    return t;
}(document, "script", "twitter-wjs"));