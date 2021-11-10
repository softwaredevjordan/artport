
// making sure the copyright is up to date
var year = document.getElementById("year").innerHTML = new Date().getFullYear();

// Navbar styling control

var ronin = document.getElementById('artist');
var lastClicked = 'artist';
var selected = 'selected';
var list = document.getElementsByClassName('headerLink')
ronin.classList.add(selected);



for (let i = 0; i < list.length; i ++) {
  list[i].addEventListener('click',function(){
    
    var clicked = event.target.id;
    console.log(clicked)
  
    if(clicked != lastClicked){
      document.getElementById('mixed-loop').innerHTML = '';
      document.getElementById(lastClicked).classList.remove(selected);
      document.getElementById(clicked).classList.add(selected);
      ajaxButtonPass(clicked);
      lastClicked = clicked;
    }
    
});
};
function ajaxButtonPass(button){
  jQuery(document).ready(function($) {
    
    // This is the variable we are passing via AJAX
    
    console.log("sending");
    // This does the ajax request (The Call).
    $.ajax({
        url: siteURL.ajax, // Since WP 2.8 ajaxurl is always defined and points to admin-ajax.php
        
        type: "post",
        data: {
            'action':'server_side_ajax', // This is our PHP function below
            'input' : button // This is the variable we are sending via AJAX
        },
        
        success: function(response){
           //var res = JSON.parse(response);
           //console.log(res);
          if(response) {
             document.getElementById('mixed-loop').innerHTML = response;
          }
          window.alert('success');
         
          
    
    
            
            
        },  
        error: function(errorThrown){
            window.alert('failure');
        }
    });   

});
}


// let inkDiv = 'ink-loop';
// let inkEnd = '/wp-json/wp/v2/ink?_embed';

// //apiCall(inkDiv, inkEnd);

// let sketchDiv = 'sketch-loop';
// let sketchEnd = '/wp-json/wp/v2/sketches?_embed';

// //apiCall(sketchDiv, sketchEnd);

// function apiCall(divID, endPoint){
//   var feedContainer = document.getElementById(divID);
//   var ourRequest = new XMLHttpRequest();
//   ourRequest.open('GET', siteURL.siteURL + endPoint);
//   ourRequest.onload = function() {
//     if (ourRequest.status >= 200 && ourRequest.status < 400) {
//       var data = JSON.parse(ourRequest.responseText);
//       console.log(data);
//       createHTML(data, feedContainer);
//     } else {
//       console.log("We connected to the server, but it returned an error.");
//     }
//   };
  
//   ourRequest.onerror = function() {
//     console.log("Connection error");
//   };
//   ourRequest.send();
// }

// function createHTML(postData, container){
//   var HTMLString = '';
//   for (let i = 0; i < postData.length; i++){
//     HTMLString += "<div class='post'>"
//     HTMLString += "<a href=" + postData[i].link + ">"
//     HTMLString += '<img class="images"  src="' + postData[i]._embedded['wp:featuredmedia']['0'].source_url + '" alt="">'
//     HTMLString += "<p class= 'title'>" + postData[i].title.rendered + "</p>"
//     HTMLString += "</a>"
//     HTMLString += "</div>"
//   }
//   container.innerHTML = HTMLString;

// }
