var clicked = 0;
var count = document.querySelector('#count');
var count2 = document.querySelector("#count2");

var login = document.querySelector('.login_btn');
var signup = document.querySelector('.signup_btn');
var logout = document.querySelector('.logout_btn');

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(name) {
    var cookieString = document.cookie;
    var cookies = cookieString.split("; ");
    for (var i = 0; i < cookies.length; i++) {
      var cookie = cookies[i].split("=");
      if (cookie[0] === name) {
        return cookie[1];
      }
    }
    return null; 
  }
  function deleteAllCookies() {
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/assignment;";
    }

    location.reload();
}

if(getCookie("isloggedin")===null){
    setCookie("isloggedin","false",1);
    window.location.href = 'login.html';
}
if(getCookie("isloggedin")==="false"){
    // setCookie("isloggedin","false",1);
    window.location.href= 'login.html';
}
else{
  login.style.display= "none";
  signup.style.display= "none";
}

logout.addEventListener('click',e=>{
  deleteAllCookies();
});

var star = document.querySelectorAll('.star');
var length = star.length;

for(let i=0;i<length;i++){
  star[i].addEventListener('mouseover',(e)=>{
    for(let j=clicked;j<=i;j++){
      star[j].src = "liked.png";
    }
  count.innerHTML = (i+1);
  count2.value = (i+1);
  })
}

for(let i=0;i<length;i++){
  star[i].addEventListener('mouseleave',(e)=>{
    for(let j=clicked;j<=i;j++){
      star[j].src = "star.png";
    }
  count.innerHTML = clicked;
    count2.value = clicked;
  })
}

for(let i=0;i<length;i++){
  star[i].addEventListener('click',(e)=>{
    if(i>=clicked){
    clicked=i+1;
    for(let j=0;j<=i;j++){
      star[j].src = "liked.png";
    }
  }
  else{
    if(i<clicked){
      for(let j=i+1;j<clicked;j++){
        star[j].src = "star.png";
      }
      clicked = i+1;
    }
  }
  })
}

