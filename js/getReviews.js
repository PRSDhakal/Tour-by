/*
 * Anuj Wagle
 * Std number:201511763
 This method is called  while loading the page first and
 from different buttons like next , prev and sent

 next button requests for next image and comments
 prev button requests for previous image and comments
 comment button requests to post comment

 loadAll(0) is called while loading the page
 loadAll(1) is called when next button is pressed
 loadAll(2) is called when prev button is pressed
 loadAll(3) is called when comment button is pressed

 */
var counter = 0;
var cookies = document.cookie.split(";").map(function (el) {
    return el.split("=");
}).reduce(function (prev, cur) {
    prev[cur[0]] = cur[1];
    return prev
}, {});

var guideId = cookies["guideIdForReview"];

function loadAll(loadedFrom, tournumber) {
    var tourno = tournumber;
    var once = false;
    var commentBox = document.getElementById('comment');
//if loadedFrom is 0, it was loaded while loading the page, so set the counter to 0


    //url that ajax will request to
    var url = "getReviews.php?";
    //adding the id of the picture to be requested in the query
    var query = "command=" + guideId;
    //if loadedFrom is 3, it was sent from the comment form, so
    //add the comment in the query by encoding it.
    if (loadedFrom == 3) {
        var comment = commentBox.value;
        query += "&tournum=" + tourno + "&comment=" + encodeURIComponent(comment);
    }
    // get an AJAX object
    var xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200 || xhr.status == 400) {
                console.log(query);// for debugging use
                var response = xhr.responseText;
                console.log(response);//for debugging use

                var obj = JSON.parse(response);
                console.log(obj);//for debugging use
                //send the json object to the function renderHTMl()
                // to update the picture and comment field
                renderHTML(obj);
            }
            //if the status is not 200 or 400
            else {
                alert("unknown error");

            }

        }
    };

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(query);// send the query to url
}


// this function takes the json parsed object and updates the comment and picture field with data
function renderHTML(indata) {
    var commentContainer = document.getElementById("commentSection");
    commentContainer.innerHTML = "";
    var HTMLstring = "";
    if (indata == "No reviews yet!") {
        HTMLstring += "<h4><i> No reviews yet!</i></h4>"
    }
    else {
        //going through the json array to get all the comments in the comment container
        for (i = 0; i < indata.length; i++) {
            if (indata[i].comment != "") {
                HTMLstring += "<blockquote><p>" + indata[i].comment + "</p> <cite><b>" + indata[i].author + "</b><p>Tour #: " + indata[i].tourId + "<span style='padding-left: 20px;'>Tour Date: " + indata[i].tourDate + "</span></p></cite></blockquote> ";
            }
        }
    }
    commentContainer.insertAdjacentHTML('beforeend', HTMLstring);

}
//load the first image and its comment while loading the page
