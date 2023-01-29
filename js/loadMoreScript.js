function AddReadMore() {
    var carLmt = 915;
    var readMoreTxt = "Подробнее";
    var readLessTxt = "Скрыть";

    $(".addReadMore").each(function() {
        if ($(this).find(".firstSec").length)
            return;

        var allstr = $(this).html();
        if (allstr.length > carLmt) {
            var firstSet = allstr.substring(0, carLmt);
            var secdHalf = allstr.substring(carLmt, allstr.length);
            var strtoadd = firstSet + "<span class='SecSec'>" 
                         + secdHalf 
                         + "</span><span class='readMore'  title='Click to Show More'>" 
                         + readMoreTxt 
                         + "</span><span class='readLess' title='Click to Show Less'>" 
                         + readLessTxt + "</span>";
            $(this).html(strtoadd);
        }

    });
    $(document).on("click", ".readMore,.readLess", function() {
        $(this).closest(".addReadMore").toggleClass("showlesscontent showmorecontent");
    });
}
$(function() {
    AddReadMore();
});