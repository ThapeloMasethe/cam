let width = 500;
let height = 0;
let filter = 'none';
let streaming = false;

const video = document.getElementById('video');
const photo = document.getElementById('photo');
const canvas = document.getElementById('canvas');
const gallery = document.getElementById('gallery');

navigator.mediaDevices.getUserMedia({video: true, audio: false})
  .then(function(stream){
    video.srcObject = stream;
    video.play();
  })
  .catch(function(err)
  {
    console.log(`Error: ${err}`);
  });

  video.addEventListener('canplay', function(e){
    if(!streaming)
    {
      height = video.videoHeight / (video.videoWidth / width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  photo.addEventListener('click', function(e){
    take_photo();
    e.preventDefault();
  }, false);
  function take_photo(){
    const context = canvas.getContext('2d');
    if (width && height)
    {
      canvas.width = width;
      canvas.height = height;
      context.drawImage(video, 0, 0, width, height);

      const imgUrl = canvas.toDataURL('image/png');
      const img = document.createElement('img');
      img.setAttribute('src', imgUrl);
      gallery.appendChild(img);
    }
  }
  /* Uploading an image using jQuery */
/*•••••••••••••••••••••••••••••••••••••••••••••••••
            USER PROFILE SETTINGS
••••••••••••••••••••••••••••••••••••••••••••••••••*/
function open_profile(evnt, tabname){
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabname).style.display = "block";
    evnt.currentTarget.className += " active";
}

/*•••••••••••••••••••••••••••••••••••••••••••••••••
            PASSWORD VALIDATOR
••••••••••••••••••••••••••••••••••••••••••••••••••*/
function validate_password()
{
    var password = document.getElementById("password").value;
    console.log(password);
    var confirm_password = document.getElementById("confirm-password").value;
    console.log(confirm_password);
    if (password != confirm_password)
      document.getElementById("confirm-password").setCustomValidity("Password dont match");
    else
      document.getElementById("confirm-password").setCustomValidity('');
}
document.getElementsByName("submit")[0].onclick = validate_password();

var listElm = document.querySelector('#infinite-list');

// Add 20 items.
var nextItem = 1;
var loadMore = function(){
  for (var i = 0; i < 20; i++) {
    var item = document.createElement('li');
    item.innerText = 'Item ' + nextItem++;
    listElm.appendChild(item);
  }
}

// Detect when scrolled to bottom.
listElm.addEventListener('scroll', function() {
  if (listElm.scrollTop + listElm.clientHeight >= listElm.scrollHeight) {
    loadMore();
  }
});

// Initially load some items.
loadMore();
