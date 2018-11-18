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
      context.drawImage(video, 0, 0, width, height);
      const imgUrl  = canvas.toDataURL('image/png');
      const img     = document.createElement('img');
      img.setAttribute('src', imgUrl);
      panel.appendChild(img);
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
  image.setAttribute('src', imageUrl);    
  console.log(imageUrl);
  console.log('Tying to save a picture');
  edited.appendChild(image);
}

//User Profile Settings.
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