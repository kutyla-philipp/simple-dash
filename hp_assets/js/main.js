// Set random background image
function setBgImg() {
  var bg = "";

  $.getJSON("hp_assets/lib/ajax_get_image.php").done(function(data) {
    if (data['success']) {
      bg = data['url'];
      if (bg != "" && bg != null) {
        preloadimages([bg]).done(function(images) {
          $("#homepage").css("background-image", "url(" + bg + ")").css("background-size", "cover");
          $("#pic-info-wrap").removeClass("hidden");
          $("#pic-info-url").attr("href", data['image_user_url']).text(data['image_user_name']);
        });
      }
    }
  });
}

// http://www.javascriptkit.com/javatutors/preloadimagesplus.shtml
function preloadimages(arr){
  var newimages=[], loadedimages=0
  var postaction=function(){}
  var arr=(typeof arr!="object")? [arr] : arr
  function imageloadpost(){
    loadedimages++
    if (loadedimages==arr.length){
      postaction(newimages) //call postaction and pass in newimages array as parameter
    }
  }
  for (var i=0; i<arr.length; i++){
    newimages[i]=new Image()
    newimages[i].src=arr[i]
    newimages[i].onload=function(){
        imageloadpost()
    }
    newimages[i].onerror=function(){
      imageloadpost()
    }
  }
  return { //return blank object with done() method
    done:function(f){
      postaction=f || postaction //remember user defined callback functions to be called when images load
    }
  }
}

$(function() {
  $("#mobile-menu-wrap a").click(function(e) {
    e.preventDefault();
  });

  setBgImg();
});
