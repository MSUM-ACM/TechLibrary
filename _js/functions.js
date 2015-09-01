window.onscroll = function(ev) {
  var docHeight = document.body.offsetHeight;
  docHeight = docHeight == undefined ? window.document.documentElement.scrollHeight : docHeight;

  var winheight = window.innerHeight;
  winheight = winheight == undefined ? document.documentElement.clientHeight : winheight;

  var scrollpoint = window.scrollY;
  scrollpoint = scrollpoint == undefined ? window.document.documentElement.scrollTop : scrollpoint;

  if (scrollpoint > 100) {
    $("header container").addClass("fixed");
  }else{
    $("header container").removeClass("fixed");
  }
};
