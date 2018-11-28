let width     = 500;
let height    = 0;
let filter    = 'none';
let streaming = false;

const video   = document.getElementById('video');
const photo   = document.getElementById('photo');
const canvas  = document.getElementById('canvas');
const gallery = document.getElementById('gallery-canvas');
const panel   = document.getElementById('pre-edit');
const pose    = document.getElementById('pose');
const pfilter = document.getElementById('pf');
const edited  = document.getElementById('edited');
const save    = document.getElementById('save-photo');

var signup_password = document.getElementById('password');
var signup_confirm  = document.getElementById('confirm-password');
var prof_password   = document.getElementById('newpassword');
var prof_confirm    = document.getElementById('confirm-newpassword');
var reset_password  = document.getElementById('reset-password');
var reset_confirm   = document.getElementById('reset-confirm');
var upload_image   = document.getElementById('upload-image');
var img_u   = document.getElementById('img-u');

if (video){
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
    if(!streaming){
      height = video.videoHeight / (video.videoWidth / width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
      e.preventDefault();
    }
  }, false);
}
if (photo){
  photo.addEventListener('click', function(e){
    take_photo();
    e.preventDefault();
  }, false);
}
  function take_photo(){
    if (width && height){
      canvas.width  = width;
      canvas.height = height;
      const context = canvas.getContext('2d');
      const galleryContext = gallery.getContext('2d');
      galleryContext.drawImage(video, 0, 0, 300, 150);
      const imgUrl  = canvas.toDataURL('image/png');
      const img     = document.createElement('img');
      img.setAttribute('src', imgUrl);
    }
  }

function add_superpose(pose_id){
  const pose    = document.getElementById(pose_id);
  const context_pose = gallery.getContext('2d');
  context_pose.drawImage(pose, 0, 0, 300, 150);
}

function save_photo(){
  const imageUrl  = gallery.toDataURL('image/png');
  const image     = document.createElement('img');
  image.setAttribute('name', 'image1'); 
  image.setAttribute('src', imageUrl);
  document.getElementById('snap').value = imageUrl;
  console.log(document.getElementById('snap').value);
  edited.appendChild(image);
}

function validate_password(password, confirm){
  if (password != confirm){
    confirm.setCustomValidity("Password do not match!");
  }
  else{
    confirm.setCustomValidity('');
  }
}

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

if (signup_confirm && signup_password){
  signup_password.onchange = validate_password(signup_password, signup_confirm);
  signup_confirm.onkeyup   = validate_password(signup_password, signup_confirm);
}
if (prof_confirm && prof_password){
  prof_password.onchange = validate_password(prof_password, prof_confirm);
  prof_confirm.onkeyup   = validate_password(prof_password, prof_confirm);
}
if (reset_confirm && reset_password){
  reset_password.onchange = validate_password(reset_password, reset_confirm);
  reset_confirm.onkeyup   = validate_password(reset_password, reset_confirm);
}